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
    public function indexAction() {
        return $this->render('pessoa/index.html.twig');
    }

    /**
     * @Route("/lista", name="api_pessoa_listaAction")
     */
    public function listaAction() {
        $pessoas = $this->getDoctrine()->getRepository('AppBundle:Pessoa')->findAll();
        return $this->render('pessoa/view.html.twig', ['pessoa' => $pessoas]);
    }

    /**
     * @Route("/lista/{id}", name="api_pessoa_showAction")
     */
    public function showAction(Pessoa $id) {
//        $pessoa = $this->getDoctrine()->getRepository('AppBundle:Pessoa')->findBy($id);
//        return $this->render('pessoa/index.html.twig', ['pessoa' => $pessoa]);
    }

    /**
     * @Route("/add", name="api_pessoa_addAction")
     */
    public function addAction() {
        return $this->render('pessoa/adiciona.html.twig');
    }

    /**
     * @Route("/sobre", name="api_pessoa_sobre")
     */
    public function sobreAction() {
        return $this->render('pessoa/sobre.html.twig');
    }

    /**
     * @Route("/add/salva", name="api_pessoa_salvaAction")
     */
    public function salvaAction() {
        echo 'Salvando Pessoa...';
    }

}
