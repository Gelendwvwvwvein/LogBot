<?php

namespace App\Controller;

use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{

    public function __construct (
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $hasher
    ) {}

    public function __invoke (User $user): JsonResponse {

        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->hasher->hashPassword($user, $user->getPassword()));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'OK'], Response::HTTP_CREATED);
    }
}