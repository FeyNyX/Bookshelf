<?php

namespace BookshelfBundle\Controller;

use BookshelfBundle\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
        );
    }

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
     * @Method("POST")
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

        if ($form->isValid()) {
            // The rest of the code is run only when the form passes the validation.
            $em = $this->getDoctrine()->getManager();
            $em->persist($newReview);

            // New review is being added to the book.
            $repo = $this->getDoctrine()->getRepository("BookshelfBundle:Book");
            $book = $repo->find($bookId);
            $book->addReview($newReview);

            // New book is being added to the review.
            $newReview->setBook($book);

            $em->flush();

            return $this->redirectToRoute("bookshelf_book_show", array("id" => $bookId));
        } else {
            // "bookId" is being passed again, so that the action still knows which book is being edited.
            return $this->render("BookshelfBundle:Review:createForm.html.twig", array("bookId" => $bookId, "form" => $form, "errors" => $errors));
        }
    }

    /**
     * @Route("/delete/{id}")
     * @Method("POST")
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
