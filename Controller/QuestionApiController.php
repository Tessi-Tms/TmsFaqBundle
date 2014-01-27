<?php

namespace Tms\Bundle\FaqBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tms\Bundle\FaqBundle\Entity\Question;

/**
 * Api controller.
 *
 * @Route("/questions")
 */
class QuestionApiController extends Controller
{
    /**
     * Search questions and match responses
     *
     * @Route("/search/{query}.{_format}", name="tms_faq_api_questions_search", defaults={"_format"="json"})
     * @Method("GET")
     */
    public function searchAction(Request $request, $query)
    {
        $format = $request->getRequestFormat();
        $searchIndexHandler = $this->get('tms_search.handler');

        $questions = array();
        $data = $searchIndexHandler->searchAndFetchEntity('tms_faq_question', $query);
        $questions = $data['data'];
        $export = $this->get('idci_exporter.manager')->export($questions, $format);

        $response = new Response();
        $response->setContent($export->getContent());
        $response->headers->set(
            'Content-Type',
            sprintf('%s; charset=UTF-8', $export->getContentType())
        );

        return $response;
    }
}
