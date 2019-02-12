<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/pessoa")
 */
class PessoaController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        return new JsonResponse(['msg' => 'PessoaController']);
    }

    /**
     * @Route("/lista", name="api_pessoa")
     */
    public function index() {
        $pessoa = $this->getDoctrine()->getRepository('AppBundle:Pessoa')->findAll();
        
        $pessoa = $this->get('jms_serializer')->serialize($pessoa, 'json');
        
        $response = new Response($pessoa);
        return new JsonResponse($pessoa);
    }

}
