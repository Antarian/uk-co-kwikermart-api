<?php
namespace App\Controller;

use App\Auth\AuthServiceInterface;
use App\Auth\ORM\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController extends AbstractController
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var AuthServiceInterface
     */
    private $service;

    /**
     * AuthController constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param AuthServiceInterface $service
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, AuthServiceInterface $service)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->service = $service;
    }

    public function register(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->get('serializer')->deserialize($request->getContent(), User::class, 'json');

        if ($validation = $this->validateInput($user)) {
            return $validation;
        }

        // encode the plain password
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                $user->getPassword()
            )
        );

        $this->service->register($user);

        return new JsonResponse(null, 201);
    }
}
