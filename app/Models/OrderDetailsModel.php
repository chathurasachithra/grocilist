<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class OrderDetailsModel extends Model
{
    /**
         * The database table used by the model.
         *
         * @var string
         */
    protected $table = 'trn_order_details';

    protected $fillable = ['order_id', 'item_id', 'quantity', 'unit_price'];
}
