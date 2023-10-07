<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TransactionModel extends Model
{
    use HasFactory;

    protected $table = 'transaction';
    protected $primaryKey = 'id';
    protected $fillable = [
        'transaction_code',
        'transaction_date',
        'transaction_time',
        'transaction_type',
        'transaction_provider',
        'transaction_number',
        'transaction_sku',
        'transaction_total',
        'transaction_message',
        'transaction_status',
        'transaction_user_id',
    ];


    public function insert_transaction_data($data, $type, $provider)
    {
        return self::create([
            'transaction_code' => $data['ref_id'],
            'transaction_date' => Carbon::now()->format('Y-m-d'),
            'transaction_time' => Carbon::now(),
            'transaction_type' => $type,
            'transaction_provider' => $provider,
            'transaction_number' => $data['customer_no'],
            'transaction_sku' => $data['buyer_sku_code'],
            'transaction_total' => 0,
            'transaction_message' => $data['message'],
            'transaction_status' => $data['status'],
            'transaction_user_id' => 2
        ]);
    }
}
