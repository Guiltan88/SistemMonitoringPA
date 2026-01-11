@extends('layouts.app')

@section('content')
<div class="page-heading">
    <h3>Edit Mahasiswa</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Mahasiswa Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.mahasiswa.update', $mahasiswa) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $mahasiswa->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $mahasiswa->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_id">Student ID</label>
                                    <input type="text" class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" value="{{ old('student_id', $mahasiswa->student_id) }}" required>
                                    @error('student_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department', $mahasiswa->department) }}" required>
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="study_program">Study Program</label>
                            <input type="text" class="form-control @error('study_program') is-invalid @enderror" id="study_program" name="study_program" value="{{ old('study_program', $mahasiswa->study_program) }}" required>
                            @error('study_program')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Mahasiswa</button>
                        <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    const studyPrograms = {
        'Teknologi Informasi': [
            'S1 Terapan (D4) Teknik Informatika',
            'S1 Terapan (D4) Sistem Informasi',
            'S1 Terapan (D4) Teknologi Rekayasa Komputer',
            'S2 Terapan (Magister) Teknik Komputer'
        ],
        'Teknologi Industri': [
            'S1 Terapan (D4) Teknik Listrik',
            'S1 Terapan (D4) Teknik Elektronika',
            'S1 Terapan (D4) Teknik Mesin',
            'S1 Terapan (D4) Teknologi Rekayasa Mekatronika',
            'S1 Terapan (D4) Teknologi Rekayasa Sistem Elektronika',
            'S1 Terapan (D4) Teknologi Rekayasa Jaringan Telekomunikasi'
        ],
        'Bisnis dan Komunikasi': [
            'S1 Terapan (D4) Akuntansi Perpajakan',
            'S1 Terapan (D4) Bisnis Digital',
            'S1 Terapan (D4) Hubungan Masyarakat dan Komunikasi Digital',
            'S1 Terapan (D4) Animasi'
        ]
    };

    function populateStudyPrograms(department) {
        const $studyProgramSelect = $('#study_program');
        $studyProgramSelect.empty();
        $studyProgramSelect.append('<option value="">Select Study Program</option>');

        if (department && studyPrograms[department]) {
            studyPrograms[department].forEach(function(program) {
                const selected = program === '{{ old('study_program', $mahasiswa->study_program) }}' ? 'selected' : '';
                $studyProgramSelect.append('<option value="' + program + '" ' + selected + '>' + program + '</option>');
            });
        }
    }

    $('#department').change(function() {
        const selectedDepartment = $(this).val();
        populateStudyPrograms(selectedDepartment);
    });

    // Initialize on page load
    const initialDepartment = $('#department').val();
    if (initialDepartment) {
        populateStudyPrograms(initialDepartment);
    }
});
</script>
@endsection
