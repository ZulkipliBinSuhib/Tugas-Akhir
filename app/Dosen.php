<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $filable = ['name','nidn','jenis_kelamin','status','bidang','prodi'];

    public function relasion()
    {
        return $this->belongsTo('App\Sebaran');
    }
}
