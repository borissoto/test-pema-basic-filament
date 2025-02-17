<?php

namespace App\Models;

use App\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'organization_id',
        'user_id',
    ];

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function client(){
        return $this->belongsTo(User::class, 'user_id')->where('type', UserType::CLIENT);
    }
}
