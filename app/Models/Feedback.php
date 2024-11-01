<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    protected $primaryKey = 'feedback_id';

    protected $fillable = [
        'feedback_name',
        'company_name',
        'feedback_description',
        'rate',
        'created_at',
        'updatet_at',
    ];
}
