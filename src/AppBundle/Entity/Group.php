<?php
/**
 * Created by PhpStorm.
 * User: nassim
 * Date: 09/02/17
 * Time: 11:43
 */

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * A meetup group.
 *
 * @ORM\Entity
 *
 * @ORM\Table(name="meetup_group")
 *
 */

class Group implements \JsonSerializable
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
     * @var string name of group
     *
     * @ORM\Column(type="string",nullable=false)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string name of city of group
     *
     * @ORM\Column(type="string",nullable=false)
     */
    private $city;

    /**
     * @var string description of the group
     *
     * @ORM\Column(type="string",nullable=true)
     */
    private $description;

    /**
     * @var string description of the group
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="followedGroups")
     */
    private $users;


    /**
     * @var string description of the group
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User",inversedBy="groups")
     * @ORM\JoinTable(name="user_admins_groups")
     */
     private $admins;

     public function __construct()
     {
         $this->admins = new ArrayCollection();
         $this->users = new ArrayCollection();
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
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param string $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    public function addUser(User $user){
        $this->users[] = $user;
        $user->addGroup($this);
        return $this;
    }

    /**
     * @return string
     */
    public function getAdmins()
    {
        return $this->admins;
    }

    /**
     * @param string $admins
     */
    public function setAdmins($admins)
    {
        $this->admins = $admins;
    }

    public function addAdmin(User $user){
        $this->admins[] = $user;

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
        $adminsId = array();
        foreach ($this->admins as $admin){
            $adminsId[] = $admin->getId();
        }

        $usersId = array();
        foreach ($this->users as $user){
            $usersId[] = $user->getId();
        }

        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "description"=>$this->description,
            "city"=>$this->city,
            "admins"=>$adminsId,
            "users"=>$usersId
        ];
    }
}
