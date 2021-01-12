<?php

namespace App\Service;

use App\Entity\Continent;
use App\Entity\Country;
use App\Entity\CountryCases;
use App\Entity\CountryRoutes;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class DataLoader
{
    const BATCH_SIZE = 20;
    const CLASSES = [
        CountryCases::class,
        Country::class,
        Continent::class,
        CountryRoutes::class
    ];
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function load(array $data)
    {
        $this->truncateTables();

        $continents = new ArrayCollection();
        $current = 0;

        foreach ($data as $country) {
            $new = new CountryCases();
            $new->setCases($country->cases);
            $new->setTodayCases($country->todayCases);
            $new->setDeaths($country->deaths);
            $new->setTodayDeaths($country->todayDeaths);
            $new->setRecovered($country->recovered);
            $new->setTodayRecovered($country->todayRecovered);
            $new->setActive($country->active);
            $new->setCritical($country->critical);
            $new->setCasesPerOneMillion($country->casesPerOneMillion);
            $new->setDeathsPerOneMillion($country->deathsPerOneMillion);
            $new->setTests($country->tests);
            $new->setTestsPerOneMillion($country->testsPerOneMillion);
            $new->setOneCasePerPeople($country->oneCasePerPeople);
            $new->setOneDeathPerPeople($country->oneDeathPerPeople);
            $new->setOneTestPerPeople($country->oneTestPerPeople);
            $new->setActivePerOneMillion($country->activePerOneMillion);
            $new->setRecoveredPerOneMillion($country->recoveredPerOneMillion);
            $new->setCriticalPerOneMillion($country->criticalPerOneMillion);

            $new->setCountry(
                (new Country())
                    ->setName($country->country)
                    ->setIso2($country->countryInfo->iso2)
                    ->setIso3($country->countryInfo->iso3)
                    ->setLatitude($country->countryInfo->lat)
                    ->setLongitude($country->countryInfo->long)
                    ->setFlag($country->countryInfo->flag)
                    ->setPopulation($country->population)
            );

            $continent = $country->continent;
            if (! $continents->containsKey($continent)) {
                $continents->set($continent, (new Continent())->setName($continent));
            }

            $continent = $continents->get($continent);

            $new->getCountry()->setContinent($continent);

            $this->em->persist($new);

            if (self::BATCH_SIZE == 20) {
                $this->em->flush();
                $current = 0;
            }

            $current += 1;
        }

        $this->em->flush();
    }

    private function truncateTables()
    {
        foreach (self::CLASSES as $className) {
            $this->truncateClassTable($className);
        }
    }

    private function truncateClassTable(string $class) {
        $cmd = $this->em->getClassMetadata($class);
        $connection = $this->em->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS=0');
        $q = $dbPlatform->getTruncateTableSql($cmd->getTableName());
        $connection->executeStatement($q);
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS=1');
    }
}