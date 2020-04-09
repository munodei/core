<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    protected $table = 'withdrawal_requests';
    protected $fillable = ['id', 'user_id', 'phone', 'is_whatsapp', 'method', 'status', 'reason', 'amount', 'charge', 'total_debited', 'pre_balance', 'post_balance', 'bank', 'bank_account', 'branch_code', 'name_of_recipient', 'deleted_at', 'branch', 'created_at', 'update_at'];
}
