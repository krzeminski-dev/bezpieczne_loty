<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table(name="country_cases")
 */
class CountryCases
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @var integer $countryId
     */
    private $countryId;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $cases;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $todayCases;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $deaths;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $todayDeaths;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $recovered;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $todayRecovered;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $active;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $critical;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $casesPerOneMillion;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $deathsPerOneMillion;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $tests;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $testsPerOneMillion;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $oneCasePerPeople;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $oneDeathPerPeople;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $oneTestPerPeople;

    /**
     * @ORM\Column(type="float")
     * @Groups({"basic"})
     */
    private $activePerOneMillion;

    /**
     * @ORM\Column(type="float")
     * @Groups({"basic"})
     */
    private $recoveredPerOneMillion;

    /**
     * @ORM\Column(type="float")
     * @Groups({"basic"})
     */
    private $criticalPerOneMillion;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"basic"})
     */
    private $updatedAt;

    public function __construct()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCases(): ?int
    {
        return $this->cases;
    }

    public function setCases(int $cases): self
    {
        $this->cases = $cases;

        return $this;
    }

    public function getTodayCases(): ?int
    {
        return $this->todayCases;
    }

    public function setTodayCases(int $todayCases): self
    {
        $this->todayCases = $todayCases;

        return $this;
    }

    public function getDeaths(): ?int
    {
        return $this->deaths;
    }

    public function setDeaths(int $deaths): self
    {
        $this->deaths = $deaths;

        return $this;
    }

    public function getTodayDeaths()
    {
        return $this->todayDeaths;
    }

    public function setTodayDeaths(int $todayDeaths): self
    {
        $this->todayDeaths = $todayDeaths;

        return $this;
    }

    public function getRecovered(): ?int
    {
        return $this->recovered;
    }

    public function setRecovered(int $recovered): self
    {
        $this->recovered = $recovered;

        return $this;
    }

    public function getTodayRecovered(): ?int
    {
        return $this->todayRecovered;
    }

    public function setTodayRecovered(int $todayRecovered): self
    {
        $this->todayRecovered = $todayRecovered;

        return $this;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(int $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCritical(): ?int
    {
        return $this->critical;
    }

    public function setCritical(int $critical): self
    {
        $this->critical = $critical;

        return $this;
    }

    public function getCasesPerOneMillion(): ?int
    {
        return $this->casesPerOneMillion;
    }

    public function setCasesPerOneMillion(int $casesPerOneMillion): self
    {
        $this->casesPerOneMillion = $casesPerOneMillion;

        return $this;
    }

    public function getDeathsPerOneMillion(): ?int
    {
        return $this->deathsPerOneMillion;
    }

    public function setDeathsPerOneMillion(int $deathsPerOneMillion): self
    {
        $this->deathsPerOneMillion = $deathsPerOneMillion;

        return $this;
    }

    public function getTests(): ?int
    {
        return $this->tests;
    }

    public function setTests(int $tests): self
    {
        $this->tests = $tests;

        return $this;
    }

    public function getTestsPerOneMillion(): ?int
    {
        return $this->testsPerOneMillion;
    }

    public function setTestsPerOneMillion(int $testsPerOneMillion): self
    {
        $this->testsPerOneMillion = $testsPerOneMillion;

        return $this;
    }

    public function getOneCasePerPeople(): ?int
    {
        return $this->oneCasePerPeople;
    }

    public function setOneCasePerPeople(int $oneCasePerPeople): self
    {
        $this->oneCasePerPeople = $oneCasePerPeople;

        return $this;
    }

    public function getOneDeathPerPeople(): ?int
    {
        return $this->oneDeathPerPeople;
    }

    public function setOneDeathPerPeople(int $oneDeathPerPeople): self
    {
        $this->oneDeathPerPeople = $oneDeathPerPeople;

        return $this;
    }

    public function getOneTestPerPeople(): ?int
    {
        return $this->oneTestPerPeople;
    }

    public function setOneTestPerPeople(int $oneTestPerPeople): self
    {
        $this->oneTestPerPeople = $oneTestPerPeople;

        return $this;
    }

    public function getActivePerOneMillion(): ?float
    {
        return $this->activePerOneMillion;
    }

    public function setActivePerOneMillion(float $activePerOneMillion): self
    {
        $this->activePerOneMillion = $activePerOneMillion;

        return $this;
    }

    public function getRecoveredPerOneMillion(): ?float
    {
        return $this->recoveredPerOneMillion;
    }

    public function setRecoveredPerOneMillion(float $recoveredPerOneMillion): self
    {
        $this->recoveredPerOneMillion = $recoveredPerOneMillion;

        return $this;
    }

    public function getCriticalPerOneMillion(): ?float
    {
        return $this->criticalPerOneMillion;
    }

    public function setCriticalPerOneMillion(float $criticalPerOneMillion): self
    {
        $this->criticalPerOneMillion = $criticalPerOneMillion;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return int
     */
    public function getCountryId(): int
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     */
    public function setCountryId(int $countryId): self
    {
        $this->countryId = $countryId;

        return $this;
    }
}
