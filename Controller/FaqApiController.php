<?php

namespace Tms\Bundle\FaqBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tms\Bundle\FaqBundle\Entity\Faq;

/**
 * Api controller.
 *
 * @Route("/faqs")
 */
class FaqApiController extends Controller
{

    /**
     * Get All Faqs
     *
     * @Route(".{_format}", name="tms_faq_api_faqs_list", defaults={"_format"="json"})
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        $format = $request->getRequestFormat();

        $export = $this->get('idci_exporter.manager')->export(
             $this->get('tms_faq.manager.faq')->findAll(),
             $format
        );

        $response = new Response();
        $response->setContent($export->getContent());
        $response->headers->set(
            'Content-Type',
            sprintf('%s; charset=UTF-8', $export->getContentType())
        );
        return $response;
    }

   /**
    * Get a faq by its id
    *
    * @Route("/{id}.{_format}", name="tms_faq_api_faqs_get", defaults={"_format"="json"})
    * @ParamConverter("faq", class="TmsFaqBundle:Faq", options={"id" = "id"})
    * @Method("GET")
    */
    public function getAction(Request $request, Faq $faq)
    {
        $format = $request->getRequestFormat();
        $export = $this->get('idci_exporter.manager')->export(array($faq), $format);

        $response = new Response();
        $response->setContent($export->getContent());
        $response->headers->set(
            'Content-Type',
            sprintf('%s; charset=UTF-8', $export->getContentType())
        );
        return $response;
    }
}
