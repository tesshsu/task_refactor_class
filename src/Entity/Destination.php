<?php

class Destination
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $countryName;

    /**
     * @var string
     */
    public $conjunction;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $computerName;

    /**
     * Destination constructor.
     * @param $id
     * @param $countryName
     * @param $conjunction
     * @param $computerName
     */
    public function __construct($id, $countryName, $conjunction, $computerName)
    {
        $this->id = $id;
        $this->countryName = $countryName;
        $this->conjunction = $conjunction;
        $this->computerName = $computerName;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->countryName;
    }

    /**
     * @param string $countryName
     * @return Destination
     */
    public function setCountryName(string $countryName): Destination
    {
        $this->countryName = $countryName;
        return $this;
    }

    /**
     * @return string
     */
    public function getConjunction(): string
    {
        return $this->conjunction;
    }

    /**
     * @param string $conjunction
     * @return Destination
     */
    public function setConjunction(string $conjunction): Destination
    {
        $this->conjunction = $conjunction;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Destination
     */
    public function setName(string $name): Destination
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getComputerName(): string
    {
        return $this->computerName;
    }

    /**
     * @param string $computerName
     * @return Destination
     */
    public function setComputerName(string $computerName): Destination
    {
        $this->computerName = $computerName;
        return $this;
    }

}