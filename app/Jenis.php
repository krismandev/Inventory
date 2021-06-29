<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function barang()
    {
        return $this->hasMany(Barang::class,'jenis_id','id');
    }
}
