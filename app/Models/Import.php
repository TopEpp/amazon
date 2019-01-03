<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Import
 * @package App\Models
 * @version January 3, 2019, 5:07 am UTC
 *
 * @property integer user_id
 * @property integer product_id
 * @property integer value
 * @property date date
 * @property float price
 * @property string remark
 * @property integer import_status
 */
class Import extends Model
{
    use SoftDeletes;

    public $table = 'imports';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'product_id',
        'value',
        'date',
        'price',
        'remark',
        'import_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'product_id' => 'integer',
        'value' => 'integer',
        'date' => 'date',
        'price' => 'float',
        'remark' => 'string',
        'import_status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
