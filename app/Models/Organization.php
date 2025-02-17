<?php

namespace App\Models;

use App\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',                 
    ];


    public function users(){
        return $this->belongsToMany(User::class, 'organization_user', 'organization_id', 'user_id');
    }

    public function companies(){
        return $this->hasMany(Company::class);
    }
}
