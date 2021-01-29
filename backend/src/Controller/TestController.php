<?php

namespace App\Controller;

use App\Service\CountryRoutesGenerator;
use App\Service\DataLoader;
use App\Service\DiseaseApiProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/load/countries", name="load_countries", methods={"GET"})
     */
    public function loadCountries(
        DataLoader $loader,
        DiseaseApiProvider $provider
    ) {
        $loader->load($provider->getCountries());

        return $this->json('ok');
    }

    /**
     * @Route("/load/routes/{number}", name="load_routes", methods={"GET"}, defaults={"number" = 200})
     */
    public function loadRoutes(CountryRoutesGenerator $generator, int $number)
    {
        $generator->generate($number);

        return $this->json('ok');
    }
}
