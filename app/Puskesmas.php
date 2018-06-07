<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puskesmas extends Model
{
    protected $table = 'puskesmas';
    protected $primaryKey='IdPuskesmas';
    protected $guarded=[];
    public $timestamps =false;
}
