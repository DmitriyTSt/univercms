<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bonusreason;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Bonusreason controller.
 *
 * @Route("bonusreason")
 */
class BonusreasonController extends Controller
{
    /**
     * Lists all bonusreason entities.
     *
     * @Route("/", name="bonusreason_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bonusreasons = $em->getRepository('AppBundle:Bonusreason')->findAll();

        return $this->render('bonusreason/index.html.twig', array(
            'bonusreasons' => $bonusreasons,
        ));
    }

    /**
     * Creates a new bonusreason entity.
     *
     * @Route("/new", name="bonusreason_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bonusreason = new Bonusreason();
        $form = $this->createForm('AppBundle\Form\BonusreasonType', $bonusreason);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bonusreason);
            $em->flush();

            return $this->redirectToRoute('bonusreason_show', array('id' => $bonusreason->getId()));
        }

        return $this->render('bonusreason/new.html.twig', array(
            'bonusreason' => $bonusreason,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bonusreason entity.
     *
     * @Route("/{id}", name="bonusreason_show")
     * @Method("GET")
     */
    public function showAction(Bonusreason $bonusreason)
    {
        $deleteForm = $this->createDeleteForm($bonusreason);

        return $this->render('bonusreason/show.html.twig', array(
            'bonusreason' => $bonusreason,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bonusreason entity.
     *
     * @Route("/{id}/edit", name="bonusreason_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Bonusreason $bonusreason)
    {
        $deleteForm = $this->createDeleteForm($bonusreason);
        $editForm = $this->createForm('AppBundle\Form\BonusreasonType', $bonusreason);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bonusreason_edit', array('id' => $bonusreason->getId()));
        }

        return $this->render('bonusreason/edit.html.twig', array(
            'bonusreason' => $bonusreason,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bonusreason entity.
     *
     * @Route("/{id}", name="bonusreason_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Bonusreason $bonusreason)
    {
        $form = $this->createDeleteForm($bonusreason);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bonusreason);
            $em->flush();
        }

        return $this->redirectToRoute('bonusreason_index');
    }

    /**
     * Creates a form to delete a bonusreason entity.
     *
     * @param Bonusreason $bonusreason The bonusreason entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bonusreason $bonusreason)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bonusreason_delete', array('id' => $bonusreason->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
