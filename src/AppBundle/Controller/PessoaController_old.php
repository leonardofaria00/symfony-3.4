<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class PessoaController_old extends Controller {

    /**
     * @Route("/", name="homepagea")
     */
    public function indexAction(Request $request) {
        return new JsonResponse(['msg' => 'PessoaController_old']);
    }

    /**
     * @Route("/add")
     */
    public function addController() {
        return $this->render('pessoa/add.xhtml.twig');
    }

//    public function listController() {
//        return $this->render('pessoa/list.xhtml.twig');
//    }
//    public function updateController(Request $id) {
//        return $this->render('pessoa/update.xhtml.twig', ['idPessoa' => $id]);
//    }
}
