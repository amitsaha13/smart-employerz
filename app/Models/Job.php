<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    
    /**
     * Get the recruiter that owns the job.
     */
    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class, 'recruiter_id');
    }
    /**
     * Get the job applications for the job.
     */
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
}
