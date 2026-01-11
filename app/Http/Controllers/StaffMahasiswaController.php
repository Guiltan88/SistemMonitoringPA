<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class StaffMahasiswaController extends Controller
{
    /**
     * Display a listing of mahasiswa.
     */
    public function index()
    {
        $mahasiswa = User::role('mahasiswa')->get();
        return view('staff.mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Display the specified mahasiswa.
     */
    public function show(string $id)
    {
        $mahasiswa = User::role('mahasiswa')->findOrFail($id);
        $projects = Project::where('mahasiswa_name', $mahasiswa->name)->get();
        return view('staff.mahasiswa.show', compact('mahasiswa', 'projects'));
    }

    /**
     * Approve a project.
     */
    public function approveProject(string $id)
    {
        $project = Project::findOrFail($id);
        $project->status = 'approved';
        $project->save();

        return redirect()->back()->with('success', 'Project approved successfully.');
    }

    /**
     * Reject a project.
     */
    public function rejectProject(string $id)
    {
        $project = Project::findOrFail($id);
        $project->status = 'rejected';
        $project->save();

        return redirect()->back()->with('success', 'Project rejected successfully.');
    }
}
