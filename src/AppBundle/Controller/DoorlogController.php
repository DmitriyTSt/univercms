<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Doorlog;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Doorlog controller.
 *
 * @Route("doorlog")
 */
class DoorlogController extends Controller
{
    /**
     * Lists all doorlog entities.
     *
     * @Route("/", name="doorlog_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $doorlogs = $em->getRepository('AppBundle:Doorlog')->findAll();

        return $this->render('doorlog/index.html.twig', array(
            'doorlogs' => $doorlogs,
        ));
    }

    /**
     * Creates a new doorlog entity.
     *
     * @Route("/new", name="doorlog_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $doorlog = new Doorlog();
        $form = $this->createForm('AppBundle\Form\DoorlogType', $doorlog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($doorlog);
            $em->flush();

            return $this->redirectToRoute('doorlog_show', array('id' => $doorlog->getId()));
        }

        return $this->render('doorlog/new.html.twig', array(
            'doorlog' => $doorlog,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a doorlog entity.
     *
     * @Route("/{id}", name="doorlog_show")
     * @Method("GET")
     */
    public function showAction(Doorlog $doorlog)
    {
        $deleteForm = $this->createDeleteForm($doorlog);

        return $this->render('doorlog/show.html.twig', array(
            'doorlog' => $doorlog,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing doorlog entity.
     *
     * @Route("/{id}/edit", name="doorlog_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Doorlog $doorlog)
    {
        $deleteForm = $this->createDeleteForm($doorlog);
        $editForm = $this->createForm('AppBundle\Form\DoorlogType', $doorlog);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('doorlog_edit', array('id' => $doorlog->getId()));
        }

        return $this->render('doorlog/edit.html.twig', array(
            'doorlog' => $doorlog,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a doorlog entity.
     *
     * @Route("/{id}", name="doorlog_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Doorlog $doorlog)
    {
        $form = $this->createDeleteForm($doorlog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($doorlog);
            $em->flush();
        }

        return $this->redirectToRoute('doorlog_index');
    }

    /**
     * Creates a form to delete a doorlog entity.
     *
     * @param Doorlog $doorlog The doorlog entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Doorlog $doorlog)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('doorlog_delete', array('id' => $doorlog->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
