<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Block extends Model
{

	protected $table = 'blocks';
    protected $guarded = ['id'];


public $timestamps = true;


    protected $fillable = [
		'title','description','image'
	];

}
