<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version January 4, 2019, 3:02 pm UTC
 *
 * @property integer category_id
 * @property string name
 * @property float price
 * @property integer unit_id
 */
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'category_id',
        'name',
        'code',
        'price',
        'unit_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'name' => 'string',
        'code' => 'string',
        'price' => 'float',
        'unit_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Units');
    }

    public function stock()
    {
        return $this->belongsTo('App\Models\Stock', 'id', 'product_id');
        // return $this->belongsTo('App\Models\Stock');
    }

}
