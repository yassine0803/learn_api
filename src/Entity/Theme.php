<?php
# src/App/Entity/Theme.php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Place;

/**
 * @ORM\Entity()
 * @ORM\Table(name="themes",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="themes_name_place_unique", columns={"name", "place_id"})}
 * )
 */
class Theme
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Choice({"art", "architecture", "history", "science-fiction", "sport"})
     * @Assert\NotNull
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     * @Assert\LessThanOrEqual(10)
     * @Assert\GreaterThan(0)
     *@Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    protected $value;

    /**
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="themes")
     * @var Place
     */
    protected $place;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function setPlace(Place $place)
    {
        $this->place = $place;
    }
}