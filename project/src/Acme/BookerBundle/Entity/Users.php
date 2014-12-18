<?php
namespace Acme\BookerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class Users
{
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;
	
	/**
     * @ORM\Column(name="users", type="string", length=255)
     */
	protected $users;
	
	/**
     * @ORM\Column(name="pass", type="string", length=255)
     */
	protected $pass;
	
	public function getId(){
		return $this->id;
	}
	
	public function getUsers(){
		return $this->users;
	}
	
	public function setUsers($users){
		$this->users = $users;
	}
	
	public function getPass(){
		return $this->pass;
	}
	
	public function setPass($pass){
		$this->pass = $pass;
	}
}