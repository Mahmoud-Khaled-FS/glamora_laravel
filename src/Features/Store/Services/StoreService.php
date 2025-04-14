<?php

namespace Src\Features\Store\Services;

use Illuminate\Support\Facades\Storage;
use Src\Features\Store\Models\Store;
use Src\Shared\Error\AppError;
use Src\Shared\Error\ErrorCode;

class StoreService
{
    public function getAllStores()
    {
        return Store::paginate();
    }

    public function findStore($id)
    {
        $store = Store::find($id);

        if (!$store) {
            throw new AppError('Store not found', 404, ErrorCode::ERR_NOT_FOUND);
        }
        return $store;
    }

    public function getStoreProducts(int $id) {
        $store = Store::with(['products'])->find($id);
        return $store->products;
    }
}
