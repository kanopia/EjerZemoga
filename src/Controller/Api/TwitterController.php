<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Services\TwitterApiService;
use PHPUnit\Util\Json;
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
     * @Route("/tweets/{twitterName}", name="get_tweets", methods={"GET"})
     * @param string $twitterName
     * @param TwitterApiService $twitterApi
     * @return JsonResponse
     */
    public function getTweets(string $twitterName, TwitterApiService $twitterApi): JsonResponse
    {
        try {
            return new JsonResponse($twitterApi->getTweets($twitterName));
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], $exception->getCode());
        }
    }
}
