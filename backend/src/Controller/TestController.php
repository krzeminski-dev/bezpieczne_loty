<?php

namespace App\Controller;

use App\Service\DataLoader;
use App\Service\DiseaseApiProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/load/countries", name="load_countries", methods={"GET"})
     */
    public function test(
        DataLoader $loader,
        DiseaseApiProvider $provider
    ) {
        $loader->load($provider->getCountries());

        return $this->json('ok');
    }
}
