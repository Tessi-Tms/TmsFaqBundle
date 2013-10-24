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
        $faqs = array();
        if ($request->query->has('customer_id')) {
            if($request->query->has('search_query')){
                $customerId = $request->query->has('customer_id');
                $searchQuery = $request->query->has('search_query');
                $faq = $this->get('tms_faq.manager')->search($customerId, $searchQuery);
                $faqs = array($faq);
            }else{
                $faqs = array($this->get('tms_faq.manager.faq')->findOneBy(array(
                    'customerId' => $request->query->get('customer_id')
                )));
            }
            
        } else {
            $faqs = $this->get('tms_faq.manager.faq')->findAll();
        }

        $export = $this->get('idci_exporter.manager')->export($faqs, $format);
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

    /**
     * Search questions and match responses
     *
     * @Route("/search/{customerId}/{searchQuery}.{_format}", name="tms_faq_api_faqs_search", defaults={"_format"="json"})
     * @Method("GET")
     */
   /* public function searchAction(Request $request, $customerId, $searchQuery)
    {
        $format = $request->getRequestFormat();
        $faq = $this->get('tms_faq.manager')->search($customerId, $searchQuery);

        $export = $this->get('idci_exporter.manager')->export(array($faq, $format);

        $response = new Response();
        $response->setContent($export->getContent());
        $response->headers->set(
            'Content-Type',
            sprintf('%s; charset=UTF-8', $export->getContentType())
        );

        return $response;
    }*/
}
