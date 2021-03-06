<?php

namespace App\Repositories;

use App\Models\Import;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ImportRepository
 * @package App\Repositories
 * @version January 4, 2019, 3:03 pm UTC
 *
 * @method Import findWithoutFail($id, $columns = ['*'])
 * @method Import find($id, $columns = ['*'])
 * @method Import first($columns = ['*'])
 */
class ImportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'product_id',
        'value',
        'date',
        'price',
        'remark',
        'number',
        'import_status',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Import::class;
    }
}
