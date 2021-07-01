<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jenis extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function barang()
    {
        return $this->hasMany(Barang::class,'jenis_id','id')->withTrashed();
    }
}
