<?php

namespace BookshelfBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Review
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Review
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="review", type="string", length=600)
     */
    private $review;

    /**
     * @ManyToOne(targetEntity="Book", inversedBy="reviews")
     */
    private $book;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_deleted", type="integer")
     */
    private $isDeleted = 0;

    /**
     * Set isDeleted
     *
     * @param integer $isDeleted
     *
     * @return integer
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return integer
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Review
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set review
     *
     * @param string $review
     *
     * @return Review
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set book
     *
     * @param \BookshelfBundle\Entity\Book $book
     *
     * @return Review
     */
    public function setBook(\BookshelfBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \BookshelfBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }
}
