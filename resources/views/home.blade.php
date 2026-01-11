@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="page-heading">
    <h3>Profile Statistics</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Assigned Projects</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totalProjects }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Running Projects</h6>
                                    <h6 class="font-extrabold mb-0">{{ $runningProjects }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Completed Projects</h6>
                                    <h6 class="font-extrabold mb-0">{{ $completedProjects }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pending Projects</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totalProjects - $runningProjects - $completedProjects }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>My Assigned Projects</h4>
                        </div>
                        <div class="card-body">
                            @if($totalProjects > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Mahasiswa Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(auth()->user()->staff ? auth()->user()->staff->projects : [] as $project)
                                                <tr>
                                                    <td>{{ $project->title }}</td>
                                                    <td>{{ $project->mahasiswa_name }}</td>
                                                    <td>{{ Str::limit($project->description, 50) }}</td>
                                                    <td>
                                                        <span class="badge
                                                            @if($project->status == 'pending') bg-warning
                                                            @elseif($project->status == 'in_progress') bg-primary
                                                            @elseif($project->status == 'completed') bg-success
                                                            @else bg-danger
                                                            @endif">
                                                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $project->start_date ? $project->start_date->format('d/m/Y') : '-' }}</td>
                                                    <td>{{ $project->end_date ? $project->end_date->format('d/m/Y') : '-' }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-sm btn-info">View</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>No projects assigned yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('assets-admin/images/faces/1.jpg') }}" alt="Profile Picture">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ auth()->user()->name }}</h5>
                            <h6 class="text-muted mb-0">@{{ auth()->user()->email }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    // Simple Datatable
    @if($totalProjects > 0)
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
    @endif
</script>
@endsection
