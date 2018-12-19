<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Holidaytype;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Holidaytype controller.
 *
 * @Route("holidaytype")
 */
class HolidaytypeController extends Controller
{
    /**
     * Lists all holidaytype entities.
     *
     * @Route("/", name="holidaytype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $holidaytypes = $em->getRepository('AppBundle:Holidaytype')->findAll();

        return $this->render('holidaytype/index.html.twig', array(
            'holidaytypes' => $holidaytypes,
        ));
    }

    /**
     * Creates a new holidaytype entity.
     *
     * @Route("/new", name="holidaytype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $holidaytype = new Holidaytype();
        $form = $this->createForm('AppBundle\Form\HolidaytypeType', $holidaytype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($holidaytype);
            $em->flush();

            return $this->redirectToRoute('holidaytype_show', array('id' => $holidaytype->getId()));
        }

        return $this->render('holidaytype/new.html.twig', array(
            'holidaytype' => $holidaytype,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a holidaytype entity.
     *
     * @Route("/{id}", name="holidaytype_show")
     * @Method("GET")
     */
    public function showAction(Holidaytype $holidaytype)
    {
        $deleteForm = $this->createDeleteForm($holidaytype);

        return $this->render('holidaytype/show.html.twig', array(
            'holidaytype' => $holidaytype,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing holidaytype entity.
     *
     * @Route("/{id}/edit", name="holidaytype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Holidaytype $holidaytype)
    {
        $deleteForm = $this->createDeleteForm($holidaytype);
        $editForm = $this->createForm('AppBundle\Form\HolidaytypeType', $holidaytype);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('holidaytype_edit', array('id' => $holidaytype->getId()));
        }

        return $this->render('holidaytype/edit.html.twig', array(
            'holidaytype' => $holidaytype,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a holidaytype entity.
     *
     * @Route("/{id}", name="holidaytype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Holidaytype $holidaytype)
    {
        $form = $this->createDeleteForm($holidaytype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($holidaytype);
            $em->flush();
        }

        return $this->redirectToRoute('holidaytype_index');
    }

    /**
     * Creates a form to delete a holidaytype entity.
     *
     * @param Holidaytype $holidaytype The holidaytype entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Holidaytype $holidaytype)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('holidaytype_delete', array('id' => $holidaytype->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
