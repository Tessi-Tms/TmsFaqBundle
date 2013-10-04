<?php

namespace Tms\Bundle\FaqBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tms\Bundle\FaqBundle\Exception\UndefinedResponseException;
use Tms\Bundle\FaqBundle\Exception\ResponseNotFoundException;
use Tms\Bundle\FaqBundle\Entity\Evaluation;

/**
 * Api controller.
 *
 * @Route("/evaluations")
 */
class EvaluationApiController extends Controller
{

   /**
    * Post an Evaluation
    *
    * @Route(".{_format}", name="tms_faq_api_evaluations_post", defaults={"_format"="json"})
    * @Method("POST")
    */
    public function postAction(Request $request)
    {
        $response_id = $request->request->get('response_id');
        $value = $request->request->get('value');
        $format = $request->getRequestFormat();
        $response = new Response();
        try{
            $evaluation = $this->get('tms_faq.manager')->addEvaluation($response_id, $value);
            $export = $this->get('idci_exporter.manager')->export(array($evaluation),
                $format
            );
            $response->setStatusCode(201);
            $response->setContent($export->getContent());
            $response->headers->set(
                'Content-Type',
                sprintf('%s; charset=UTF-8', $export->getContentType())
            );
        }
        catch(\Exception $e){
            $response->setStatusCode(404);
            $response->setContent($e->getMessage());
        }

        return $response;
    }
}
