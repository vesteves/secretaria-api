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
        "course_id",
        "classroom_id",
        "teacher",
        "inCompany",
        "frequency",
        "modalities",
    ];

    protected $casts = [
        "frequency" => "array",
        "modalities" => "array",
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
                "price",
                "links",
                "status",
                "motivation",
            )
            ->withTimestamps();
    }
}
