<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = "students";

    protected $fillable = [
        "name",
        "email",
        "birthdate",
        "phone",
        "identity",
        "cpf",
        "cep",
        "address",
        "education",
        "graduate",
        "workspace",
        "deficit",
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class)
            ->withPivot(
                "id",
                "payment",
                "discover",
                "google",
                "price",
                "links",
                "status",
                "motivation",
                "payment_details",
                "sponsor",
                "witness",
            )
            ->withTimestamps();
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
