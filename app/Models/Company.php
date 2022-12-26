<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Media;
use App\Models\Sector;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'staff_companies');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function socialMedia()
    {
        return $this->belongsTo(SocialMedia::class);
    }

    public function photo()
    {
        return $this->belongsTo(Media::class, 'foto_id');
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'sector_companies');
    }
}
