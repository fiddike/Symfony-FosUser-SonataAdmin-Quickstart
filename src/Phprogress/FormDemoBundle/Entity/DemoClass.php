<?php
// src/Phprogress/FormDemoBundle/Entity/DemoClass.php

namespace Phprogress\FormDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DemoClass
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Phprogress\FormDemoBundle\Entity\DemoClassRepository")
 */
class DemoClass
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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Length(min = "4", max = "8")
     */
    private $demoString;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $demoText;

    private $demoInt;

    /**
     * @ORM\Column(type="float")
     */
    private $demoFloat;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $demoEmail;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $demoDate;

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
     * Set demoString
     *
     * @param string $demoString
     * @return DemoClass
     */
    public function setDemoString($demoString)
    {
        $this->demoString = $demoString;
    
        return $this;
    }

    /**
     * Get demoString
     *
     * @return string 
     */
    public function getDemoString()
    {
        return $this->demoString;
    }

    /**
     * Set demoText
     *
     * @param string $demoText
     * @return DemoClass
     */
    public function setDemoText($demoText)
    {
        $this->demoText = $demoText;
    
        return $this;
    }

    /**
     * Get demoText
     *
     * @return string 
     */
    public function getDemoText()
    {
        return $this->demoText;
    }

    /**
     * Set demoFloat
     *
     * @param float $demoFloat
     * @return DemoClass
     */
    public function setDemoFloat($demoFloat)
    {
        $this->demoFloat = $demoFloat;
    
        return $this;
    }

    /**
     * Get demoFloat
     *
     * @return float 
     */
    public function getDemoFloat()
    {
        return $this->demoFloat;
    }

    /**
     * Set demoEmail
     *
     * @param string $demoEmail
     * @return DemoClass
     */
    public function setDemoEmail($demoEmail)
    {
        $this->demoEmail = $demoEmail;
    
        return $this;
    }

    /**
     * Get demoEmail
     *
     * @return string 
     */
    public function getDemoEmail()
    {
        return $this->demoEmail;
    }

    /**
     * Set demoDate
     *
     * @param \DateTime $demoDate
     * @return DemoClass
     */
    public function setDemoDate($demoDate)
    {
        $this->demoDate = $demoDate;
    
        return $this;
    }

    /**
     * Get demoDate
     *
     * @return \DateTime 
     */
    public function getDemoDate()
    {
        return $this->demoDate;
    }
}