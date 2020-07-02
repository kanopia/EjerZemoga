<?php
declare(strict_types=1);

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Repository\TwitterAuthRepository;
use Endroid\Twitter\Client;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class TwitterApiService
 * @package App\Services
 */
class TwitterApiService
{

    /**
     * @var TwitterAuthRepository
     */
    private $twitterAuthRepository;

    /**
     * @var Client
     */
    private $client;

    /**
     * TwitterApiService constructor.
     * @param TwitterAuthRepository $twitterAuthRepository
     */
    public function __construct(TwitterAuthRepository $twitterAuthRepository)
    {
        $this->twitterAuthRepository = $twitterAuthRepository;
    }

    /**
     * @param string $twitterUserName
     * @param int $tweets
     * @return array
     * @throws \Exception
     */
    public function getTweets(string $twitterUserName, int $tweets = 5): array
    {
        $this->setClientOAuth();

        return $this->getTweetsByData($twitterUserName, $tweets);
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function setClientOAuth(): void
    {
        $twitterAuth = $this->twitterAuthRepository->findOneBy(['id' => 1]);
        if (!$twitterAuth) {
            throw new \Exception('Credentials no Found', 404);
        }

        $twitterOAuth = new TwitterOAuth(
            $twitterAuth->getConsumerKey(),
            $twitterAuth->getConsumerSecret(),
            $twitterAuth->getOauthToken(),
            $twitterAuth->getOauthTokenSecret()
        );

        $this->client = new Client($twitterOAuth);
    }

    /**
     * @param string $twitterUserName
     * @param int $tweets
     * @return array
     */
    private function getTweetsByData(string $twitterUserName, int $tweets): array
    {
        $tweets = $this->client->getClient()->get(
            'statuses/user_timeline',
            [
                'screen_name' => $twitterUserName,
                'count' => $tweets
            ]
        );
        return $tweets;
    }

}