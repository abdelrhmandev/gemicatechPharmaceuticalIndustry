<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SocialNetWork extends Model
{
    protected $table = 'social_networks';
    protected $guarded = ['id'];

    public $timestamps = false;

    protected $fillable = ['title', 'icon', 'link'];
}
