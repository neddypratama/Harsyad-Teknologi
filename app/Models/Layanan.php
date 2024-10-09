<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Layanan extends Model
{
    use HasFactory;
    protected $table = 'layanans';
    protected $primaryKey = 'layanan_id';
    protected $fillable = [
        'layanan_name',
        'layanan_description',
        'service_id',
    ];
    public function detail():BelongsTo{
        return $this -> belongsTo(Service::class, 'service_id', 'service_id');
    }
}
