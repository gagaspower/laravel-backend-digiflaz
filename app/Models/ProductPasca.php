<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPasca extends Model
{
    use HasFactory;

    protected $table = 'product_pasca';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_name',
        'product_category',
        'product_provider',
        'product_seller',
        'product_transaction_admin',
        'product_transaction_fee',
        'product_sku',
    ];



    public function scopeFindBySKU($query, $value)
    {
        $query->where('product_sku', $value);
    }

    public function insert_data($data)
    {
        $insertData = [];
        foreach ($data as $result) {
            $insertData[] = [
                'product_sku' => $result['buyer_sku_code'],
                'product_name' => $result['product_name'],
                'product_category' => $result['category'],
                'product_provider' => $result['brand'],
                'product_seller' => $result['seller_name'],
                'product_transaction_admin' => $result['admin'],
                'product_transaction_fee' => $result['commission'],

            ];
        }
        self::upsert($insertData, ['product_sku'], [
            'product_name',
            'product_category',
            'product_provider',
            'product_seller',
            'product_transaction_admin',
            'product_transaction_fee'
        ]);
    }
}
