<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'title', 'description', 'module_type', 'file_type', 'document', 'view', 'status', 'youtube', 'order'
    ];
}
