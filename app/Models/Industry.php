<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Industry extends Model
{

	protected $table = 'industries';
    protected $guarded = ['id'];


public $timestamps = true;


    protected $fillable = [
		'title','slug','description','image','color','icon'
	];


    public function product(){
        return $this->belongsToMany(Product::class, 'product_industry');
    }

}
