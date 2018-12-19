<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Userhistory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Userhistory controller.
 *
 * @Route("userhistory")
 */
class UserhistoryController extends Controller
{
    /**
     * Lists all userhistory entities.
     *
     * @Route("/", name="userhistory_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userhistories = $em->getRepository('AppBundle:Userhistory')->findAll();

        return $this->render('userhistory/index.html.twig', array(
            'userhistories' => $userhistories,
        ));
    }

    /**
     * Creates a new userhistory entity.
     *
     * @Route("/new", name="userhistory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userhistory = new Userhistory();
        $form = $this->createForm('AppBundle\Form\UserhistoryType', $userhistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userhistory);
            $em->flush();

            return $this->redirectToRoute('userhistory_show', array('id' => $userhistory->getId()));
        }

        return $this->render('userhistory/new.html.twig', array(
            'userhistory' => $userhistory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a userhistory entity.
     *
     * @Route("/{id}", name="userhistory_show")
     * @Method("GET")
     */
    public function showAction(Userhistory $userhistory)
    {
        $deleteForm = $this->createDeleteForm($userhistory);

        return $this->render('userhistory/show.html.twig', array(
            'userhistory' => $userhistory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userhistory entity.
     *
     * @Route("/{id}/edit", name="userhistory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Userhistory $userhistory)
    {
        $deleteForm = $this->createDeleteForm($userhistory);
        $editForm = $this->createForm('AppBundle\Form\UserhistoryType', $userhistory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userhistory_edit', array('id' => $userhistory->getId()));
        }

        return $this->render('userhistory/edit.html.twig', array(
            'userhistory' => $userhistory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userhistory entity.
     *
     * @Route("/{id}", name="userhistory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Userhistory $userhistory)
    {
        $form = $this->createDeleteForm($userhistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userhistory);
            $em->flush();
        }

        return $this->redirectToRoute('userhistory_index');
    }

    /**
     * Creates a form to delete a userhistory entity.
     *
     * @param Userhistory $userhistory The userhistory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Userhistory $userhistory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userhistory_delete', array('id' => $userhistory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
