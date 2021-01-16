<?php

namespace App\Controller\API;

use App\Entity\Country;
use App\Repository\CountryRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CountryAction extends AbstractController
{
    /**
     * @var CountryRepository
     */
    private $repository;

    public function __construct(CountryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/api/countries", name="api_get_countries", methods={"GET"})
     * @SWG\Response(
     *     response="200",
     *     description="Returns countries names",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *             @SWG\Property(property="id", type="integer"),
     *             @SWG\Property(property="name", type="string"),
     *         )
     *     )
     * )
     *
     * @SWG\Tag(name="country")
     */
    public function getCountries()
    {
        return $this->json($this->repository->findCountryNames());
    }

    /**
     * @Route("/api/country/{id}", name="api_get_country", methods={"GET"})
     * @SWG\Response(
     *     response="200",
     *     description="Returns country information",
     *     @Model(type=App\Entity\Country::class)
     * )
     *
     * @SWG\Tag(name="country")
     */
    public function getCountry(SerializerInterface $serializer, Country $country)
    {
        $json = $serializer->serialize(
            $country,
            'json',
            ['groups' => 'basic']
        );

        return new Response(
            $json,
            Response::HTTP_OK,
            ['content-type' => 'text/plain']
        );
    }
}