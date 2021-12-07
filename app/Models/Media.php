<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    public const CREATED_AT = 'published';
    public const UPDATED_AT = 'modified';
}
