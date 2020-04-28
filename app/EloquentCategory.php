<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Model\Category;

class EloquentCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $table = 'category';

    public function intoModel(){
        return new Category($this->attributes["id"],  $this->attributes["name"]);
    }

    public $timestamps = false;
}
