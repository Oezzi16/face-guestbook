<nav class="app-header navbar navbar-expand bg-body">
<!--begin::Container-->
<div class="container-fluid">
    <!--begin::Start Navbar Links-->
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
        <i class="bi bi-list"></i>
        </a>
    </li>
    
    </ul>
    <!--end::Start Navbar Links-->
    <!--begin::End Navbar Links-->
    <ul class="navbar-nav ms-auto">
    
    
    <!--begin::Fullscreen Toggle-->
    <li class="nav-item">
        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
        <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
        <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
        </a>
    </li>
    <!--end::Fullscreen Toggle-->
    <!--begin::User Menu Dropdown-->
    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <img
            src="/_temp/adminlte/dist/assets/img/user2-160x160.jpg"
            class="user-image rounded-circle shadow"
            alt="User Image"
        />
        <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        <!--begin::User Image-->
        <li class="user-header text-bg-primary">
            <img
            src="/_temp/adminlte/dist/assets/img/user2-160x160.jpg"
            class="rounded-circle shadow"
            alt="User Image"
            />
            <p>
            {{ auth()->user()->name }}
            </p>
        </li>
        <!--end::User Image-->
       
        <!--begin::Menu Footer-->
        <li class="user-footer">
            <a href="#" class="btn btn-default btn-flat" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Profile</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-default btn-flat float-end">Sign out</button>
            </form>
        </li>
        <!--end::Menu Footer-->
        </ul>
    </li>
    <!--end::User Menu Dropdown-->
    </ul>
    <!--end::End Navbar Links-->
</div>
<!--end::Container-->
</nav>

<!-- Modal Update Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('profile.update-password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Update Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('password_success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('password_success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('password_error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('password_error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                            id="current_password" name="current_password" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                            id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                            id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk menampilkan modal kembali jika ada error -->
@if($errors->any() || session('password_error') || session('password_success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
        myModal.show();
    });
</script>
@endif