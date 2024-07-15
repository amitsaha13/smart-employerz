<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = 'job_applications';
    /**
     * Get the job that owns the job application.
     */
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
