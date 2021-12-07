<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table = 'articles';
    public const CREATED_AT = 'published';
    public const UPDATED_AT = 'modified';
}
