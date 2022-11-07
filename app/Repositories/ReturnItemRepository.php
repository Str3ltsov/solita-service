<?php

namespace App\Repositories;

use App\Models\ReturnItem;
use App\Repositories\BaseRepository;

/**
 * Class ReturnItemRepository
 * @package App\Repositories
 * @version April 14, 2022, 8:58 am UTC
*/

class ReturnItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'user_id',
        'return_id',
        'product_id',
        'price_current',
        'count'
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
        return ReturnItem::class;
    }
}
