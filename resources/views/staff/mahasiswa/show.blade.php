@extends('layouts.app')

@section('title', 'Mahasiswa Details')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Mahasiswa Details</h3>
                <p class="text-subtitle text-muted">View mahasiswa information and projects</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.staff.mahasiswa.index') }}">Mahasiswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $mahasiswa->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Mahasiswa Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> {{ $mahasiswa->name }}</p>
                                <p><strong>Email:</strong> {{ $mahasiswa->email }}</p>
                                <p><strong>Student ID:</strong> {{ $mahasiswa->student_id }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Department:</strong> {{ $mahasiswa->department }}</p>
                                <p><strong>Study Program:</strong> {{ $mahasiswa->study_program }}</p>
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
                        <h4 class="card-title">Projects</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                    <tr>
                                        <td>{{ $project->title }}</td>
                                        <td>{{ $project->description }}</td>
                                        <td>
                                            <span class="badge bg-{{ $project->status == 'completed' ? 'success' : ($project->status == 'in_progress' ? 'primary' : 'warning') }}">
                                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                            </span>
                                        </td>
                                        <td>{{ $project->start_date ? $project->start_date->format('d/m/Y') : '-' }}</td>
                                        <td>{{ $project->end_date ? $project->end_date->format('d/m/Y') : '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-sm btn-primary">View</a>
                                            @if($project->status == 'pending')
                                                <form action="{{ route('admin.staff.mahasiswa.approve', $project->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                </form>
                                                <form action="{{ route('admin.staff.mahasiswa.reject', $project->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
