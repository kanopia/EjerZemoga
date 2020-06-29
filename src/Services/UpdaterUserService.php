<?php
declare(strict_types=1);

namespace App\Services;

use App\Entity\User\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UpdaterUserService
 * @package App\Services
 */
class UpdaterUserService
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
     * @param User $user
     * @param Request $request
     * @return bool
     * @throws \Exception
     */
    public function update(User $user, Request $request): bool
    {
        try {
            $form = $this->formFactory->create(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                dump($user);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
            }
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), 500);
        }
        return true;
    }

}