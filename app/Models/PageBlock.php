<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PageBlock extends Model
{
    protected $table = 'page_block';
    protected $guarded = ['id'];

    public $timestamps = false;
}
