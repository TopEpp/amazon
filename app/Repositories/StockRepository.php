<?php

namespace App\Repositories;

use App\Models\Stock;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StockRepository
 * @package App\Repositories
 * @version January 3, 2019, 5:06 am UTC
 *
 * @method Stock findWithoutFail($id, $columns = ['*'])
 * @method Stock find($id, $columns = ['*'])
 * @method Stock first($columns = ['*'])
*/
class StockRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'categoty_id',
        'value',
        'user_id',
        'order_id',
        'import_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Stock::class;
    }
}
