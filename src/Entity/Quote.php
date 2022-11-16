<?php

class Quote
{
    /**
     * @var int
     */
    private $id;

    /***
     * @var int
     */
    private $siteId;

    /**
     * @var int
     */
    private $destinationId;

    /**
     * @var DateTime
     */
    private $dateQuoted;

    /**
     * Quote constructor.
     * @param $id
     * @param $siteId
     * @param $destinationId
     * @param $dateQuoted
     */
    public function __construct($id, $siteId, $destinationId, $dateQuoted)
    {
        $this->id = $id;
        $this->siteId = $siteId;
        $this->destinationId = $destinationId;
        $this->dateQuoted = $dateQuoted;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSiteId(): int
    {
        return $this->siteId;
    }

    /**
     * @param mixed $siteId
     * @return Quote
     */
    public function setSiteId($siteId): Quote
    {
        $this->siteId = $siteId;
        return $this;
    }

    /**
     * @return int
     */
    public function getDestinationId(): int
    {
        return $this->destinationId;
    }

    /**
     * @param mixed $destinationId
     * @return Quote
     */
    public function setDestinationId($destinationId): Quote
    {
        $this->destinationId = $destinationId;
        return $this;
    }

    /**
     * @param mixed $dateQuoted
     * @return Quote
     */
    public function setDateQuoted($dateQuoted): Quote
    {
        $this->dateQuoted = $dateQuoted;
        return $this;
    }

    /**
     * @param Quote $quote
     * @return string
     */
    public static function renderHtml(Quote $quote): string
    {
        return '<p>' . $quote->id . '</p>';
    }

    /**
     * @param Quote $quote
     * @return string
     */
    public static function renderText(Quote $quote): string
    {
        return (string) $quote->id;
    }
}