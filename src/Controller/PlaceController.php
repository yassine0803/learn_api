<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Place;

class PlaceController extends Controller
{
    /**
     * @Route("/places", name="places_list")
     * @Method({"GET"})
     */
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
    // code de getPlacesAction

    /**
     * @Route("/places/{place_id}", name="places_one")
     * @Method({"GET"})
     */
    public function getPlaceAction(Request $request)
    {
        $place = $this->get('doctrine.orm.entity_manager')
                ->getRepository(Place::class)
                ->find($request->get('place_id'));
        /* @var $place Place */

        $formatted = [
           'id' => $place->getId(),
           'name' => $place->getName(),
           'address' => $place->getAddress(),
        ];

        return new JsonResponse($formatted);
    }
}