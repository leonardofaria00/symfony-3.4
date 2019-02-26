<?php

namespace AppBundle\Controller;

//require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Pessoa;

/**
 * Pessoa controller.
 *
 * @Route("/pessoa")
 */
class PessoaController extends Controller {

    /**
     * @Route("/", name="_index")
     * @Method("GET")
     */
    public function indexAction() {
        return $this->render('pessoa/index.html.twig');
    }

    /**
     * @Route("/sobre", name="_sobre")
     * @Method("GET")
     */
    public function sobreAction() {
        return $this->render('pessoa/sobre.html.twig');
    }

    /**
     * Gera relatório de pessoas cadastradas.
     *
     * @Route("/gerar", name="_gerar")
     * @Method("GET")
     */
    public function viewRelatorioAction() {
        $em = $this->getDoctrine()->getManager();

        $pessoas = $em->getRepository('AppBundle:Pessoa')->findAll();

        return $this->render('pessoa/pdfTemplate.html.twig', array('pessoas' => $pessoas,));
    }

    /**
     * Exporta os dados da grid de TipoAssunto para um PDF
     *
     * @Route("/pdf", name="_pdf")
     */
    public function exportPdfAction() {
        $em = $this->getDoctrine()->getManager();
        $pessoas = $em->getRepository('AppBundle:Pessoa')->findAll();

//    return $this->render('pessoa/templates/geraRelatorioPDF.html.twig', array('pessoas' => $pessoas,));
        $html = "<center><h1>Relatorio de Pessoas</h1></center>";
        return $this->renderPdf($pessoas, $html, ['margin-left' => '18',
                    'margin-top' => '25',
                    'margin-bottom' => '21',
                    'margin-right' => '10'
                        ], 'relatorio');
    }

    /**
     * Lists all pessoa entities.
     *
     * @Route("/view", name="_view")
     * @Method("GET")
     */
    public function listaAction() {
        $em = $this->getDoctrine()->getManager();

        $pessoas = $em->getRepository('AppBundle:Pessoa')->findAll();

        return $this->render('pessoa/view.html.twig', array('pessoas' => $pessoas,));
    }

    /**
     * Creates a new pessoa entity.
     *
     * @Route("/new", name="_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $pessoa = new Pessoa();
        $form = $this->createForm('AppBundle\Form\PessoaType', $pessoa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pessoa);
            $em->flush();

            return $this->redirectToRoute('_show', array('id' => $pessoa->getId()));
        }

        return $this->render('pessoa/new.html.twig', array('pessoa' => $pessoa, 'form' => $form->createView(),));
    }

    /**
     * Finds and displays a pessoa entity.
     *
     * @Route("/view/{id}", name="_show")
     * @Method("GET")
     */
    public function showAction(Pessoa $pessoa) {
        $deleteForm = $this->createDeleteForm($pessoa);

        return $this->render('pessoa/show.html.twig', array('pessoa' => $pessoa, 'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing pessoa entity.
     *
     * @Route("/{id}/edit", name="_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pessoa $pessoa) {
        $deleteForm = $this->createDeleteForm($pessoa);
        $editForm = $this->createForm('AppBundle\Form\PessoaType', $pessoa);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('_edit', array('id' => $pessoa->getId()));
        }

        return $this->render('pessoa/edit.html.twig', array('pessoa' => $pessoa, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Deletes a pessoa entity.
     *
     * @Route("/{id}", name="_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pessoa $pessoa) {
        $form = $this->createDeleteForm($pessoa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pessoa);
            $em->flush();
        }

        return $this->redirectToRoute('_index');
    }

    /**
     * Creates a form to delete a pessoa entity.
     *
     * @param Pessoa $pessoa The pessoa entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pessoa $pessoa) {
        return $this->createFormBuilder()->setAction($this->generateUrl('_delete', array('id' => $pessoa->getId())))->setMethod('DELETE')->getForm();
    }

    /**
     * Renderiza um array em formato PDF.
     * @param  [type] $arr [description]
     * @return [type]      [description]
     */
    public function renderPdf($data, $html, $option = [], $name = 'file') {
//    public function renderPdf($data, $cab = null, $cols = null, $template = 'BizlayBundle::exportpdf.html.twig', $option = [], $name = 'file') {

        $this->get('knp_snappy.pdf')->getOutputFromHtml($html, $option);
        return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html, $option), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $name . '.pdf"',
                ]
        );
    }

}
