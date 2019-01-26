<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 * @package App\Models
 * @version January 4, 2019, 3:02 pm UTC
 *
 * @property integer user_id
 * @property integer product_id
 * @property integer value
 * @property date date
 * @property float price
 * @property string remark
 * @property integer order_status
 */
class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'date',
        'price',
        'remark',
        'order_status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'date' => 'date',
        'price' => 'float',
        'remark' => 'string',
        'order_status' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');

    }

    public function item()
    {
        return $this->hasMany('App\Models\OrderItem');

    }
}
