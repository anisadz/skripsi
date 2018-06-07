<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    //
    protected $table = 'level';
    protected $primaryKey='IdLevel';
    protected $guarded=[];
    public $timestamps =false;


}
