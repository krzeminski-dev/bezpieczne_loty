<?php

namespace App\Service;

use App\Entity\Country;
use App\Entity\CountryRoutes;
use Doctrine\ORM\EntityManagerInterface;

class CountryRoutesGenerator
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    private function getCountriesAmount()
    {
        return $this->em->getRepository(Country::class)->getCountriesAmount();
    }

    private function truncateTable()
    {
        $cmd = $this->em->getClassMetadata(CountryRoutes::class);
        $connection = $this->em->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS=0');
        $q = $dbPlatform->getTruncateTableSql($cmd->getTableName());
        $connection->executeStatement($q);
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS=1');
    }

    public function generate()
    {
        // unique connections each time ;)
        $this->truncateTable();

        $amount = $this->getCountriesAmount();
        $ids = range(1, $amount);

        $conn = $this->em->getConnection();

        $min = 0;
        $max = $amount - 1;

        for ($i = 0; $i < 200; $i++) {
            $x = 1;
            $y = 1;
            $is_path = false;

            while ($x == $y || $is_path == true || $x == 0 || $y == 0) {
                $is_path = false;
                $x = $ids[rand($min, $max)];
                $y = $ids[rand($min, $max)];

                $stmt = $conn->prepare("select * from `routes` where `country_source_id` = :x and country_destination_id = :y");
                $stmt->execute(['x' => $x, 'y' => $y]);
                $result = $stmt->fetchOne();

                if ($result) {
                    $is_path = true;
                } else {
                    $stmt = $conn->prepare("select * from `routes` where country_destination_id = :x and country_source_id = :y");
                    $stmt->execute(['x' => $x, 'y' => $y]);
                    $result = $stmt->fetchOne();

                    if ($result) {
                        $is_path = true;
                    }
                }
            }

            $stmt = $conn->prepare("insert into routes(country_source_id, country_destination_id) values(:x, :y)");
            $stmt->execute(['x' => $x, 'y' => $y]);

            $stmt = $conn->prepare('insert into routes(country_destination_id, country_source_id) values(:x, :y)');
            $stmt->execute(['x' => $x, 'y' => $y]);
        }
    }
}
