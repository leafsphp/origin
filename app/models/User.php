<?php

namespace App\Models;

class User extends Model
{
    protected $table = "users";
    protected $fillable = ["username", "fullname", "email", "email_verified", "password", "remember_token", "status", "role", "avatar"];
    protected $hidden = ["password", "remember_token"];
    protected $with = ["role"];
    public $timestamps = true;
    public $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];

    # belongs to user role
    public function role()
    {
        return $this->belongsTo(UserRole::class, "role");
    }
}