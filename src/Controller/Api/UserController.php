<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function getUserById(User $user)
    {
        return $this->render('user/user/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
