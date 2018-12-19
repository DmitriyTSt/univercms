<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Holiday;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Holiday controller.
 *
 * @Route("holiday")
 */
class HolidayController extends Controller
{
    /**
     * Lists all holiday entities.
     *
     * @Route("/", name="holiday_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $holidays = $em->getRepository('AppBundle:Holiday')->findAll();

        return $this->render('holiday/index.html.twig', array(
            'holidays' => $holidays,
        ));
    }

    /**
     * Creates a new holiday entity.
     *
     * @Route("/new", name="holiday_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $holiday = new Holiday();
        $form = $this->createForm('AppBundle\Form\HolidayType', $holiday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($holiday);
            $em->flush();

            return $this->redirectToRoute('holiday_show', array('id' => $holiday->getId()));
        }

        return $this->render('holiday/new.html.twig', array(
            'holiday' => $holiday,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a holiday entity.
     *
     * @Route("/{id}", name="holiday_show")
     * @Method("GET")
     */
    public function showAction(Holiday $holiday)
    {
        $deleteForm = $this->createDeleteForm($holiday);

        return $this->render('holiday/show.html.twig', array(
            'holiday' => $holiday,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing holiday entity.
     *
     * @Route("/{id}/edit", name="holiday_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Holiday $holiday)
    {
        $deleteForm = $this->createDeleteForm($holiday);
        $editForm = $this->createForm('AppBundle\Form\HolidayType', $holiday);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('holiday_edit', array('id' => $holiday->getId()));
        }

        return $this->render('holiday/edit.html.twig', array(
            'holiday' => $holiday,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a holiday entity.
     *
     * @Route("/{id}", name="holiday_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Holiday $holiday)
    {
        $form = $this->createDeleteForm($holiday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($holiday);
            $em->flush();
        }

        return $this->redirectToRoute('holiday_index');
    }

    /**
     * Creates a form to delete a holiday entity.
     *
     * @param Holiday $holiday The holiday entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Holiday $holiday)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('holiday_delete', array('id' => $holiday->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
