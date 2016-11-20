<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class User
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="")
 */
class User{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
     * @var string
     * @ORM\Column(name="username", type="string", length=255)
     */
    protected $userName;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=255)
     */
    protected $userPass;

    public function getUsername(){
        return $this->userName;
    }

    public function setUsername($name){
        $this->userName = $name;
        return $this;
    }

    public function getPassword(){
        return $this->userPass;
    }

    public function setPassword($pass){
        $this->userPass = $pass;
        return $this;
    }

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
     * Set userPass
     *
     * @param string $userPass
     *
     * @return User
     */
    public function setUserPass($userPass)
    {
        $this->userPass = $userPass;

        return $this;
    }

    /**
     * Get userPass
     *
     * @return string
     */
    public function getUserPass()
    {
        return $this->userPass;
    }
}
