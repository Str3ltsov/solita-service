<?php

namespace App\Repositories;

use App\Models\ReturnStatus;
use App\Repositories\BaseRepository;

/**
 * Class ReturnStatusRepository
 * @package App\Repositories
 * @version March 29, 2022, 4:08 pm UTC
*/

class ReturnStatusRepository extends BaseRepository
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
        return ReturnStatus::class;
    }
}
