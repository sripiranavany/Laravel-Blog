<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';


    protected $fillable = ['name','article','body','user'];


    public function User(){
        return $this->belongsTo('App\User','user');
    }

    public function Article(){
        return $this->belongsTo('App\Article','article');
    }
}
