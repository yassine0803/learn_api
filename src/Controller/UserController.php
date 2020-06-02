<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/users", name="users_list")
     * @Method({"GET"})
     */
    public function getUsersAction(Request $request)
    {
        $users = $this->get('doctrine.orm.entity_manager')
                ->getRepository(User::class)
                ->findAll();
        /* @var $users User[] */

        $formatted = [];
        foreach ($users as $user) {
            $formatted[] = [
               'id' => $user->getId(),
               'firstname' => $user->getFirstname(),
               'lastname' => $user->getLastname(),
               'email' => $user->getEmail(),
            ];
        }

        return new JsonResponse($formatted);
    }
}