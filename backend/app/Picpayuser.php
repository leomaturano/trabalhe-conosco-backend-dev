<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Picpayuser extends Model
{
    protected $fillable = ['idpp','nome','username'];
    protected $guarded = ['id'];

    //protected $guarded = ['id', 'created_at', 'update_at'];
    //protected $table = 'products';

}
