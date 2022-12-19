<?php

namespace App\Models;

use App\Models\User;
use App\Models\Media;
use App\Models\Address;
use App\Models\Education;
use App\Models\SocialMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function photo()
    {
        return $this->belongsTo(Media::class, 'foto_id');
    }

    public function education()
    {
        return $this->belongsTo(Education::class);
    }

    public function socialMedia()
    {
        return $this->belongsTo(SocialMedia::class);
    }
}
