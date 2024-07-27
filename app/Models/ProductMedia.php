<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductMedia extends Model
{

	protected $table = 'product_media';

    protected $fillable = [
		'product_id',
		'assigned_for',
		'file',
	];

	public $timestamps = false;




	public function product(){
		return $this->belongsTo(Product::class,'id','product_id');
   }



}
