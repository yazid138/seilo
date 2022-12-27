<?php

namespace App\Models;

use App\Models\Job;
use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hire extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function cv()
    {
        return $this->belongsTo(Media::class, 'cv_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
