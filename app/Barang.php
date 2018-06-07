<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $table = 'barang';
    protected $primaryKey='IdBarang';
    protected $guarded=[];
    public $timestamps =false;

    public function kategori(){
        return $this->belongsTo(kategori::class, 'IdKategori');
    }
}
