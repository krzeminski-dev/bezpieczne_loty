<?php

namespace App\Service;

use App\Service\ShitCode\Graph;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CountryRoutesProvider
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    private $source;
    private $destination;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function handleRequest(Request $request)
    {
        $this->source = $request->get('source');
        $this->destination = $request->get('destination');
    }

    public function getRoute()
    {
        $conn = $this->em->getConnection();

        $graph = array();

        $stmt = $conn->prepare('select country_source_id, country_destination_id from routes');
        $stmt->execute();

        while ($row = $stmt->fetchAssociative()) {

            $id_destination = $row["country_destination_id"];

            $stmt2 = $conn->prepare('select active from country_cases where country_id = :destination');
            $stmt2->execute(['destination' => $id_destination]);

            $cases = $stmt2->fetchAssociative()['active'];

            $stmt3 = $conn->prepare('select population from country where id = :destination');
            $stmt3->execute(['destination' => $id_destination]);

            $population = $stmt3->fetchAssociative()['population'];


            // dodac wpływ odległości na krawędź
            $path_length = $population != 0 ? ($cases / $population) * 100 : 0;

            array_push($graph, [$row['country_source_id'], $row['country_destination_id'], $path_length]);
        }

        $g = new Graph();
        foreach ($graph as $edge) {
            $g->addedge($edge[0], $edge[1], $edge[2]);
        }

        $FROM = $this->source;
        $TO = $this->destination;

        list($distances, $prev) = $g->paths_from("$FROM");

        $path = $g->paths_to($prev, "$TO");

        return $path;
    }

}
