<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $primaryKey = 'project_id';

    protected $fillable = [
        'project_name',
        'project_type',
        'project_description',
        'created_at',
        'updatet_at',
    ];

    public function galery():HasMany{
        return $this -> hasMany(Project::class, 'project_id', 'project_id');
    }
}
