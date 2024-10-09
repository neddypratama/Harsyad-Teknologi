<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'service_name',
        'service_short',
        'service_description',
        'service_icon',
        'service_image',
        'created_at',
        'updatet_at',
    ];

    public function detail():HasMany{
        return $this -> hasMany(Layanan::class, 'service_id', 'service_id');
    }
}
