<?php
/**
 * Created by PhpStorm.
 * User: nassim
 * Date: 27/03/17
 * Time: 19:21
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Event;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{


    /**
     * @Route("/event/{event}",name="find_event_by_id")
     * @Method("Get")
     */
    public function find(Event $event){
        return $this->json($event);
    }

    /**
     * @Route("/events",name="find_all_events")
     * @Method("Get")
     */
    public function findAll(){
        $em = $this->getDoctrine()->getManager();
        return $this->json(
            $em->getRepository('AppBundle:Event')
        );
    }

    /**
     * @Route("/event",name="add_event")
     * @Method("Post")
     */
    public function addEvent(Request $request){
        $em = $this->getDoctrine()->getManager();

        $params = array();
        $content = $request->getContent();

        if (!empty($content))
        {
            $params = json_decode($content, true); // 2nd param to get as array
        }

        $event = new Event();
        $event->setName($params["name"]);
        $event->setDateStart(new \DateTime($params["dateStart"]));
        $event->setDateEnd(new \DateTime($params["dateEnd"]));


        $event->setDescription($params["description"]);

        $group = $em->getRepository('AppBundle:Group')->find($params["groupId"]);

        $event->setGroup($group);

        $em->persist($event);
        $em->flush();

        return $this->json(
            $event
        );
    }

    /**
     * @Route("/event/{event}",name="update_event")
     * @Method("Put")
     */
    public function update(Event $event, Request $request){
        $em = $this->getDoctrine()->getManager();

        $params = array();
        $content = $request->getContent();

        if (!empty($content))
        {
            $params = json_decode($content, true); // 2nd param to get as array
        }

        $event->setName($params["name"]);
        $event->setDateStart(new \DateTime($params["dateStart"]));
        $event->setDateEnd(new \DateTime($params["dateEnd"]));


        $event->setDescription($params["description"]);

        $group = $em->getRepository('AppBundle:Group')->find($params["groupId"]);

        $event->setGroup($group);

        $em->flush();

        return $this->json(
            $event
        );
    }

    /**
     * @Route("/event",name="delete_event")
     * @Method("Delete")
     */
    public function delete(Event $event){
        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();
        return $this->json(
            ["success"=>"event have been deleted"]
        );
    }

    /**
     * @Route("/event/{event}/user/{user}",name="add_user_to_event")
     * @Method("Post")
     */
    public function addUserToEvent(Event $event,User $user){
        $em = $this->getDoctrine()->getManager();
        $event->addParticipant($user);
        $em->flush();
        return $this->json($event);
    }
}