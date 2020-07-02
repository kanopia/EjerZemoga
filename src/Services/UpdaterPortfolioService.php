<?php
declare(strict_types=1);

namespace App\Services;

use App\Form\PortfolioType;
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
     * UpdaterUserService constructor.
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $entityManager)
    {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Portfolio $portfolio
     * @param Request $request
     * @return bool
     * @throws \Exception
     */
    public function update(Portfolio $portfolio, Request $request): bool
    {
        try {
            $form = $this->formFactory->create(PortfolioType::class, $portfolio);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->entityManager->persist($portfolio);
                $this->entityManager->flush();
            }
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), 500);
        }
        return true;
    }

}