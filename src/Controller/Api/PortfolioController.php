<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Services\GetterPortfolioService;
use App\Services\UpdaterPortfolioService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PortfolioController
 * @package App\Controller\Api
 * @Route("/portfolio")
 */
class PortfolioController extends AbstractController
{
    /**
     * @Route("/profile/{twitterName}", name="get_profile", methods={"GET"})
     * @param string $twitterName
     * @param GetterPortfolioService $getterPortfolio
     * @return Response
     */
    public function getPortfolioById(string $twitterName, GetterPortfolioService $getterPortfolio): Response
    {
        try {
            return $getterPortfolio->getProfile($twitterName);
        } catch (\Exception $exception) {
            return new Response($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @Route("/update/{twitterName}", name="update_portfolio", methods={"POST"})
     * @param Request $request
     * @param string $twitterName
     * @param UpdaterPortfolioService $updaterPortfolio
     * @return Response
     */
    public function update(Request $request, string $twitterName, UpdaterPortfolioService $updaterPortfolio): Response
    {
        try {
            if ($portfolio = $updaterPortfolio->update($twitterName, $request)) {
                return $this->redirectToRoute('get_profile', ['twitterName' => $portfolio->getTwitterUserName()]);
            }
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], $exception->getCode());
        }
    }
}
