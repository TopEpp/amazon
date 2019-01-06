<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ImportItem
 * @package App\Models
 * @version January 6, 2019, 3:44 pm UTC
 *
 * @property integer import_id
 * @property integer product_id
 * @property integer stock_id
 * @property integer value
 */
class ImportItem extends Model
{
    use SoftDeletes;

    public $table = 'import_items';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'import_id',
        'product_id',
        'stock_id',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'import_id' => 'integer',
        'product_id' => 'integer',
        'stock_id' => 'integer',
        'value' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
