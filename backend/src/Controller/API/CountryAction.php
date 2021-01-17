<?php

namespace App\Controller\API;

use App\Entity\Country;
use App\Repository\CountryRepository;
use App\Service\CountryRoutesProvider;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/api/country/{id}", name="api_get_country", methods={"GET|POST"})
     * @SWG\Response(
     *     response="200",
     *     description="Returns country information",
     *     @Model(type=App\Entity\Country::class, groups={"basic"})
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

        $response = new JsonResponse();
        $response->setContent($json);

        return $response;
    }

    /**
     * @Route("/api/country/{id}/cases", name="api_get_country_cases", methods={"GET|POST"})
     * @SWG\Response(
     *     response="200",
     *     description="Returns country cases information",
     *     @Model(type=App\Entity\CountryCases::class)
     * )
     *
     * @SWG\Tag(name="country")
     */
    public function getCountryCases(Country $country)
    {
        return $this->json($country->getCases());
    }

    /**
     * @Route("/api/route", name="get_route", methods={"GET|POST"})
     * @SWG\Parameter(parameter="source", name="source", type="integer", in="query", required=true)
     * @SWG\Parameter(parameter="destination", name="destination", type="integer", in="query", required=true)
     * @SWG\Response(
     *     response=200,
     *     description="Returns route from source to destination",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              @Model(type=App\Entity\Country::class, groups={"basic"})
     *         )
     *     )
     * )
     * @SWG\Tag(name="country")
     */
    public function getRoute(
        CountryRoutesProvider $provider,
        SerializerInterface $serializer,
        Request $request)
    {
        $provider->handleRequest($request);

        $path = $provider->getRoute();

        /** @var Country[] $countries */
        $countries = $this->getDoctrine()->getManager()->getRepository(Country::class)->getCountriesFromPath($path);

        $result = [];
        // Restore original path
        foreach ($path as $id) {
            $country = array_filter($countries, function (Country $country) use ($id) {
                return $country->getId() == $id;
            });
            $result[] = array_values($country);
        }

        $json = $serializer->serialize(
            $result,
            'json',
            ['groups' => ['basic']]
        );

        $response = new JsonResponse();
        $response->setContent($json);

        return $response;
    }
}