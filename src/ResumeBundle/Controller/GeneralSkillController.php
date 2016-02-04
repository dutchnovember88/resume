<?php

namespace ResumeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ResumeBundle\Entity\GeneralSkill;
use ResumeBundle\Form\GeneralSkillType;

/**
 * GeneralSkill controller.
 *
 * @Route("/generalskill")
 */
class GeneralSkillController extends Controller
{
    /**
     * Lists all GeneralSkill entities.
     *
     * @Route("/", name="generalskill_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $generalSkills = $em->getRepository('ResumeBundle:GeneralSkill')->findAll();

        return $this->render('generalskill/index.html.twig', array(
            'generalSkills' => $generalSkills,
        ));
    }

    /**
     * Creates a new GeneralSkill entity.
     *
     * @Route("/new", name="generalskill_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $generalSkill = new GeneralSkill();
        $form = $this->createForm('ResumeBundle\Form\GeneralSkillType', $generalSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($generalSkill);
            $em->flush();

            return $this->redirectToRoute('generalskill_show', array('id' => $generalskill->getId()));
        }

        return $this->render('generalskill/new.html.twig', array(
            'generalSkill' => $generalSkill,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a GeneralSkill entity.
     *
     * @Route("/{id}", name="generalskill_show")
     * @Method("GET")
     */
    public function showAction(GeneralSkill $generalSkill)
    {
        $deleteForm = $this->createDeleteForm($generalSkill);

        return $this->render('generalskill/show.html.twig', array(
            'generalSkill' => $generalSkill,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing GeneralSkill entity.
     *
     * @Route("/{id}/edit", name="generalskill_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GeneralSkill $generalSkill)
    {
        $deleteForm = $this->createDeleteForm($generalSkill);
        $editForm = $this->createForm('ResumeBundle\Form\GeneralSkillType', $generalSkill);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($generalSkill);
            $em->flush();

            return $this->redirectToRoute('generalskill_edit', array('id' => $generalSkill->getId()));
        }

        return $this->render('generalskill/edit.html.twig', array(
            'generalSkill' => $generalSkill,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a GeneralSkill entity.
     *
     * @Route("/{id}", name="generalskill_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GeneralSkill $generalSkill)
    {
        $form = $this->createDeleteForm($generalSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($generalSkill);
            $em->flush();
        }

        return $this->redirectToRoute('generalskill_index');
    }

    /**
     * Creates a form to delete a GeneralSkill entity.
     *
     * @param GeneralSkill $generalSkill The GeneralSkill entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GeneralSkill $generalSkill)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('generalskill_delete', array('id' => $generalSkill->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
