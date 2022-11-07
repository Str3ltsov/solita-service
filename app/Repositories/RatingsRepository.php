<?php

namespace App\Repositories;

use App\Models\Ratings;
use App\Repositories\BaseRepository;

/**
 * Class RatingsRepository
 * @package App\Repositories
 * @version April 17, 2022, 8:43 am UTC
*/

class RatingsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'value'
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
        return Ratings::class;
    }
}
