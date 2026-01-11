@extends('layouts.app')

@section('content')
<div class="page-heading">
    <h3>Project Details</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $project->title }}</h4>
                    <a href="{{ route('mahasiswa.edit', $project) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Title:</strong> {{ $project->title }}</p>
                            <p><strong>Mahasiswa Name:</strong> {{ $project->mahasiswa_name }}</p>
                            <p><strong>Status:</strong>
                                <span class="badge bg-{{ $project->approval_status == 'approved' ? 'success' : ($project->approval_status == 'rejected' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($project->approval_status) }}
                                </span>
                            </p>
                            <p><strong>Submitted By:</strong> {{ $project->submitted_by }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Start Date:</strong> {{ $project->start_date ? $project->start_date->format('d M Y') : 'Not set' }}</p>
                            <p><strong>End Date:</strong> {{ $project->end_date ? $project->end_date->format('d M Y') : 'Not set' }}</p>
                            <p><strong>Submitted At:</strong> {{ $project->created_at->format('d M Y H:i') }}</p>
                            @if($project->file_path)
                                <p><strong>File:</strong> <a href="{{ asset('storage/' . $project->file_path) }}" target="_blank">{{ basename($project->file_path) }}</a></p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p><strong>Description:</strong></p>
                            <p>{{ $project->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
