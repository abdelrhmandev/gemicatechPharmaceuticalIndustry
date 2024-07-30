<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Brand extends Model
{

	protected $table = 'brands';
    protected $guarded = ['id'];


public $timestamps = true;


    protected $fillable = [
		'title','description','image','brand'
	];


    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
