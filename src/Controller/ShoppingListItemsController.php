<?php
namespace App\Controller;

use App\Auth\ORM\Entity\User;
use App\ShoppingList\ORM\Entity\ShoppingList;
use App\ShoppingList\ORM\Entity\ShoppingListItem;
use App\ShoppingList\ShoppingListItemServiceInterface;
use App\ShoppingList\ShoppingListServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class ShoppingListItemsController extends AbstractController
{
    /**
     * @var ShoppingListItemServiceInterface
     */
    private $shoppingListItemService;

    /**
     * @var Security
     */
    private $security;
    /**
     * @var ShoppingListServiceInterface
     */
    private $shoppingListService;

    /**
     * AuthController constructor.
     * @param ShoppingListItemServiceInterface $shoppingListItemService
     * @param ShoppingListServiceInterface $shoppingListService
     * @param Security $security
     */
    public function __construct(ShoppingListItemServiceInterface $shoppingListItemService, ShoppingListServiceInterface $shoppingListService, Security $security)
    {
        $this->shoppingListItemService = $shoppingListItemService;
        $this->security = $security;
        $this->shoppingListService = $shoppingListService;
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function create(int $id, Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->security->getUser();
        if ($user->getIdentity() === $this->shoppingListService->find($id)->getCreatedBy()) {

            /** @var ShoppingListItem $shoppingListItem */
            $shoppingListItem = $this->get('serializer')->deserialize($request->getContent(), ShoppingListItem::class, 'json');

            if ($id !== $shoppingListItem->getShoppingList()->getId()) {
                return new JsonResponse(null, 400);
            }

            if ($validation = $this->validateInput($shoppingListItem)) {
                return $validation;
            }

            $id = $this->shoppingListItemService->add($shoppingListItem);

            return new JsonResponse(['id' => $id], 201);
        }

        return new JsonResponse(null, 403);
    }
}
