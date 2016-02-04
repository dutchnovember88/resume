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

}
