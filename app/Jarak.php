<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jarak extends Model
{
    //
    protected $table = 'jarak';
    protected $primaryKey='IdJarak';
    protected $guarded=[];
    public $timestamps =false;

    public function puskesmasawal(){
        return $this->belongsTo(puskesmas::class, 'IdPuskesmasAwal');
    }
    public function puskesmastujuan(){
        return $this->belongsTo(puskesmas::class, 'IdPuskesmasTujuan');
    }

    public function scopeJarak($query,$p1,$p2)
    {
        $query->where(function($q) use ($p1,$p2){
            $q->where('IdPuskesmasAwal',$p1)
                ->where('IdPuskesmasTujuan',$p2);
        })->orWhere(function($q) use ($p1,$p2){
            $q->where('IdPuskesmasTujuan',$p1)
                ->where('IdPuskesmasAwal',$p2);
        });
    }
}
