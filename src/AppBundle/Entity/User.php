<?php
/**
 * Created by PhpStorm.
 * User: nassim
 * Date: 09/02/17
 * Time: 11:43
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *  User .
 *
 * @ORM\Entity
 *
 */

class User implements \JsonSerializable
{
    /**
     * @var string the group identifier
     *
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string name of user
     *
     * @ORM\Column(type="string",)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string user email
     *
     * @ORM\Column(type="string",nullable=false)
     */
    private $email;


    /**
     * @var string user password
     *
     * @ORM\Column(type="string",nullable=false)
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Group",mappedBy="admins")
     *
     */
    private $groups;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Group",mappedBy="users")
     *
     */
    private $followedGroups;


    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Event",inversedBy="participants")
     *
     */
    private $events;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->followedGroups = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getFollowedGroups()
    {
        return $this->followedGroups;
    }

    /**
     * @param mixed $followedGroups
     */
    public function setFollowedGroups($followedGroups)
    {
        $this->followedGroups = $followedGroups;
    }


    public function addGroup(Group $group){
        $this->groups[] = $group;
    }

    public function deleteGroup(Group $group){
        $this->groups->removeElement($group);
    }

    /**
     * @return mixed
     */
    public function getGroups()
    {
        $groups = array();
        foreach ($this->getGroups() as $group){
            $groups[]= $group;
        }
        return $this->groups;
    }

    /**
     * @param mixed $groups
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param mixed $events
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }

    public function addEvent(Event $event){
        $this->events[]= $event;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "mail"=>$this->email,
            "password"=>$this->password
        ];
    }
}
