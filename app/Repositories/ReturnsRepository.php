<?php

namespace App\Repositories;

use App\Models\Returns;
use App\Repositories\BaseRepository;

/**
 * Class ReturnsRepository
 * @package App\Repositories
 * @version April 14, 2022, 7:50 am UTC
*/

class ReturnsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'admin_id',
        'order_id',
        'code',
        'description',
        'status_id'
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
        return Returns::class;
    }
}
