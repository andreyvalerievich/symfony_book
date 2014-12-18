<?php

namespace Acme\BookerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Acme\BookerBundle\Entity\Booking;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\Security\Core\SecurityContext;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\User\User;

class BookerController extends Controller
{
    private $rooms = array(
						1 => array(8=>array("user"=>"","id"=>""), 9=>array("user"=>"","id"=>""), 10=>array("user"=>"","id"=>""), 11=>array("user"=>"","id"=>""), 12=>array("user"=>"","id"=>""), 13=>array("user"=>"","id"=>""), 14=>array("user"=>"","id"=>""), 15=>array("user"=>"","id"=>""), 16=>array("user"=>"","id"=>""), 17=>array("user"=>"","id"=>""), 18=>array("user"=>"","id"=>""), 19=>array("user"=>"","id"=>"")),
						2 => array(8=>array("user"=>"","id"=>""), 9=>array("user"=>"","id"=>""), 10=>array("user"=>"","id"=>""), 11=>array("user"=>"","id"=>""), 12=>array("user"=>"","id"=>""), 13=>array("user"=>"","id"=>""), 14=>array("user"=>"","id"=>""), 15=>array("user"=>"","id"=>""), 16=>array("user"=>"","id"=>""), 17=>array("user"=>"","id"=>""), 18=>array("user"=>"","id"=>""), 19=>array("user"=>"","id"=>"")),
						3 => array(8=>array("user"=>"","id"=>""), 9=>array("user"=>"","id"=>""), 10=>array("user"=>"","id"=>""), 11=>array("user"=>"","id"=>""), 12=>array("user"=>"","id"=>""), 13=>array("user"=>"","id"=>""), 14=>array("user"=>"","id"=>""), 15=>array("user"=>"","id"=>""), 16=>array("user"=>"","id"=>""), 17=>array("user"=>"","id"=>""), 18=>array("user"=>"","id"=>""), 19=>array("user"=>"","id"=>""))
					);
	
	private $user = 1;
	
	/**
     * @Route("/", name="_booker")
     * @Template()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
		
		$datepick = $request->query->get('datepick');
		$date = $datepick;
		
		$usr= $this->get('security.context')->getToken()->getUser();
		
		if ( empty($datepick) ) {
			$date = date("m/d/Y");
		}
		
		$date_db = date ( "Y-m-d", strtotime($date) );
		
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery(
			'SELECT p FROM AcmeBookerBundle:Booking p WHERE p.date = :date ORDER BY p.date ASC'
		)->setParameter('date', $date_db);

		$products = $query->getResult();
		
		$query2 = $em->createQuery(
			'SELECT p.id FROM AcmeBookerBundle:Users p WHERE p.users = :users'
		)->setParameter('users', $usr->getUsername());

		$id_user = $query2->getResult();
		
		$this->user = $id_user[0]["id"];
		$this->get('session')->set('user_id',serialize($this->user));
		
		foreach ( $products as $val ) {
			switch($val->getRoom()){
				case 'room1':
					$this->rooms[1][$val->getTime()]["user"] = $val->getIdauthor();
					$this->rooms[1][$val->getTime()]["id"] = $val->getId();
					break;
				case 'room2':
					$this->rooms[2][$val->getTime()]["user"] = $val->getIdauthor();
					$this->rooms[2][$val->getTime()]["id"] = $val->getId();
					break;
				case 'room3':
					$this->rooms[3][$val->getTime()]["user"] = $val->getIdauthor();
					$this->rooms[3][$val->getTime()]["id"] = $val->getId();
					break;
			}
			
			if ( $val->getIdauthor() == $this->user && !empty($this->rooms[1][$val->getTime()]["user"]) ) {
				$this->rooms[2][$val->getTime()]["user"] = "not_empty";
				$this->rooms[3][$val->getTime()]["user"] = "not_empty";
			} else if( $val->getIdauthor() == $this->user && !empty($this->rooms[2][$val->getTime()]["user"]) ){
				$this->rooms[1][$val->getTime()]["user"] = "not_empty";
				$this->rooms[3][$val->getTime()]["user"] = "not_empty";
			} else if( $val->getIdauthor() == $this->user && !empty($this->rooms[3][$val->getTime()]["user"]) ){
				$this->rooms[1][$val->getTime()]["user"] = "not_empty";
				$this->rooms[2][$val->getTime()]["user"] = "not_empty";
			}
			
		}
		
		return array(
				"rooms" => $this->rooms, 
				"date"  => $date,
				"user"  => $this->user);
    }
	
	/**
     * @Route("/view", name="_view")
     * @Template()
     */
    public function viewAction()
    {
        $request = $this->getRequest();
		
		$datepick = $request->query->get('datepick');
		$date = $datepick;
		
		if ( empty($datepick) ) {
			$date = date("m/d/Y");
		}
		
		$date_db = date ( "Y-m-d", strtotime($date) );
		
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery(
			'SELECT p FROM AcmeBookerBundle:Booking p WHERE p.date = :date ORDER BY p.date ASC'
		)->setParameter('date', $date_db);

		$products = $query->getResult();
		
		foreach ( $products as $val ) {
			switch($val->getRoom()){
				case 'room1':
					$this->rooms[1][$val->getTime()]["user"] = $val->getIdauthor();
					break;
				case 'room2':
					$this->rooms[2][$val->getTime()]["user"] = $val->getIdauthor();
					break;
				case 'room3':
					$this->rooms[3][$val->getTime()]["user"] = $val->getIdauthor();
					break;
			}
			
		}
		
		return array(
				"rooms" => $this->rooms, 
				"date"  => $date,
				"user"  => $this->user);
    }
	
	/**
     * @Route("/addmessage", name="_addmessage")
     * @Template()
     */
    public function addmessageAction()
    {
        $request = $this->getRequest();
		
		$room = $request->query->get('room');
		$time = $request->query->get('time');
		$user = $request->query->get('user');
		$date = $request->query->get('date');
		
		$timestamp_cust = strtotime($date);
		$timestamp_now = strtotime(date("m/d/Y"));
		$time_now = date("H");
		
		if ( ($timestamp_cust < $timestamp_now) || ( ($timestamp_cust == $timestamp_now) && ($time <= $time_now) ) ) {
			return $this->render( "AcmeBookerBundle:Booker:message.html.twig", array(
																				"date" => $date,
																				"rooms" => $this->rooms, 
																				"user"  => $user,
																				"msg" => "Sorry, a past date is not possible to select") );
		}
		
		return $this->render( "AcmeBookerBundle:Booker:addbooker.html.twig", array(
																				"date" => $date,
																				"time" => $time,
																				"room" => $room,
																				"user" => $user,
																				"rooms" => $this->rooms
																			) );
    }
	
	/**
     * @Route("/message", name="_message")
     * @Template()
     */
    public function messageAction()
    {
        $request = $this->getRequest();
		$user_id = unserialize($this->get('session')->get('user_id'));
		
		$room = $request->query->get('room');
		$time = $request->query->get('time');
		$date = $request->query->get('date');
		$user = $request->query->get('user');
		$id = $request->query->get('id');
		$room_next = $request->query->get('room_next');
		
		if ($user == $user_id) {
			
			if ( isset($room_next) && $room_next == "true" ) {
				$msg = "You can book only one room for this time period";
			} else {
				return $this->render( "AcmeBookerBundle:Booker:removebooker.html.twig", array(
																						"user"  => $user, 
																						"date" => $date, 
																						"room" => $room, 
																						"time" => $time, 
																						"id" => $id,
																						"rooms" => $this->rooms) );
			}
		} else {
			
			$msg = "This room is booked already";
			
		}
		
		return $this->render( "AcmeBookerBundle:Booker:message.html.twig", array(
																				"user"  => $user,
																				"date" => $date,
																				"rooms" => $this->rooms, 
																				"msg" => $msg) );
    }
	
	/**
     * @Route("/addbooker", name="_addbooker")
     * @Template()
     */
    public function addbookerAction()
    {
		$request = $this->getRequest();
		
		$room = $request->query->get('room');
		$time = $request->query->get('time');
		$user = $request->query->get('user');
		$date = $request->query->get('date');
		
		$room = "room".$room;
		
		$booking = new Booking();
		$booking->setRoom($room);
		$booking->setTime($time);
		$booking->setIdauthor($user);
		$booking->setDate(new \DateTime($date));

		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($booking);
		$em->flush();
		
		return $this->redirect($this->generateUrl('_booker'));
    }
	
	/**
     * @Route("/removebooker", name="_removebooker")
     * @Template()
     */
    public function removebookerAction()
    {
		$request = $this->getRequest();
		
		$id = $request->query->get('id');
		$user = $request->query->get('user');
		
		$em = $this->getDoctrine()->getManager();
		$time = $em->getRepository('AcmeBookerBundle:Booking')->find($id);

		if (!$time) {
			throw $this->createNotFoundException(
				'No time found for id '.$id.' booking.'
			);
		}

		$em->remove($time);
		$em->flush();
		
		return $this->redirect($this->generateUrl('_booker'));
    }
}
