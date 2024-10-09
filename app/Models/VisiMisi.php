<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    use HasFactory;
    protected $table = 'visi_misis';
    protected $primaryKey = 'visimisi_id';

    protected $fillable = [
        'visimisi_type',
        'visimisi_description',
        'created_at',
        'updatet_at',
    ];
}

