<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\User\User;
use App\Services\TwitterApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TwitterController
 * @package App\Controller\Api
 * @Route("/twitter")
 */
class TwitterController extends AbstractController
{
    /**
     * @Route("/tweets/{id}", name="get_tweets")
     * @param TwitterApiService $twitterApi
     * @param User $user
     * @return JsonResponse
     */
    public function getTweets(TwitterApiService $twitterApi, User $user): JsonResponse
    {
        return $twitterApi->getTweets($user);
    }
}
