<?php

namespace App\Repositories;

use App\Models\ImportItem;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ImportItemRepository
 * @package App\Repositories
 * @version January 6, 2019, 3:44 pm UTC
 *
 * @method ImportItem findWithoutFail($id, $columns = ['*'])
 * @method ImportItem find($id, $columns = ['*'])
 * @method ImportItem first($columns = ['*'])
*/
class ImportItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'import_id',
        'product_id',
        'stock_id',
        'value'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ImportItem::class;
    }
}
