<?php

namespace App\Repositories;

use App\Models\Units;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UnitsRepository
 * @package App\Repositories
 * @version January 3, 2019, 2:37 pm UTC
 *
 * @method Units findWithoutFail($id, $columns = ['*'])
 * @method Units find($id, $columns = ['*'])
 * @method Units first($columns = ['*'])
*/
class UnitsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Units::class;
    }
}
