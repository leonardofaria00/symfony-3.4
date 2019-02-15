<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pessoa2;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Pessoa2 controller.
 *
 * @Route("pessoa2")
 */
class Pessoa2Controller extends Controller {

    /**
     * Lists all pessoa2 entities.
     *
     * @Route("/", name="pessoa2_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $pessoa2s = $em->getRepository('AppBundle:Pessoa2')->findAll();

        return $this->render('pessoa2/index.html.twig', array(
                    'pessoa2s' => $pessoa2s,
        ));
    }

    /**
     * Creates a new pessoa2 entity.
     *
     * @Route("/new", name="pessoa2_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $pessoa2 = new Pessoa2();
        $form = $this->createForm('AppBundle\Form\Pessoa2Type', $pessoa2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pessoa2);
            $em->flush();

            return $this->redirectToRoute('pessoa2_show', array('id' => $pessoa2->getId()));
        }

        return $this->render('pessoa2/new.html.twig', array(
                    'pessoa2' => $pessoa2,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pessoa2 entity.
     *
     * @Route("/{id}", name="pessoa2_show")
     * @Method("GET")
     */
    public function showAction(Pessoa2 $pessoa2) {
        $deleteForm = $this->createDeleteForm($pessoa2);

        return $this->render('pessoa2/show.html.twig', array(
                    'pessoa2' => $pessoa2,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pessoa2 entity.
     *
     * @Route("/{id}/edit", name="pessoa2_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pessoa2 $pessoa2) {
        $deleteForm = $this->createDeleteForm($pessoa2);
        $editForm = $this->createForm('AppBundle\Form\Pessoa2Type', $pessoa2);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pessoa2_edit', array('id' => $pessoa2->getId()));
        }

        return $this->render('pessoa2/edit.html.twig', array(
                    'pessoa2' => $pessoa2,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pessoa2 entity.
     *
     * @Route("/{id}", name="pessoa2_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pessoa2 $pessoa2) {
        $form = $this->createDeleteForm($pessoa2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pessoa2);
            $em->flush();
        }

        return $this->redirectToRoute('pessoa2_index');
    }

    /**
     * Creates a form to delete a pessoa2 entity.
     *
     * @param Pessoa2 $pessoa2 The pessoa2 entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pessoa2 $pessoa2) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('pessoa2_delete', array('id' => $pessoa2->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
