<?php

namespace ResumeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ResumeBundle\Entity\SpecificSkill;
use ResumeBundle\Form\SpecificSkillType;

/**
 * SpecificSkill controller.
 *
 * @Route("/specificskill")
 */
class SpecificSkillController extends Controller
{
    /**
     * Lists all SpecificSkill entities.
     *
     * @Route("/", name="specificskill_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $specificSkills = $em->getRepository('ResumeBundle:SpecificSkill')->findAll();

        return $this->render('specificskill/index.html.twig', array(
            'specificSkills' => $specificSkills,
        ));
    }

    /**
     * Creates a new SpecificSkill entity.
     *
     * @Route("/new", name="specificskill_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $specificSkill = new SpecificSkill();
        $form = $this->createForm('ResumeBundle\Form\SpecificSkillType', $specificSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($specificSkill);
            $em->flush();

            return $this->redirectToRoute('specificskill_show', array('id' => $specificskill->getId()));
        }

        return $this->render('specificskill/new.html.twig', array(
            'specificSkill' => $specificSkill,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SpecificSkill entity.
     *
     * @Route("/{id}", name="specificskill_show")
     * @Method("GET")
     */
    public function showAction(SpecificSkill $specificSkill)
    {
        $deleteForm = $this->createDeleteForm($specificSkill);

        return $this->render('specificskill/show.html.twig', array(
            'specificSkill' => $specificSkill,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SpecificSkill entity.
     *
     * @Route("/{id}/edit", name="specificskill_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SpecificSkill $specificSkill)
    {
        $deleteForm = $this->createDeleteForm($specificSkill);
        $editForm = $this->createForm('ResumeBundle\Form\SpecificSkillType', $specificSkill);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($specificSkill);
            $em->flush();

            return $this->redirectToRoute('specificskill_edit', array('id' => $specificSkill->getId()));
        }

        return $this->render('specificskill/edit.html.twig', array(
            'specificSkill' => $specificSkill,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SpecificSkill entity.
     *
     * @Route("/{id}", name="specificskill_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SpecificSkill $specificSkill)
    {
        $form = $this->createDeleteForm($specificSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($specificSkill);
            $em->flush();
        }

        return $this->redirectToRoute('specificskill_index');
    }

    /**
     * Creates a form to delete a SpecificSkill entity.
     *
     * @param SpecificSkill $specificSkill The SpecificSkill entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SpecificSkill $specificSkill)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('specificskill_delete', array('id' => $specificSkill->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
