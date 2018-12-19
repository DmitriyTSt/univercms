<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Refreshercourse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Refreshercourse controller.
 *
 * @Route("refreshercourse")
 */
class RefreshercourseController extends Controller
{
    /**
     * Lists all refreshercourse entities.
     *
     * @Route("/", name="refreshercourse_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refreshercourses = $em->getRepository('AppBundle:Refreshercourse')->findAll();

        return $this->render('refreshercourse/index.html.twig', array(
            'refreshercourses' => $refreshercourses,
        ));
    }

    /**
     * Creates a new refreshercourse entity.
     *
     * @Route("/new", name="refreshercourse_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $refreshercourse = new Refreshercourse();
        $form = $this->createForm('AppBundle\Form\RefreshercourseType', $refreshercourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refreshercourse);
            $em->flush();

            return $this->redirectToRoute('refreshercourse_show', array('id' => $refreshercourse->getId()));
        }

        return $this->render('refreshercourse/new.html.twig', array(
            'refreshercourse' => $refreshercourse,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refreshercourse entity.
     *
     * @Route("/{id}", name="refreshercourse_show")
     * @Method("GET")
     */
    public function showAction(Refreshercourse $refreshercourse)
    {
        $deleteForm = $this->createDeleteForm($refreshercourse);

        return $this->render('refreshercourse/show.html.twig', array(
            'refreshercourse' => $refreshercourse,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refreshercourse entity.
     *
     * @Route("/{id}/edit", name="refreshercourse_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Refreshercourse $refreshercourse)
    {
        $deleteForm = $this->createDeleteForm($refreshercourse);
        $editForm = $this->createForm('AppBundle\Form\RefreshercourseType', $refreshercourse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('refreshercourse_edit', array('id' => $refreshercourse->getId()));
        }

        return $this->render('refreshercourse/edit.html.twig', array(
            'refreshercourse' => $refreshercourse,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refreshercourse entity.
     *
     * @Route("/{id}", name="refreshercourse_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Refreshercourse $refreshercourse)
    {
        $form = $this->createDeleteForm($refreshercourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($refreshercourse);
            $em->flush();
        }

        return $this->redirectToRoute('refreshercourse_index');
    }

    /**
     * Creates a form to delete a refreshercourse entity.
     *
     * @param Refreshercourse $refreshercourse The refreshercourse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Refreshercourse $refreshercourse)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refreshercourse_delete', array('id' => $refreshercourse->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
