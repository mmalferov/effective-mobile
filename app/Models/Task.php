<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Allowed mass assignment fields
    protected $fillable = ['title', 'description', 'status'];
}
