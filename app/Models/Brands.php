<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id';

    protected $fillable = [
        'brandname',
        'slug',
        'image',
        'status'
    ];
}
