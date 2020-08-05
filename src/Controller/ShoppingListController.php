<?php
namespace App\Controller;

use App\Dtos\ShoppingListDto;
use App\ShoppingList\Services\ShoppingListServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ShoppingListController extends AbstractController
{
    /**
     * @var ShoppingListServiceInterface
     */
    private $shoppingListService;

    /**
     * ShoppingListController constructor.
     * @param ShoppingListServiceInterface $shoppingListService
     */
    public function __construct(ShoppingListServiceInterface $shoppingListService)
    {
        $this->shoppingListService = $shoppingListService;
    }

    /**
     * @param Request $request
     */
    public function create(Request $request): JsonResponse
    {
        /** @var ShoppingListDto $shoppingList */
        $shoppingList = $this->get('serializer')->deserialize($request->getContent(), ShoppingListDto::class, 'json');

        if ($validation = $this->validateInput($shoppingList)) {
            return $validation;
        }

        $this->shoppingListService->addShoppingList($shoppingList->getTitle());

        return new JsonResponse(null, 201);
    }
}