<?php

namespace App\Repositories;


use App\Models\LogActivity;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Carbon;

/**
 * Class CustomerRepository
 * @package App\Repositories
 * @version March 20, 2022, 11:27 am UTC
*/

class CustomerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'avatar', 'provider_id', 'provider',
        'access_token'
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
        return User::class;
    }


}
