<?php
declare(strict_types=1);

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Entity\User\User;
use Endroid\Twitter\Client;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class TwitterApiService
 * @package App\Services
 */
class TwitterApiService
{
    /**
     * @param User $user
     * @return JsonResponse
     */
    public function getTweets(User $user): JsonResponse
    {
        $credentialsUser = $user->getTwitterAuth();
//        $twitterOAuth = new TwitterOAuth(
//            $credentialsUser->getConsumerKey(),
//            $credentialsUser->getConsumerSecret(),
//            $credentialsUser->getOauthToken(),
//            $credentialsUser->getOauthTokenSecret()
//        );
//        $client = new Client($twitterOAuth);
//
//        $tweets = $client->getTimeline(5);
        $str = file_get_contents('data.json');
        return new JsonResponse(json_decode($str));
    }

}