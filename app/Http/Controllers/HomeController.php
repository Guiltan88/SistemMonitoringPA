<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Staff;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('staff')) {
            $staff = $user->staff;
            if ($staff) {
                $assignedProjects = Project::where('assigned_staff_id', $staff->id)->get();
                $totalProjects = $assignedProjects->count();
                $runningProjects = $assignedProjects->where('status', 'in_progress')->count();
                $completedProjects = $assignedProjects->where('status', 'completed')->count();
            } else {
                $totalProjects = 0;
                $runningProjects = 0;
                $completedProjects = 0;
            }
        } else {
            // For mahasiswa or others, show 0 or different stats
            $totalProjects = 0;
            $runningProjects = 0;
            $completedProjects = 0;
        }

        $totalStaff = Staff::count(); // Maybe show total staff, or hide this card

        return view('home', compact('totalProjects', 'runningProjects', 'completedProjects', 'totalStaff'));
    }
}
