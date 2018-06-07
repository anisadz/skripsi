<?php
/**
 * Created by PhpStorm.
 * User: Anisa
 * Date: 3/15/2017
 * Time: 10:35 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
class Pendistribusian extends Model
{
    protected $table = 'distribusi';
    protected $primaryKey='IdDistribusi';
    protected $guarded=[];
    public $timestamps =false;

    public function user(){
        return $this->belongsTo(users::class, 'IdUser');
    }
}