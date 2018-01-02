<?php

declare(strict_types=1);

namespace Application\Entity;

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
     * Meetup constructor.
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
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
}
