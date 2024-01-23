<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static find($id)
 */
class Task extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = ['completed' => 'boolean'];
}
