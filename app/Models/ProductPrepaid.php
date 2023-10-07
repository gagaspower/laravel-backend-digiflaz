<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrepaid extends Model
{
    use HasFactory;

    protected $table = 'product_prepaid';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_name',
        'product_desc',
        'product_category',
        'product_provider',
        'product_type',
        'product_seller',
        'product_seller_price',
        'product_buyer_price',
        'product_sku',
        'product_unlimited_stock',
        'product_stock',
        'product_multi',
    ];


    public function insert_data($data)
    {
        $insertData = [];
        foreach ($data as $result) {
            $insertData[] = [
                'product_sku' => $result['buyer_sku_code'],
                'product_name' => $result['product_name'],
                'product_desc' => $result['desc'],
                'product_category' => $result['category'],
                'product_provider' => $result['brand'],
                'product_type' =>  $result['type'],
                'product_seller' => $result['seller_name'],
                'product_seller_price' => $result['price'],
                'product_buyer_price' => 0,
                'product_unlimited_stock' => $result['unlimited_stock'] ? 'Ya' : 'Tidak',
                'product_stock' => $result['stock'],
                'product_multi' => $result['multi'] ? 'Ya' : 'Tidak',
            ];
        }

        self::upsert($insertData, ['product_sku'], [
            'product_name',
            'product_desc',
            'product_category',
            'product_provider',
            'product_type',
            'product_seller',
            'product_seller_price',
            'product_buyer_price',
            'product_unlimited_stock',
            'product_stock',
            'product_multi'
        ]);
    }
}
