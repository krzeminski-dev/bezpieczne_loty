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

        $id = 1;
        foreach ($data as $country) {
            
            $new = (new Country())
                ->setName($country->country)
                ->setIso2($country->countryInfo->iso2)
                ->setIso3($country->countryInfo->iso3)
                ->setLatitude($country->countryInfo->lat)
                ->setLongitude($country->countryInfo->long)
                ->setFlag($country->countryInfo->flag)
                ->setPopulation($country->population)
                ->setCases(
                    (new CountryCases())
                        ->setCases($country->cases)
                        ->setTodayCases($country->todayCases)
                        ->setDeaths($country->deaths)
                        ->setTodayDeaths($country->todayDeaths)
                        ->setRecovered($country->recovered)
                        ->setTodayRecovered($country->todayRecovered)
                        ->setActive($country->active)
                        ->setCritical($country->critical)
                        ->setCasesPerOneMillion($country->casesPerOneMillion)
                        ->setDeathsPerOneMillion($country->deathsPerOneMillion)
                        ->setTests($country->tests)
                        ->setTestsPerOneMillion($country->testsPerOneMillion)
                        ->setOneCasePerPeople($country->oneCasePerPeople)
                        ->setOneDeathPerPeople($country->oneDeathPerPeople)
                        ->setOneTestPerPeople($country->oneTestPerPeople)
                        ->setActivePerOneMillion($country->activePerOneMillion)
                        ->setRecoveredPerOneMillion($country->recoveredPerOneMillion)
                        ->setCriticalPerOneMillion($country->criticalPerOneMillion)
                        ->setCountryId($id++)
                )
            ;

            $continent = $country->continent;
            if (! $continents->containsKey($continent)) {
                $continents->set($continent, (new Continent())->setName($continent));
            }

            $continent = $continents->get($continent);

            $new->setContinent($continent);

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