<?php

namespace App\Repositories;

use App\Models\CartStatus;
use App\Repositories\BaseRepository;

/**
 * Class CartStatusRepository
 * @package App\Repositories
 * @version March 29, 2022, 4:08 pm UTC
*/

class CartStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return CartStatus::class;
    }
}
