<?php

namespace App\Controllers;

use Illuminate\Support\Collection;

class Reports
{
    protected $store = '';
    protected $capsule = '';

    /**
     * @param $store
     */
    public function __construct($store)
    {
        $this->store = $store;
        $this->capsule = (new Database())->getManager();
    }

    /**
     * @param $store
     * @return Collection
     */
    public function getData($store): Collection
    {
        return $this->capsule->table('store_data')
            ->where('name', $store)
            ->get();
    }
}
