<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Model\Page;
use App\EloquentCategory;

class EloquentPage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'contents', 'url', 'category'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $table = 'page';

    public $timestamps = false;

    public function intoModel(){
        return new Page($this->attributes["id"],  $this->attributes["name"], $this->attributes["contents"], $this->attributes["url"], EloquentCategory::find($this->attributes["category"])->intoModel());
    }
}
