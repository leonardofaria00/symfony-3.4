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
     * @Route("/", name="api_pessoa_indexAction")
     */
    public function indexAction(Request $request) {
        return new JsonResponse(['msg' => 'PessoaController']);
    }

    /**
     * @Route("/lista", name="api_pessoa_listaAction")
     */
    public function listaAction() {
        $pessoa = $this->getDoctrine()->getRepository('AppBundle:Pessoa')->findAll();
        $pessoa = $this->get('jms_serializer')->serialize($pessoa, 'json');

        $response = new Response($pessoa);
//        $response->headers->set('Content-Type', 'application/json');
//        return $response;
        return $this->render('pessoa/index.html.twig', ['pessoas' => $response]);
//        return $this->renderView('pessoa/index.html.twig', ['pessoas' => $response]);
//        return $this->renderJson('pessoa/index.html.twig', ['pessoas' => $response]);
    }

    /**
     * @Route("/lista/{id}", name="api_pessoa_showAction")
     */
    public function showAction(Pessoa $pessoa) {
        $pessoa = $this->get('jms_serializer')->serialize($pessoa, 'json');

        $response = new Response($pessoa, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/add", name="api_pessoa_addAction")
     */
    public function addAction() {
        return $this->render('pessoa/adiciona.html.twig');
    }

}
