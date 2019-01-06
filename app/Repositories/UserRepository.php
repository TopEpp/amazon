<?php

namespace App\Repositories;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version January 4, 2019, 5:03 pm UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
 */
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'username',
        'name',
        'password',
        'image',
        'phone',
        'address',
        'address_stock',
        'status',
        'type',
        'remember_token',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
