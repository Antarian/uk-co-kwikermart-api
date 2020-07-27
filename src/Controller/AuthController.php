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
    private $authService;

    /**
     * AuthController constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param AuthServiceInterface $authService
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, AuthServiceInterface $authService)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->authService = $authService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
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

        $this->authService->register($user);

        return new JsonResponse(null, 201);
    }
}
