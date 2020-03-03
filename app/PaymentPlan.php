<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPlan extends Model
{
     protected $table = 'payment_plans';
     protected $fillable = ['id', 'name', 'hexcolor', 'fontcolor', 'cost', 'days', 'sales', 'description', 'votes', 'created_at', 'updated_at'];
}
