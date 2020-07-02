<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Portfolio;
use App\Form\PortfolioType;
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
     * @Route("/update/{id}", name="update_portfolio", methods={"POST"})
     * @param Request $request
     * @param Portfolio $portfolio
     * @param UpdaterPortfolioService $updaterPortfolio
     * @return Response
     */
    public function update(Request $request, Portfolio $portfolio, UpdaterPortfolioService $updaterPortfolio): Response
    {
        try {
            if ($updaterPortfolio->update($portfolio, $request)) {
                return $this->redirectToRoute('get_profile', ['id' => $portfolio->getTwitterUserName()]);
            }
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], $exception->getCode());
        }
    }
}
