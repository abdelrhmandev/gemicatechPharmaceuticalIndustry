<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Page extends Model
{

	protected $table = 'pages';
    protected $guarded = ['id'];


public $timestamps = true;


    protected $fillable = [
		'title','sub_title','slug','description','image','template'
	];

    public function block(){
        return $this->belongsToMany(Block::class, 'page_block');
    }

}
