<?php
/**
 * Created by PhpStorm.
 * User: nassim
 * Date: 21/03/17
 * Time: 19:57
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *  Event .
 *
 * @ORM\Entity
 *
 */

class Event implements \JsonSerializable
{

    /**
     * @var string the event identifier
     *
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string event name
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string event description
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @var starting date of the event
     *
     * @ORM\Column(type="datetime")
     *
     */
    private $dateStart;


    /**
     * @var ending date of the event
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     */
    private $dateEnd;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User",mappedBy="events")
     */
    private $participants;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Group")
     */
    private $group;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @param mixed $dateStart
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param mixed $dateEnd
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return mixed
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @param mixed $participants
     */
    public function setParticipants($participants)
    {
        $this->participants = $participants;
    }

    public function addParticipant(User $user){
        $this->participants[] = $user;
        $user->addEvent($this);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        $participantsId = array();
        if($this->participants != null)
            foreach ($this->participants as $participant){
                $participantsId[] = $participant->getId();
            }

       return [
           "id"=>$this->id,
           "name"=>$this->name,
           "description"=>$this->description,
           "dateStart"=>$this->dateStart,
           "dateEnd"=>$this->dateEnd,
           "groupId"=>$this->getGroup()->getId(),
           "partiipantsId"=>$participantsId
       ];
    }
}
