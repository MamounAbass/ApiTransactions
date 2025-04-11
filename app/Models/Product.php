<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Seller;
use App\Models\Transaction;

class Product extends Model
{

    CONST AVILABLE_PRODUCT ='avilable';
    CONST UNAVILABLE_PRODUCT ='unavilable';

    use HasFactory;
    use SoftDeletes;

    protected $table = 'Products';
    protected $dates =['delete_at'];
    protected $fillable =[

        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id'
    ];

    public function isAvilable()
    {
        return $this->status == Product::AVILABLE_PRODUCT;
    }

    public function isNotAvilable()
    {
        return $this->status ==Product::UNAVILABLE_PRODUCT;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function Transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
