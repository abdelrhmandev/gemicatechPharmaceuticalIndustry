<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
class Category extends Model
{
    protected $guarded = ['id'];

    protected $table = 'categories';

    protected $fillable = ['parent_id','title','slug','color','icon', 'image','created_at'];


    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    // # single Item

    public function product(){
        return $this->belongsToMany(Product::class, 'product_category');
    }


}
