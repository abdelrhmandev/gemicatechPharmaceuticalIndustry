<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductIndustry extends Model
{
    protected $guarded = ['id'];

    protected $table = 'product_industry';

    protected $fillable = ['product_id','industry_id'];
    public $timestamps = false;


    // # single Item

    public function product(){
        return $this->belongsToMany(Product::class, 'product_industry'); // recipe_tag = table
    }


}
