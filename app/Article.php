<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'articles';


    protected $fillable = ['title','slug','body','category','post_image','user_id'];


    public function User(){
        return $this->belongsTo('App\User');
    }

    public function Category(){
        return $this->belongsTo('App\Category','category');
    }
}
