<?php

namespace App\Controller\API;

use App\Repository\CountryRepository;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CountriesSupplyAction extends AbstractController
{
    /**
     * @Route("/api/countries", name="api_countries", methods={"GET"})
     * @SWG\Response(
     *     response="200",
     *     description="Returns countries names",
     * )
     *
     * @SWG\Tag(name="countries")
     */
    public function getCountries(CountryRepository $repository)
    {
        return $this->json($repository->findCountryNames());
    }
}