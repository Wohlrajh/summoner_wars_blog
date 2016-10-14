<?php

namespace Summoner\UserBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Controller\ProfileController as BaseController;

class ProfileController extends BaseController
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getCityByPostalCodeAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return new Response('', 403);
        }

        if ($request->request->has('postalCode')) {
            $postalCodeCityRep = $this->getDoctrine()->getRepository('SummonerUserBundle:PostalCodeCity');
            $postalCodeCity = $postalCodeCityRep->findByPostalCode($request->request->get('postalCode'));
        }

        $city = array();
        /* @var $item \Summoner\UserBundle\Entity\PostalCodeCity */
        foreach ($postalCodeCity as $item) {
            $city[] = $item->getCity();
        }

        return new JsonResponse($city);
    }
}
