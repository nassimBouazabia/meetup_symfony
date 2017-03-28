<?php
/**
 * Created by PhpStorm.
 * User: nassim
 * Date: 27/03/17
 * Time: 19:30
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    /**
     * @Route("/user/{id}",name="find_user_by_id")
     * @Method("Get")
     */
    public function find(User $id){
        return $this->json($id);
    }

    /**
     * @Route("/users",name="get_all_users")
     * @Method("Get")
     */
    public function findAll(){
        $em = $this->getDoctrine()->getManager();
        return $this->json(
            $em->getRepository('AppBundle:User')->findAll()
        );
    }


    /**
     * @Route("/user",name="add_user")
     * @Method("Post")
     */
    public function addUser(Request $request){

        $em = $this->getDoctrine()->getManager();

        $params = array();
        $content = $request->getContent();

        if (!empty($content))
        {
            $params = json_decode($content, true); // 2nd param to get as array
        }

        $user = new User();
        $user->setEmail($params["mail"]);
        $user->setName($params["name"]);
        $user->setPassword($params["password"]);

        $em->persist($user);
        $em->flush();

        return $this->json($user);
    }

    /**
     * @Route("/user/{user}",name="update_user")
     * @Method("Put")
     */
    public function updateUser(User $user, Request $request){
        $em = $this->getDoctrine()->getManager();

        $params = array();
        $content = $request->getContent();

        if (!empty($content))
        {
            $params = json_decode($content, true); // 2nd param to get as array
        }

        $user->setEmail($params["mail"]);
        $user->setName($params["name"]);
        $user->setPassword($params["password"]);

        $em->flush();

        return $this->json(
            $user
        );
    }

    /**
     * @Route("/user/{user}",name="delete_user")
     * @Method("Delete")
     */
    public function deleteUser(User $user){
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->json(
            ["success"=>"User have been deleted"]
        );
    }

}