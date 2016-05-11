<?php

namespace Manager;

use GuzzleHttp\Client;
use Model\Tweet;
use Model\TweetCriteria;
use Symfony\Component\DomCrawler\Crawler;


/**
 * @author yawmoght <yawmoght@gmail.com>
 */
class TweetManager
{
    protected $client;

    /**
     * TweetManager constructor.
     * @param $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param TweetCriteria $criteria
     * @return Tweet[]
     */
    public function getTweets(TweetCriteria $criteria)
    {
        $results = array();

        try {
            $refreshCursor = null;

            if ($criteria->getMaxTweets() == 0){
                return $results;
            }
            do {
                $response = $this->getUrlResponse($criteria->getUsername(),
                    $criteria->getSince(),
                    $criteria->getUntil(),
                    $criteria->getQuerySearch(),
                    $refreshCursor);

                $refreshCursor = $response['min_position'];
                $htmlCrawler = new Crawler($response['items_html']);
                $tweetsCrawler = $htmlCrawler->filter('div.js-stream-tweet');

                if ($tweetsCrawler->count() == 0) {
                    break;
                }

                $tweetsCrawler->each(function ($tweet) use (&$results) {
                    /** @var $tweet \Symfony\Component\DomCrawler\Crawler */
                    $username = $tweet->filter('span.username.js-action-profile-name b')->first()->text();
                    $text = str_replace('[^\\u0000-\\uFFFF]', '', $tweet->filter('p.js-tweet-text')->first()->text());
                    $retweets = intval(str_replace(',', '', $tweet->filter('span.ProfileTweet-action--retweet span.ProfileTweet-actionCount')->first()->attr('data-tweet-stat-count')));
                    $favorites = intval(str_replace(',', '', $tweet->filter('span.ProfileTweet-action--favorite span.ProfileTweet-actionCount')->first()->attr('data-tweet-stat-count')));
                    $date = new \DateTime('@'.intdiv(intval($tweet->filter('small.time span.js-short-timestamp')->first()->attr('data-time-ms')), 1000));
                    $id = $tweet->first()->attr('data-tweet-id');
                    $permalink = $tweet->first()->attr('data-permalink-path');

                    preg_match("(@\\w*)", $text, $mentions);
                    preg_match("(#\\w*)", $text, $hashtags);

                    $geo = '';
                    $geoElement = $tweet->filter('span.Tweet-geo')->first();
                    if ($geoElement->count() > 0) {
                        $geo = $geoElement->attr('title');
                    }

                    $resultTweet = new Tweet();
                    $resultTweet->setId($id);
                    $resultTweet->setPermalink("https://twitter.com" . $permalink);
                    $resultTweet->setUsername($username);
                    $resultTweet->setText($text);
                    $resultTweet->setDate($date);
                    $resultTweet->setRetweets($retweets);
                    $resultTweet->setFavorites($favorites);
                    $resultTweet->setMentions($mentions);
                    $resultTweet->setHashtags($hashtags);
                    $resultTweet->setGeo($geo);

                    $results[] = $resultTweet;
                });

            } while (count($results) < $criteria->getMaxTweets());

        } catch (\Exception $e) {
            $this->handleException($e);
            return $results;
        }

        return $results;
    }


    /**
     * @param $username
     * @param $since
     * @param $until
     * @param $querySearch
     * @param $scrollCursor
     * @return mixed
     */
    public function getUrlResponse($username, $since, $until, $querySearch, $scrollCursor)
    {
        $appendQuery = "";

        if ($username != null) {
            $appendQuery .= 'from:' . $username;
        }

        if ($since != null) {
            $appendQuery .= ' since:' . $since;
        }

        if ($until != null) {
            $appendQuery .= ' until:' . $until;
        }

        if ($querySearch != null) {
            $appendQuery .= ' ' . $querySearch;
        }

        $url = sprintf('https://twitter.com/i/search/timeline?f=realtime&q=%s&src=typd&max_position=%s', urlencode(utf8_encode($appendQuery)), $scrollCursor);
        $request = $this->client->createRequest('GET', $url);
        $request->setHeader('User-Agent', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.4; en-US; rv:1.9.2.2) Gecko/20100316 Firefox/3.6.2');
        $response = $this->client->send($request);

        return $response->json();
    }

    protected function handleException(\Exception $e)
    {

        var_dump($e->getMessage());
        //Insert your method here.
    }


}