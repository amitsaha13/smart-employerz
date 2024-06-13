<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::guard('recruiter')->user();

            $jobCounts = DB::table('jobs')
            ->where('recruiter_id', $user->id)
            ->select(
                DB::raw('SUM(CASE WHEN status = 1 AND deadline > NOW() THEN 1 ELSE 0 END) as active_count'),
                DB::raw('SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as pending_count'),
                DB::raw('SUM(CASE WHEN deadline < NOW() THEN 1 ELSE 0 END) as expired_count'),
                DB::raw('SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as draft_count')
            )
            ->first();
            return view('recruiter.recruiter-dashboard',compact('user','jobCounts'));
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }
}
