<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest; 
use App\Entity\User;

class UserController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/users")
     */
    public function getUsersAction(Request $request)
    {
        $users = $this->get('doctrine.orm.entity_manager')
                ->getRepository(User::class)
                ->findAll();
        /* @var $users Place[] */

        return $users;
    }

     /**
     * @Rest\View()
     * @Rest\Get("/users/{id}")
     */
    public function getPlaceAction(Request $request)
    {
        $user = $this->get('doctrine.orm.entity_manager')
                ->getRepository(user::class)
                ->find($request->get('id')); // L'identifiant en tant que paramétre n'est plus nécessaire
        /* @var $user user */

        if (empty($user)) {
            return new JsonResponse(['message' => 'user not found'], Response::HTTP_NOT_FOUND);
        }

        return $user;
    }
}
