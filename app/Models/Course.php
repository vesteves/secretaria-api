<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = "courses";

    protected $fillable = [
        "name",
        "summary",
        "description",
        "area_id",
        "position",
        "workload",
        "inCompany",
    ];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
