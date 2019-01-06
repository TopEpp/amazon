<?php

namespace App\Repositories;

use App\Models\OrderItem;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderItemRepository
 * @package App\Repositories
 * @version January 6, 2019, 3:44 pm UTC
 *
 * @method OrderItem findWithoutFail($id, $columns = ['*'])
 * @method OrderItem find($id, $columns = ['*'])
 * @method OrderItem first($columns = ['*'])
*/
class OrderItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'product_id',
        'stock_id',
        'value'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderItem::class;
    }
}
