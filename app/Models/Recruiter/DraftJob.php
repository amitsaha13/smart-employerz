<?php

namespace App\Models\Recruiter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftJob extends Model
{
    use HasFactory;

    protected $table = 'draft_jobs';
}
