<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bonustransaction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Bonustransaction controller.
 *
 * @Route("bonustransaction")
 */
class BonustransactionController extends Controller
{
    /**
     * Lists all bonustransaction entities.
     *
     * @Route("/", name="bonustransaction_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bonustransactions = $em->getRepository('AppBundle:Bonustransaction')->findAll();

        return $this->render('bonustransaction/index.html.twig', array(
            'bonustransactions' => $bonustransactions,
        ));
    }

    /**
     * Creates a new bonustransaction entity.
     *
     * @Route("/new", name="bonustransaction_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bonustransaction = new Bonustransaction();
        $form = $this->createForm('AppBundle\Form\BonustransactionType', $bonustransaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bonustransaction);
            $em->flush();

            return $this->redirectToRoute('bonustransaction_show', array('id' => $bonustransaction->getId()));
        }

        return $this->render('bonustransaction/new.html.twig', array(
            'bonustransaction' => $bonustransaction,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bonustransaction entity.
     *
     * @Route("/{id}", name="bonustransaction_show")
     * @Method("GET")
     */
    public function showAction(Bonustransaction $bonustransaction)
    {
        $deleteForm = $this->createDeleteForm($bonustransaction);

        return $this->render('bonustransaction/show.html.twig', array(
            'bonustransaction' => $bonustransaction,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bonustransaction entity.
     *
     * @Route("/{id}/edit", name="bonustransaction_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Bonustransaction $bonustransaction)
    {
        $deleteForm = $this->createDeleteForm($bonustransaction);
        $editForm = $this->createForm('AppBundle\Form\BonustransactionType', $bonustransaction);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bonustransaction_edit', array('id' => $bonustransaction->getId()));
        }

        return $this->render('bonustransaction/edit.html.twig', array(
            'bonustransaction' => $bonustransaction,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bonustransaction entity.
     *
     * @Route("/{id}", name="bonustransaction_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Bonustransaction $bonustransaction)
    {
        $form = $this->createDeleteForm($bonustransaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bonustransaction);
            $em->flush();
        }

        return $this->redirectToRoute('bonustransaction_index');
    }

    /**
     * Creates a form to delete a bonustransaction entity.
     *
     * @param Bonustransaction $bonustransaction The bonustransaction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bonustransaction $bonustransaction)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bonustransaction_delete', array('id' => $bonustransaction->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
