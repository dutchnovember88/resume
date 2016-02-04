<?php

namespace ResumeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ResumeBundle\Entity\GeneralSkills;
use ResumeBundle\Form\GeneralSkillsType;

/**
 * GeneralSkills controller.
 *
 * @Route("/generalskills")
 */
class GeneralSkillsController extends Controller
{
    /**
     * Lists all GeneralSkills entities.
     *
     * @Route("/", name="generalskills_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $generalSkills = $em->getRepository('ResumeBundle:GeneralSkills')->findAll();

        return $this->render('generalskills/index.html.twig', array(
            'generalSkills' => $generalSkills,
        ));
    }

    /**
     * Creates a new GeneralSkills entity.
     *
     * @Route("/new", name="generalskills_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $generalSkill = new GeneralSkills();
        $form = $this->createForm('ResumeBundle\Form\GeneralSkillsType', $generalSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($generalSkill);
            $em->flush();

            return $this->redirectToRoute('generalskills_show', array('id' => $generalskills->getId()));
        }

        return $this->render('generalskills/new.html.twig', array(
            'generalSkill' => $generalSkill,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a GeneralSkills entity.
     *
     * @Route("/{id}", name="generalskills_show")
     * @Method("GET")
     */
    public function showAction(GeneralSkills $generalSkill)
    {
        $deleteForm = $this->createDeleteForm($generalSkill);

        return $this->render('generalskills/show.html.twig', array(
            'generalSkill' => $generalSkill,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing GeneralSkills entity.
     *
     * @Route("/{id}/edit", name="generalskills_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GeneralSkills $generalSkill)
    {
        $deleteForm = $this->createDeleteForm($generalSkill);
        $editForm = $this->createForm('ResumeBundle\Form\GeneralSkillsType', $generalSkill);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($generalSkill);
            $em->flush();

            return $this->redirectToRoute('generalskills_edit', array('id' => $generalSkill->getId()));
        }

        return $this->render('generalskills/edit.html.twig', array(
            'generalSkill' => $generalSkill,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a GeneralSkills entity.
     *
     * @Route("/{id}", name="generalskills_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GeneralSkills $generalSkill)
    {
        $form = $this->createDeleteForm($generalSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($generalSkill);
            $em->flush();
        }

        return $this->redirectToRoute('generalskills_index');
    }

    /**
     * Creates a form to delete a GeneralSkills entity.
     *
     * @param GeneralSkills $generalSkill The GeneralSkills entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GeneralSkills $generalSkill)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('generalskills_delete', array('id' => $generalSkill->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
