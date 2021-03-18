<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    public function tasks() {
        return $this->hasMany(Task::class, "category_id", "id");
    }

    public function category_children() {
        return $this->hasMany(Category::class, "parent_id", "id");
    }

    public function category_parent() {
        return $this->belongsTo(Category::class, "parent_id", "id");
    }

}
