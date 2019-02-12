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
        return new JsonResponse(['msg' => 'Serie Symfony 3.4 API Pessoa Controller']);
    }

    /**
     * @Route("/lista", name="api_pessoa")
     */
    public function index() {
        $pessoa = $this->getDoctrine()->getRepository('AppBundle:Pessoa')->findAll();
        return new JsonResponse($pessoa);
    }

}
