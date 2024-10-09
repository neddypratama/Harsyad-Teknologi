<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCompany extends Model
{
    use HasFactory;
    protected $table = 'detail_companies';
    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'detail_logo',
        'detail_name',
        'address',
        'created_at',
        'updatet_at',
    ];
}
