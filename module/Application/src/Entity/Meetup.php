<?php

declare(strict_types=1);

namespace Application\Entity;

use Doctrine\ORM\PersistentCollection;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Meetup
 *
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="Application\Repository\MeetupRepository")
 * @ORM\Table(name="meetups")
 */
class Meetup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     **/
    private $id;
    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $title;
    /**
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
    private $description = '';
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $startDate;
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $endDate;
    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Owner", inversedBy="meetups", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="meetups_owners")
     */
    private $owners;
    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Participant", inversedBy="meetups", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="meetups_participants")
     */
    private $participants;

    /**
     * Meetup constructor.
     * @param string $title
     * @param string $description
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     */
    public function __construct(string $title, string $description, \DateTime $startDate, \DateTime $endDate)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->title = $title;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
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
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Meetup
     */
    public function setTitle(string $title) : Meetup
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Meetup
     */
    public function setDescription(string $description) : Meetup
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate() : \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     *
     * @return Meetup
     */
    public function setStartDate(\DateTime $startDate) : Meetup
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate() : \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     *
     * @return Meetup
     */
    public function setEndDate(\DateTime $endDate) : Meetup
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getOwners() : PersistentCollection
    {
        return $this->owners;
    }

    /**
     * @param Owner[] $owners
     *
     * @return Meetup
     */
    public function setOwners(array $owners) : Meetup
    {
        $this->owners = $owners;

        return $this;
    }

    /**
     * @param Owner $owner
     *
     * @return Meetup
     */
    public function addOwner(Owner $owner) : Meetup
    {
        if (!$this->owners->contains($owner)) {
            $this->owners[] = $owner;
        }

        return $this;
    }

    /**
     * @param Owner $owner
     *
     * @return Meetup
     */
    public function removeOwner(Owner $owner) : Meetup
    {
        /** @var Owner $currentOwner */
        foreach ($this->owners as $key => $currentOwner) {
            if ($currentOwner->getId() === $owner->getId()) {
                unset($this->owners[$key]);

                return $this;
            }
        }

        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getParticipants() : PersistentCollection
    {
        return $this->participants;
    }

    /**
     * @param Participant[] $participants
     *
     * @return Meetup
     */
    public function setParticipants(array $participants) : Meetup
    {
        $this->participants = $participants;

        return $this;
    }

    /**
     * @param Participant $participant
     *
     * @return Meetup
     */
    public function addParticipant(Participant $participant) : Meetup
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
        }

        return $this;
    }
}
