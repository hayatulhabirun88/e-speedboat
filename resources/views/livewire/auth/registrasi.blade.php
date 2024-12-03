<div>
    <div class="login-box">
        <div class="login-logo"> <a href="/"><b>E-</b>SpeedBoat</a> </div> <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan Isi Data Anda</p>
                <form wire:submit.prevent = 'login'>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nama" wire:model="nama">
                        <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>

                    </div>
                    @error('email')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" wire:model="email">
                        <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>

                    </div>
                    @error('email')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" wire:model="password">
                        <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>

                    </div> <!--begin::Row-->
                    @error('password')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Konfirmasi Password"
                            wire:model="confirm_password">
                        <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>

                    </div> <!--begin::Row-->
                    @error('confirm_password')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror

                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
                <br>
                <p class="mb-0 text-center">Sudah punya akun? <a href="/" class="text-center">
                        Login
                    </a> </p>
            </div> <!-- /.login-card-body -->
        </div>
    </div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
</div>
