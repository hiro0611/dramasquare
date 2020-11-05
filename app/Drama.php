<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drama extends Model
{
    protected $fillable = ['drama_title', 'category_name', 'drama_story', 'drama_image'];
}
