@extends('layouts.app')

@section('content')
<div class="page-heading">
    <h3>Mahasiswa Details</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $user->name }}</h4>
                    <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($mahasiswa->profile_picture)
                                <img src="{{ asset('storage/' . $mahasiswa->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded">
                            @else
                                <div class="bg-light p-5 text-center rounded">
                                    <i class="bi bi-person-circle" style="font-size: 5rem;"></i>
                                    <p>No Profile Picture</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $mahasiswa->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $mahasiswa->email }}</td>
                                </tr>
                                <tr>
                                    <th>Student ID:</th>
                                    <td>{{ $mahasiswa->student_id }}</td>
                                </tr>
                                <tr>
                                    <th>Department:</th>
                                    <td>{{ $mahasiswa->department }}</td>
                                </tr>
                                <tr>
                                    <th>Study Program:</th>
                                    <td>{{ $mahasiswa->study_program }}</td>
                                </tr>
                                <tr>
                                    <th>Email Verified:</th>
                                    <td>{{ $mahasiswa->email_verified_at ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $mahasiswa->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                            <a href="{{ route('admin.mahasiswa.edit', $mahasiswa) }}" class="btn btn-warning">Edit Mahasiswa</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
