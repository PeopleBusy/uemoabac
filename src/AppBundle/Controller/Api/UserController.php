<?php
/**
 * Created by PhpStorm.
 * User: Rachid
 * Date: 25/04/2018
 * Time: 15:35
 */

namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\Validate;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    /**
     * @Route("api/users",name="list_users")
     * @Method({"GET"})
     */
    public function usersList()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
        if (!count($users)){
            $response=array(
                'code'=>1,
                'message'=>'No user found!',
                'errors'=>null,
                'result'=>null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        $data = $this->get('jms_serializer')->serialize($users,'json');
        $response=array(
            'code'=>0,
            'message'=>'success',
            'errors'=>null,
            'result'=> json_decode($data)
        );
        return new JsonResponse($response,200);
    }
}