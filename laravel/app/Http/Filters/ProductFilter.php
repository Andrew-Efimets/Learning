<?php

namespace App\Http\Filters;

use Illuminate\Http\Request;

class ProductFilter extends QueryFilter
{
    public function price_from($price_from)
    {
        if (!empty($price_from) && is_numeric($price_from)) {

            return $this->builder->where('price', '>=', $price_from);
        }
        return $this->builder;
    }

    public function price_to($price_to)
    {
        if (!empty($price_to) && is_numeric($price_to)) {

            return $this->builder->where('price', '<=', $price_to);
        }
        return $this->builder;
    }

    public function photo_exist($photo_exist)
    {
        $photo_exist = 'photo';
        return $this->builder->where('photo_exist', $photo_exist);
    }

    public function category_id($category_id)
    {
        if ($category_id === 'all') {
            return $this->builder;
        }
        return $this->builder->where('category_id', $category_id);
    }

    public function city_id($city_id)
    {
        if ($city_id === 'all') {
            return $this->builder;
        }
        return $this->builder->where('city_id', $city_id);
    }
}
