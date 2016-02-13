<?php

namespace Model;


class TweetCriteria
{
    protected $username;
    protected $since;
    protected $until;
    protected $querySearch;
    protected $maxTweets;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getSince()
    {
        return $this->since;
    }

    /**
     * @param mixed $since
     */
    public function setSince($since)
    {
        $this->since = $since;
    }

    /**
     * @return mixed
     */
    public function getUntil()
    {
        return $this->until;
    }

    /**
     * @param mixed $until
     */
    public function setUntil($until)
    {
        $this->until = $until;
    }

    /**
     * @return mixed
     */
    public function getQuerySearch()
    {
        return $this->querySearch;
    }

    /**
     * @param mixed $querySearch
     */
    public function setQuerySearch($querySearch)
    {
        $this->querySearch = $querySearch;
    }

    /**
     * @return mixed
     */
    public function getMaxTweets()
    {
        return $this->maxTweets;
    }

    /**
     * @param mixed $maxTweets
     */
    public function setMaxTweets($maxTweets)
    {
        $this->maxTweets = $maxTweets;
    }



}