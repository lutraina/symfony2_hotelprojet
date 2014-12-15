<?php

namespace Pousada\ElcapitanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Publication
 *
 * @ORM\Table(name="publications")
 * @ORM\Entity(repositoryClass="Pousada\ElcapitanBundle\Entity\PublicationRepository")
 */
class Publication
{
	
	/**
	 * @var ArrayCollection
	 * @ORM\OneToMany(targetEntity="Issue", mappedBy="publication")
	 */
	private $issues;
	

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

    public function __construct() {
	   $this->issues = new ArrayCollection();
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
     * @return Publication
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
     * Add issues
     *
     * @param \Pousada\ElcapitanBundle\Entity\Issue $issues
     * @return Publication
     */
    public function addIssue(\Pousada\ElcapitanBundle\Entity\Issue $issues)
    {
        $this->issues[] = $issues;

        return $this;
    }

    /**
     * Remove issues
     *
     * @param \Pousada\ElcapitanBundle\Entity\Issue $issues
     */
    public function removeIssue(\Pousada\ElcapitanBundle\Entity\Issue $issues)
    {
        $this->issues->removeElement($issues);
    }

    /**
     * Get issues
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIssues()
    {
        return $this->issues;
    }
	
	/**
     * Render a publication as a string
     *
     * @return string
     */
	public function __toString()
    {
        return $this->getName();
    }
}
