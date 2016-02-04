<?php

namespace ResumeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/resume")
 */
class ResumeController extends Controller
{
    /**
     * @Route("/flat")
     */
    public function flatAction()
    {
        return $this->render('ResumeBundle:Resume:flat.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/edit")
     */
    public function editAction()
    {
        return $this->render('ResumeBundle:Resume:edit.html.twig', array(
            // ...
        ));
    }

}
