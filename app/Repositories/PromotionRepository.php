<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Repositories\BaseRepository;

/**
 * Class PromotionRepository
 * @package App\Repositories
 * @version March 15, 2022, 5:31 pm UTC
*/

class PromotionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'description',
        'start',
        'finish'
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
        return Promotion::class;
    }
}
