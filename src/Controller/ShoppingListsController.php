<?php
namespace App\Controller;

use App\Auth\ORM\Entity\User;
use App\ShoppingListOld\ORM\Entity\ShoppingList;
use App\ShoppingListOld\ShoppingListServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class ShoppingListsController extends AbstractController
{
    /**
     * @var ShoppingListServiceInterface
     */
    private $shoppingListService;

    /**
     * @var Security
     */
    private $security;

    /**
     * AuthController constructor.
     * @param ShoppingListServiceInterface $shoppingListService
     * @param Security $security
     */
    public function __construct(ShoppingListServiceInterface $shoppingListService, Security $security)
    {
        $this->shoppingListService = $shoppingListService;
        $this->security = $security;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        /** @var ShoppingList $shoppingList */
        $shoppingList = $this->get('serializer')->deserialize($request->getContent(), ShoppingList::class, 'json');

        if ($validation = $this->validateInput($shoppingList)) {
            return $validation;
        }

        /** @var User $user */
        $user = $this->security->getUser();
        $shoppingList->setCreatedBy($user->getIdentity());

        $id = $this->shoppingListService->add($shoppingList);

        return new JsonResponse(['id' => $id], 201);
    }

    /**
     * @return JsonResponse
     */
    public function readAll(): JsonResponse
    {
        /** @var User $user */
        $user = $this->security->getUser();

        $shoppingLists = $this->shoppingListService->finAllByCreatedBy($user->getIdentity());
        $shoppingListsJson = $this->get('serializer')->serialize($shoppingLists, 'json');

        return new JsonResponse($shoppingListsJson, 200, [], true);
    }
}
