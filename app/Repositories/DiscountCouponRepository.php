<?php

namespace App\Repositories;

use App\Models\DiscountCoupon;
use App\Repositories\BaseRepository;

/**
 * Class DiscountCouponRepository
 * @package App\Repositories
 * @version March 15, 2022, 5:29 pm UTC
*/

class DiscountCouponRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'used',
        'value',
        'user_id',
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
        return DiscountCoupon::class;
    }
}
