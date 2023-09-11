<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['title', 'slug', 'image', 'description', 'is_published', 'type_id'];

    public function getImagePath()
    {
        return asset('storage' . $this->image);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
