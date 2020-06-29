<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\User\User;
use App\Form\UserType;
use App\Services\UpdaterUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller\Api
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/profile/{id}", name="get_user", methods={"GET"})
     * @param User $user
     * @return Response
     */
    public function getUserById(User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);

        return $this->render('user/user/profile.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/update/{id}", name="update_user", methods={"POST"})
     * @param Request $request
     * @param User $user
     * @param UpdaterUserService $updaterUser
     * @return Response
     */
    public function update(Request $request, User $user, UpdaterUserService $updaterUser): Response
    {
        try {
            if ($updaterUser->update($user, $request)) {
                return $this->redirectToRoute('get_user', ['id' => $user->getId()]);
            }
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], $exception->getCode());
        }
    }
}
