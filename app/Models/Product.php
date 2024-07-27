<?php
namespace App\Models;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    protected $guarded = ['id'];

	public $timestamps = true;



    protected $fillable = [
		'title',
		'slug',
        'brief',
		'image',
		'description',
        'icon',
		'brand_id',
	];


	public function media(){
		return $this->hasMany(ProductMedia::class);
   }


   public function brand()
   {
       return $this->belongsTo(Brand::class,'brand_id','id');
   }

    public function categories(){
        return $this->belongsToMany(Category::class, 'product_category','product_id','category_id');
    }
    public function sub_categories(){
        return $this->belongsToMany(Category::class, 'product_category','product_id','category_id');
    }
    public function industries(){
        return $this->belongsToMany(Industry::class, 'product_industry','product_id','industry_id');
    }

}
