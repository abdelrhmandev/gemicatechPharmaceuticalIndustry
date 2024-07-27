<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductCategory extends Model
{
    protected $guarded = ['id'];

    protected $table = 'product_category';

    protected $fillable = ['product_id','category_id'];

    public $timestamps = false;

    // # single Item

    public function product(){
        return $this->belongsToMany(Product::class, 'product_category'); // recipe_tag = table
    }


}
