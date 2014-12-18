<?php
namespace Acme\BookerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="booking")
 */
class Booking
{
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;
	
	/**
     * @ORM\Column(name="time", type="string", length=15)
     */
	protected $time;
	
	/**
     * @ORM\Column(name="idauthor", type="integer", length=11)
     */
	protected $idauthor;
	
	/**
     * @ORM\Column(name="room", type="string", length=5)
     */
	protected $room;
	
	/**
     * @ORM\Column(name="date", type="date")
     */
	protected $date;
	
	public function getId(){
		return $this->id;
	}
	
	public function getTime(){
		return $this->time;
	}
	
	public function setTime($time){
		$this->time = $time;
	}
	
	public function getIdauthor(){
		return $this->idauthor;
	}
	
	public function setIdauthor($idauthor){
		$this->idauthor = $idauthor;
	}
	
	public function getRoom(){
		return $this->room;
	}
	
	public function setRoom($room){
		$this->room = $room;
	}
	
	public function getDate(){
		return $this->date;
	}
	
	public function setDate($date){
		$this->date = $date;
	}
}