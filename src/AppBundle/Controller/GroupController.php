<?php
/**
 * Created by PhpStorm.
 * User: nassim
 * Date: 27/03/17
 * Time: 20:25
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Group;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends Controller
{

    /**
     * @Route("/group/{group}",name="find_group")
     * @Method("Get")
     */
    public function find(Group $group){
        return $this->json($group);
    }

    /**
     * @Route("/groups",name="find_all_groups")
     * @Method("Get")
     */
    public function findAll(){
        $em = $this->getDoctrine()->getManager();
        return $this->json(
            $em->getRepository('AppBundle:Group')->findAll()
        );
    }

    /**
     * @Route("/group",name="add_group")
     * @Method("Post")
     */
    public function addGroup(Request $request){

        $em = $this->getDoctrine()->getManager();

        $params = array();
        $content = $request->getContent();

        if (!empty($content))
        {
            $params = json_decode($content, true); // 2nd param to get as array
        }

        $group = new Group();
        $group->setName($params["name"]);
        $group->setCity($params["city"]);

        if(isset($params["description"]))
            $group->setDescription($params["description"]);

        foreach ($params["admins"] as $adminid){
            $group->addAdmin(
                $em->getRepository('AppBundle:User')->find($adminid)
            );
        }

        $em->persist($group);
        $em->flush();

        return $this->json($group);

    }

    /**
     * @Route("/group/{group}",name="update_group")
     * @Method("Put")
     */
    public function update(Group $group, Request $request){

        $em = $this->getDoctrine()->getManager();

        $params = array();
        $content = $request->getContent();

        if (!empty($content))
        {
            $params = json_decode($content, true); // 2nd param to get as array
        }

        $group->setName($params["name"]);
        $group->setCity($params["city"]);

        if(isset($params["description"]))
            $group->setDescription($params["description"]);

        foreach ($params["admins"] as $adminId){
            $user = $em->getRepository('AppBundle:User')->find($adminId);
            if(!$group->getAdmins()->contains($user))
                $group->addAdmin( $user);
        }

        $em->persist($group);
        $em->flush();

        return $this->json($group);

    }

    /**
     * @Route("/group/{group}",name="delete_group")
     * @Method("Delete")
     */
    public function delete(Group $group){
        $em =$this->getDoctrine()->getManager();
        $em->remove($group);
        $em->flush();
        return $this->json(
            ["success"=>"group have been deleted"]
        );
    }


    /**
     * @Route("/group/{group}/admin/{admin}",name="add_admin_to_group")
     * @Method("Post")
     */
    public function addAdminToGroup(Group $group,User $admin){
        $em = $this->getDoctrine()->getManager();
        $group->addAdmin($admin);
        $em->flush();
        return $this->json($group);
    }


    /**
     * @Route("/group/{group}/user/{user}",name="add_user_to_group")
     * @Method("Post")
     */
    public function addUserToGroup(Group $group,User $user){
        $em = $this->getDoctrine()->getManager();
        $group->addUser($user);
        $em->flush();
        return $this->json($group);
    }
}