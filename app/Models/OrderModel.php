<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class OrderModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trn_order';

    protected $fillable = ['user_id', 'total', 'name', 'mobile', 'address', 'time_slot', 'instructions', 'status', 'user_type', 'created_at', 'updated_at'];
}
