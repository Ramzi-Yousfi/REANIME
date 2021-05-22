<?php

namespace App\Entity;

use App\Repository\HomeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HomeRepository::class)
 */
class Home
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $section1Image;

    /**
     * @ORM\Column(type="text")
     */
    private $section1Text;

    /**
     * @ORM\Column(type="text")
     */
    private $section2text1;

    /**
     * @ORM\Column(type="text")
     */
    private $section2Text2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $section1Titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $section2Titre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSection1Image(): ?string
    {
        return $this->section1Image;
    }

    public function setSection1Image(string $section1Image): self
    {
        $this->section1Image = $section1Image;

        return $this;
    }

    public function getSection1Text(): ?string
    {
        return $this->section1Text;
    }

    public function setSection1Text(string $section1Text): self
    {
        $this->section1Text = $section1Text;

        return $this;
    }

    public function getSection2text1(): ?string
    {
        return $this->section2text1;
    }

    public function setSection2text1(string $section2text1): self
    {
        $this->section2text1 = $section2text1;

        return $this;
    }

    public function getSection2Text2(): ?string
    {
        return $this->section2Text2;
    }

    public function setSection2Text2(string $section2Text2): self
    {
        $this->section2Text2 = $section2Text2;

        return $this;
    }

    public function getSection1Titre(): ?string
    {
        return $this->section1Titre;
    }

    public function setSection1Titre(string $section1Titre): self
    {
        $this->section1Titre = $section1Titre;

        return $this;
    }

    public function getSection2Titre(): ?string
    {
        return $this->section2Titre;
    }

    public function setSection2Titre(?string $section2Titre): self
    {
        $this->section2Titre = $section2Titre;

        return $this;
    }
}
