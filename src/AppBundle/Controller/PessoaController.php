<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Pessoa;

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

        $response = new Response($pessoa, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/lista/{id}", name="api_pessoa_show")
     */
    public function show(Pessoa $pessoa) {
        $pessoa = $this->get('jms_serializer')->serialize($pessoa, 'json');

        $response = new Response($pessoa, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
