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
        "canEnroll",
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    function students()
    {
        return $this->belongsToMany(Student::class)
            ->withPivot(
                "modality",
                "payment",
                "discover",
                "google",
            )
            ->withTimestamps();
    }
}
