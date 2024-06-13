<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Recruiter extends Authenticatable
{
    use HasFactory;

    /**
     * Get the jobs for the recruiter.
     */
    public function jobs()
    {
        return $this->hasMany(Job::class, 'recruiter_id');
    }
}
