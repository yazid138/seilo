<?php

namespace App\Models;

use App\Models\User;
use App\Models\Media;
use App\Models\Sector;
use App\Models\Address;
use App\Models\SocialMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
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
        return $this->belongsToMany(Sector::class);
    }
}
