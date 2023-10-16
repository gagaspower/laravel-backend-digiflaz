<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrefixNumber extends Model
{
    use HasFactory;

    protected $table = 'prefix_number';
    protected $primaryKey = 'id';
    protected $fillable = [
        'number',
        'provider'
    ];

    public function scopeFindProviderByNumber($query, $value)
    {
        $query->where('number', $value);
    }
}
