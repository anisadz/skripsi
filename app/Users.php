<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey='id';
    protected $guarded=[];
    public $timestamps =true;

    public function level(){
        return $this->belongsTo(Level::class, 'IdLevel');
    }
}
