<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cmsuser;
use AppBundle\Entity\Department;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Cmsuser controller.
 *
 * @Route("cmsuser")
 */
class CmsuserController extends Controller
{
    /**
     * Lists all cmsuser entities.
     *
     * @Route("/", name="cmsuser_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cmsusers = $em->getRepository('AppBundle:Cmsuser')->findAll();

        return $this->render('cmsuser/index.html.twig', array(
            'cmsusers' => $cmsusers,
        ));
    }

    /**
     * Lists all cmsuser where department.
     *
     * @Route("/search/", name="cmsuser_search_by_department")
     * @Method("GET")
     */
    public function searchByDepartment(Request $request) {
        $users = [];
        $department = null;
        if ($request->query->has("department")) {
            $departmentString = $request->query->get("department");
            $department = $this->getDoctrine()->getManager()->getRepository(Department::class)
                ->findOneBy(['name' => $departmentString]);
            $users = $this->getDoctrine()->getManager()->getRepository(Cmsuser::class)
                ->findBy(['department' => $department]);
        }
        return $this->render('cmsuser/usersByDepartment.html.twig', array(
            'department' => $department,
            'cmsusers' => $users,
        ));
    }

    /**
     * Creates a new cmsuser entity.
     *
     * @Route("/new", name="cmsuser_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cmsuser = new Cmsuser();
        $form = $this->createForm('AppBundle\Form\CmsuserType', $cmsuser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cmsuser);
            $em->flush();

            return $this->redirectToRoute('cmsuser_show', array('id' => $cmsuser->getId()));
        }

        return $this->render('cmsuser/new.html.twig', array(
            'cmsuser' => $cmsuser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cmsuser entity.
     *
     * @Route("/{id}", name="cmsuser_show")
     * @Method("GET")
     */
    public function showAction(Cmsuser $cmsuser)
    {
        $deleteForm = $this->createDeleteForm($cmsuser);

        $em = $this->getDoctrine()->getManager();

        return $this->render('cmsuser/show.html.twig', array(
            'cmsuser' => $cmsuser,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cmsuser entity.
     *
     * @Route("/{id}/edit", name="cmsuser_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cmsuser $cmsuser)
    {
        $deleteForm = $this->createDeleteForm($cmsuser);
        $editForm = $this->createForm('AppBundle\Form\CmsuserType', $cmsuser);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cmsuser_edit', array('id' => $cmsuser->getId()));
        }

        return $this->render('cmsuser/edit.html.twig', array(
            'cmsuser' => $cmsuser,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cmsuser entity.
     *
     * @Route("/{id}", name="cmsuser_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cmsuser $cmsuser)
    {
        $form = $this->createDeleteForm($cmsuser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cmsuser);
            $em->flush();
        }

        return $this->redirectToRoute('cmsuser_index');
    }

    /**
     * Creates a form to delete a cmsuser entity.
     *
     * @param Cmsuser $cmsuser The cmsuser entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cmsuser $cmsuser)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cmsuser_delete', array('id' => $cmsuser->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
