<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityStok extends Model
{
	protected $guarded=[];
    public $timestamps=false;
    protected $table 	= 'aktivitas_stok';
}
