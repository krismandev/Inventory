<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class)->withTrashed();
    }
}
