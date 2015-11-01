<?php

namespace BookshelfBundle\Controller;

use BookshelfBundle\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ReviewController
 * @package BookshelfBundle\Controller
 * @Route("/review")
 */
class ReviewController extends Controller
{
    /**
     * @Route("/show/{id}")
     * @Template()
     */
    public function showAction($id)
    {
        $repo = $this->getDoctrine()->getRepository("BookshelfBundle:Review");
        $review = $repo->find($id);

        return array(
                "review" => $review
            );    }

    /**
     * @Route("/createForm/{bookId}")
     * @Template()
     */
    public function createFormAction($bookId)
    {
        $form = $this->createFormBuilder()
            ->add("subject", "text")
            ->add("review", "textarea")
            ->add("save", "submit")
            ->getForm();

        return array(
                "form" => $form->createView(),
                "bookId" => $bookId
            );
    }

    /**
     * @Route("/create/{bookId}")
     */
    public function createAction(Request $request, $bookId)
    {
        $newReview = new Review();

        $form = $this->createFormBuilder($newReview)
            ->add("subject", "text")
            ->add("review", "textarea")
            ->add("save", "submit")
            ->getForm();

        $form->handleRequest($request);

        $validator = $this->get("validator");
        $errors = $validator->validate($form);

        $em = $this->getDoctrine()->getManager();
        $em->persist($newReview);

        $repo = $this->getDoctrine()->getRepository("BookshelfBundle:Book");
        $book = $repo->find($bookId);
        $book->addReview($newReview);

        $newReview->setBook($book);

        $em->flush();

        if($form->isValid()){
            return $this->redirectToRoute("bookshelf_book_show", array("id" => $bookId));
        } else {
            return $this->render("BookshelfBundle:Review:createForm.html.twig", array("bookId" => $bookId, "form" => $form, "errors" => $errors));
        }
    }

    /**
     * @Route("/delete/{id}")
     */
    public function deleteAction($id)
    {
        $repo = $this->getDoctrine()->getRepository("BookshelfBundle:Review");
        $review = $repo->find($id);

        $bookId = $review->getBook()->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($review);
        $em->flush();

        return $this->redirectToRoute("bookshelf_book_show", array("id" => $bookId));
    }

}
