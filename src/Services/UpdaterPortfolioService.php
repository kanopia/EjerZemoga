<?php
declare(strict_types=1);

namespace App\Services;

use App\Entity\Portfolio;
use App\Form\PortfolioType;
use App\Repository\PortfolioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UpdaterUserService
 * @package App\Services
 */
class UpdaterPortfolioService
{

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var PortfolioRepository
     */
    private $portfolioRepository;

    /**
     * UpdaterUserService constructor.
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     * @param PortfolioRepository $portfolioRepository
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        PortfolioRepository $portfolioRepository
    )
    {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->portfolioRepository = $portfolioRepository;
    }

    /**
     * @param string $twitterName
     * @param Request $request
     * @return Portfolio
     * @throws \Exception
     */
    public function update(string $twitterName, Request $request): Portfolio
    {
        try {
            $portfolio = $this->portfolioRepository->findOneBy(['twitterUserName' => $twitterName]);
            if (is_null($portfolio)) {
                throw new \Exception('Portfolio no found', 404);
            }
            $form = $this->formFactory->create(PortfolioType::class, $portfolio);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->entityManager->persist($portfolio);
                $this->entityManager->flush();
            }
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), 500);
        }
        return $portfolio;
    }

}