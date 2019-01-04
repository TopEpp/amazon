<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Stock
 * @package App\Models
 * @version January 4, 2019, 3:01 pm UTC
 *
 * @property integer product_id
 * @property integer categoty_id
 * @property integer value
 * @property integer user_id
 * @property integer order_id
 * @property integer import_id
 */
class Stock extends Model
{
    use SoftDeletes;

    public $table = 'stocks';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'product_id',
        'categoty_id',
        'value',
        'user_id',
        'order_id',
        'import_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'categoty_id' => 'integer',
        'value' => 'integer',
        'user_id' => 'integer',
        'order_id' => 'integer',
        'import_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
