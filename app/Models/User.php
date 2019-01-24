<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @version January 4, 2019, 5:03 pm UTC
 *
 * @property string username
 * @property string first_name
 * @property string last_name
 * @property string|\Carbon\Carbon email_verified_at
 * @property string password
 * @property string status
 * @property string remember_token
 */
class User extends Model
{
    use SoftDeletes;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'username',
        'name',
        'password',
        'image',
        'phone',
        'address',
        'address_stock',
        'site_code',
        'status',
        'type',
        'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'username' => 'string',
        'name' => 'string',
        'password' => 'string',
        'image' => 'string',
        'phone' => 'string',
        'address' => 'string',
        'site_code' => 'string',
        'address_stock' => 'string',
        'status' => 'boolean',
        'type' => 'integer',
        'remember_token' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

}
