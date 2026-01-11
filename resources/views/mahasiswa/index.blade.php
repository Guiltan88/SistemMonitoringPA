@extends('layouts.app')

@section('content')
<div class="page-heading">
    <h3>My Projects</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Project List</h4>
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">Submit New Project</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Mahasiswa Name</th>
                                <th>Status</th>
                                <th>Submitted At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                                <tr>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->mahasiswa_name }}</td>
                                    <td>
                                        <span class="badge bg-{{ $project->status == 'approved' ? 'success' : ($project->status == 'rejected' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $project->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('mahasiswa.show', $project) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('mahasiswa.edit', $project) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('mahasiswa.destroy', $project) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No projects found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
