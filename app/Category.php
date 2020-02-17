<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';


    protected $fillable = ['name','user_id'];


    public function User(){
        return $this->belongsTo('App\User');
    }
}
