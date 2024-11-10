<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = "groups";

    protected $fillable = [
        "start",
        "end",
        "price",
        "discount",
        "course_id",
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
