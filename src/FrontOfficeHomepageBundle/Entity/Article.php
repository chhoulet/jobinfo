<?php

namespace FrontOfficeHomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeHomepageBundle\Entity\ArticleRepository")
 */
class Article
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
     * @ORM\ManyToOne(targetEntity="FrontOfficeUserBundle\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "250",
     *      max = "1500",
     *      minMessage = "Votre article doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre article ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateUpdated", type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeHomepageBundle\Entity\Comment", mappedBy="article")
     */
    private $comment;

     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeHomepageBundle\Entity\Category", inversedBy="article")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

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
     * @return Article
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
     * Set content
     *
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Article
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     * @return Article
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime 
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comment = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comment
     *
     * @param \FrontOfficeHomepageBundle\Entity\Comment $comment
     * @return Article
     */
    public function addComment(\FrontOfficeHomepageBundle\Entity\Comment $comment)
    {
        $this->comment[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \FrontOfficeHomepageBundle\Entity\Comment $comment
     */
    public function removeComment(\FrontOfficeHomepageBundle\Entity\Comment $comment)
    {
        $this->comment->removeElement($comment);
    }

    /**
     * Get comment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param \FrontOfficeUserBundle\Entity\User $author
     * @return Article
     */
    public function setAuthor(\FrontOfficeUserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \FrontOfficeUserBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Article
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set category
     *
     * @param \FrontOfficeHomepageBundle\Entity\Category $category
     * @return Article
     */
    public function setCategory(\FrontOfficeHomepageBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \FrontOfficeHomepageBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
