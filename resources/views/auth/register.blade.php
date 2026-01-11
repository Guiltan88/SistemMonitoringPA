<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Monitoring PA</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/pages/auth.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets-admin/images/logo/logo.png') }}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Sign Up</h1>
                    <p class="auth-subtitle mb-5">Create your account to get started.</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" placeholder="Full Name" required autocomplete="name" autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror"
                                   name="password" placeholder="Password" required autocomplete="new-password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl"
                                   name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <select class="form-control form-control-xl @error('role') is-invalid @enderror" name="role" required>
                                <option value="">Select Role</option>
                                <option value="mahasiswa">Mahasiswa (Student)</option>
                                <option value="staff">Staff</option>
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-person-badge"></i>
                            </div>
                            @error('role')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div id="student-fields" style="display: none;">
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" class="form-control form-control-xl @error('student_id') is-invalid @enderror"
                                       name="student_id" value="{{ old('student_id') }}" placeholder="Student ID">
                                <div class="form-control-icon">
                                    <i class="bi bi-card-text"></i>
                                </div>
                                @error('student_id')
                                    <div class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group position-relative has-icon-left mb-4">
                                <select class="form-control form-control-xl @error('department') is-invalid @enderror" name="department" id="department">
                                    <option value="">Select Department</option>
                                    <option value="Teknologi Informasi" {{ old('department') == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                                    <option value="Teknologi Industri" {{ old('department') == 'Teknologi Industri' ? 'selected' : '' }}>Teknologi Industri</option>
                                    <option value="Bisnis dan Komunikasi" {{ old('department') == 'Bisnis dan Komunikasi' ? 'selected' : '' }}>Bisnis dan Komunikasi</option>
                                </select>
                                <div class="form-control-icon">
                                    <i class="bi bi-building"></i>
                                </div>
                                @error('department')
                                    <div class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group position-relative has-icon-left mb-4">
                                <select class="form-control form-control-xl @error('study_program') is-invalid @enderror" name="study_program" id="study_program">
                                    <option value="">Select Study Program</option>
                                </select>
                                <div class="form-control-icon">
                                    <i class="bi bi-book"></i>
                                </div>
                                @error('study_program')
                                    <div class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                    </form>

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Already have an accountaa? <a href="{{ route('login') }}" class="font-bold">Log in</a>.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('select[name="role"]').change(function() {
                if ($(this).val() === 'mahasiswa') {
                    $('#student-fields').show();
                } else {
                    $('#student-fields').hide();
                }
            });

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

            $('#department').change(function() {
                const selectedDepartment = $(this).val();
                const $studyProgramSelect = $('#study_program');
                $studyProgramSelect.empty();
                $studyProgramSelect.append('<option value="">Select Study Program</option>');

                if (selectedDepartment && studyPrograms[selectedDepartment]) {
                    studyPrograms[selectedDepartment].forEach(function(program) {
                        $studyProgramSelect.append('<option value="' + program + '">' + program + '</option>');
                    });
                }
            });

            // Trigger change on page load if department is pre-selected
            $('#department').trigger('change');
        });
    </script>
</body>

</html>
