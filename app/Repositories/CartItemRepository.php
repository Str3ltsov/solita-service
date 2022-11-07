<?php

namespace App\Repositories;

use App\Models\CartItem;
use App\Repositories\BaseRepository;

/**
 * Class CartItemRepository
 * @package App\Repositories
 * @version March 29, 2022, 4:20 pm UTC
*/

class CartItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cart_id',
        'product_id',
        'price_current'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CartItem::class;
    }
}
