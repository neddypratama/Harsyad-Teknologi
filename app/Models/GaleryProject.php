<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleryProject extends Model
{
    use HasFactory;
    protected $table = 'galery_projects';
    protected $primaryKey = 'galery_id';

    protected $fillable = [
        'galery_name',
        'project_id',
        'created_at',
        'updatet_at',
    ];
}
