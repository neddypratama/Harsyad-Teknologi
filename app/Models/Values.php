<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Values extends Model
{
    use HasFactory;
    protected $table = 'values';
    protected $primaryKey = 'values_id';

    protected $fillable = [
        'short_name',
        'values_name',
        'values_description',
        'created_at',
        'updatet_at',
    ];
}
