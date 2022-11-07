<?php

namespace App\Repositories;

use App\Models\Cookie;

/**
 * Class CookieRepository
 * @package App\Repositories
 * @version May 13, 2022, 10:11 am UTC
 */
class CookieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'isMandatory'
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
        return Cookie::class;
    }
}
