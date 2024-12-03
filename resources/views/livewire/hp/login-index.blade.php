<div>
    <form action="" wire:submit="login">
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="form-group">
            <input class="form-control" type="email" id="email" placeholder="Masukan Email" wire:model="email">
            @error('email')
                <span class="text-danger" style="font-size:12px; margin-left:15px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group position-relative">
            <input class="form-control" id="psw-input" type="password" placeholder="Masukan Password"
                wire:model="password">
            <div class="position-absolute" id="password-visibility">
                <i class="bi bi-eye"></i>
                <i class="bi bi-eye-slash"></i>
            </div>
            @error('password')
                <span class="text-danger" style="font-size:12px; margin-left:15px;">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary w-100" type="submit">Login</button>
    </form>
</div>
