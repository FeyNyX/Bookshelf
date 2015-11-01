<?php

namespace BookshelfBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Book
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Book
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="pagesNo", type="integer")
     */
    private $pagesNo;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="decimal")
     */
    private $rating;

    /**
     * @ManyToOne(targetEntity="Author", inversedBy="books")
     */
    private $author;

    /**
     * @OneToMany(targetEntity="Review", mappedBy="book")
     */
    private $reviews;

    public function __construct(){
        $this->reviews = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Book
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Book
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set pagesNo
     *
     * @param integer $pagesNo
     *
     * @return Book
     */
    public function setPagesNo($pagesNo)
    {
        $this->pagesNo = $pagesNo;

        return $this;
    }

    /**
     * Get pagesNo
     *
     * @return integer
     */
    public function getPagesNo()
    {
        return $this->pagesNo;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set rating
     *
     * @param string $rating
     *
     * @return Book
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set author
     *
     * @param \BookshelfBundle\Entity\Author $author
     *
     * @return Book
     */
    public function setAuthor(\BookshelfBundle\Entity\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \BookshelfBundle\Entity\Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add review
     *
     * @param \BookshelfBundle\Entity\Review $review
     *
     * @return Book
     */
    public function addReview(\BookshelfBundle\Entity\Review $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \BookshelfBundle\Entity\Review $review
     */
    public function removeReview(\BookshelfBundle\Entity\Review $review)
    {
        $this->reviews->removeElement($review);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews()
    {
        return $this->reviews;
    }
}
