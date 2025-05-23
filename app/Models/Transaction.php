<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Buyer;
use App\Models\Product;

class Transaction extends Model
{
    
    use HasFactory;
    use SoftDeletes;

    protected $dates =['delete_at'];
    protected $table ='transactions';
    
    protected $fillable =
    [
        'quantity',
        'buyer_id',
        'product_id'
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class); //BelongsTo
    }
}
