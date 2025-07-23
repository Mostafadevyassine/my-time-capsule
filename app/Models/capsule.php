<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capsule extends Model
{
    /** @use HasFactory<\Database\Factories\CapsuleFactory> */
    use HasFactory;

    // App\Models\Capsule.php
protected $appends = ['image_url'];

public function getImageUrlAttribute()
{
    return $this->file_name ? asset('storage/capsules/' . $this->file_name) : null;
}
}
