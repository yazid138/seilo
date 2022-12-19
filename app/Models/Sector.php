<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sector extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
