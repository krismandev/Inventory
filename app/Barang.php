<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class)->withTrashed();
    }
}
