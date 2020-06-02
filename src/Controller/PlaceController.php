<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Place;

class PlaceController extends Controller
{

    public function getPlacesAction(Request $request)
    {
        $places = $this->get('doctrine.orm.entity_manager')
                ->getRepository(Place::class)
                ->findAll();
        /* @var $places Place[] */

        $formatted = [];
        foreach ($places as $place) {
            $formatted[] = [
               'id' => $place->getId(),
               'name' => $place->getName(),
               'address' => $place->getAddress(),
            ];
        }

        return new JsonResponse($formatted);
    }

    public function getPlaceAction($id, Request $request)
    {
        $place = $this->get('doctrine.orm.entity_manager')
                ->getRepository(Place::class)
                ->find($id);
        /* @var $place Place */
        if (empty($place)) {
            return new JsonResponse(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }
        $formatted = [
           'id' => $place->getId(),
           'name' => $place->getName(),
           'address' => $place->getAddress(),
        ];

        return new JsonResponse($formatted);
    }
}