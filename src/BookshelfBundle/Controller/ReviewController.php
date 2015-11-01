<?php

namespace BookshelfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ReviewController
 * @package BookshelfBundle\Controller
 * @Route("/review")
 */
class ReviewController extends Controller
{
    /**
     * @Route("/show")
     * @Template()
     */
    public function showAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/createForm")
     * @Template()
     */
    public function createFormAction()
    {
        return array(
                // ...
            );
    }

    /**
     * @Route("/create")
     * @Template()
     */
    public function createAction()
    {
        return array(
                // ...
            );
    }

    /**
     * @Route("/delete")
     * @Template()
     */
    public function deleteAction()
    {
        return array(
                // ...
            );    }

}
