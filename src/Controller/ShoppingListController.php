<?php
namespace App\Controller;

use App\ShoppingList\Services\ShoppingListServiceInterface;

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


}