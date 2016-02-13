<?php

namespace Model;


class Tweet
{

    protected $id;
    protected $permalink;
    protected $username;
    protected $text;

    protected $date;

    protected $retweets;
    protected $favorites;

    protected $mentions;
    protected $hashtags;
    protected $geo;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * @param mixed $permalink
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;
    }

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
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getRetweets()
    {
        return $this->retweets;
    }

    /**
     * @param mixed $retweets
     */
    public function setRetweets($retweets)
    {
        $this->retweets = $retweets;
    }

    /**
     * @return mixed
     */
    public function getFavorites()
    {
        return $this->favorites;
    }

    /**
     * @param mixed $favorites
     */
    public function setFavorites($favorites)
    {
        $this->favorites = $favorites;
    }

    /**
     * @return mixed
     */
    public function getMentions()
    {
        return $this->mentions;
    }

    /**
     * @param mixed $mentions
     */
    public function setMentions($mentions)
    {
        $this->mentions = $mentions;
    }

    /**
     * @return mixed
     */
    public function getHashtags()
    {
        return $this->hashtags;
    }

    /**
     * @param mixed $hashtags
     */
    public function setHashtags($hashtags)
    {
        $this->hashtags = $hashtags;
    }

    /**
     * @return mixed
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * @param mixed $geo
     */
    public function setGeo($geo)
    {
        $this->geo = $geo;
    }


}