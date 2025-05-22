<?php

namespace Src\Features\Store\Controllers;

use Src\Features\Products\Resources\ProductResource;
use Src\Features\Store\Requests\StoreRequest;
use Src\Features\Store\Services\StoreService;
use Src\Shared\Response\AppResponse;

class StoreController
{
    public function __construct(public readonly StoreService $storeService) {}
    public function index()
    {
        return AppResponse::ok($this->storeService->getAllStores());
    }

    public function show(int $id)
    {
        $store = $this->storeService->findStore($id);
        return AppResponse::ok($store);
    }

    public function products(int $id)
    {
        $products = $this->storeService->getStoreProducts($id);
        return AppResponse::ok(ProductResource::collection($products));
    }

    public function store(StoreRequest $request)
    {
        $store = $this->storeService->createStore($request->bodyMapped());
        return AppResponse::created($store);
    }

    // public function search(Request $request)
    // {
    //     $query = Store::where('status', true);

    //     if ($request->has('name')) {
    //         $query->where('name', 'like', '%' . $request->name . '%');
    //     }

    //     $stores = $query->paginate(15);

    //     return response()>json([
    //         'status' => true,
    //         'data' => $stores
    //     ]);
    // }
}
