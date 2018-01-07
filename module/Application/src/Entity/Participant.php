<?php

declare(strict_types=1);

namespace Application\Entity;

use Doctrine\ORM\PersistentCollection;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Participant
 *
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="Application\Repository\ParticipantRepository")
 * @ORM\Table(name="participants")
 */
class Participant
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     **/
    private $id;
    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $firstName;
    /**
     * @ORM\Column(type="string", length=60, nullable=false)
     */
    private $lastName;
    /**
     * @ORM\Column(type="string", length=60, nullable=false)
     */
    private $email;
    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Meetup", mappedBy="participants", cascade={"persist", "remove"})
     */
    private $meetups;

    /**
     * Participant constructor.
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     */
    public function __construct(string $firstName, string $lastName, string $email)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName() : string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName() : string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFullName() : string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @return PersistentCollection
     */
    public function getMeetups() : PersistentCollection
    {
        return $this->meetups;
    }

    /**
     * @param Meetup[] $meetups
     *
     * @return Participant
     */
    public function setMeetups(array $meetups) : Participant
    {
        $this->meetups = $meetups;

        return $this;
    }
}
