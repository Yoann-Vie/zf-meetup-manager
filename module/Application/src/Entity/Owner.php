<?php

declare(strict_types=1);

namespace Application\Entity;

use Doctrine\ORM\PersistentCollection;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Owner
 *
 * @package Application\Entity
 * @ORM\Entity()
 * @ORM\Table(name="owners")
 */
class Owner
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
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
    private $biography = '';
    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Meetup", mappedBy="owners", cascade={"persist", "remove"})
     */
    private $meetups;

    /**
     * Owner constructor.
     * @param string $firstName
     * @param string $lastName
     * @param string $biography
     */
    public function __construct(string $firstName, string $lastName, string $biography = '')
    {
        $this->id = Uuid::uuid4()->toString();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->biography = $biography;
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
     * @return PersistentCollection
     */
    public function getMeetups() : PersistentCollection
    {
        return $this->meetups;
    }

    /**
     * @param Meetup[] $meetups
     *
     * @return Owner
     */
    public function setMeetups(array $meetups) : Owner
    {
        $this->meetups = $meetups;

        return $this;
    }
}
