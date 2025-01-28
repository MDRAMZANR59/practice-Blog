@extends('backend.app')

@section('Content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Change Your Password</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('storePass') }}" method="POST">
                        @csrf

                        <!-- Old Password -->
                        <div class="mb-3">
                            <label for="oldPassword" class="form-label">Old Password</label>
                            <input type="password"
                                   class="form-control @error('oldPassword') is-invalid @enderror"
                                   id="oldPassword"
                                   name="oldPassword"
                                   placeholder="Enter your old password"
                                   value="{{ old('oldPassword') }}">
                            @error('oldPassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password"
                                   class="form-control @error('newPassword') is-invalid @enderror"
                                   id="newPassword"
                                   name="newPassword"
                                   placeholder="Enter your new password">
                            @error('newPassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Retype New Password -->
                        <div class="mb-3">
                            <label for="newPassword_confirmation" class="form-label">Retype New Password</label>
                            <input type="password"
                                   class="form-control @error('newPassword_confirmation') is-invalid @enderror"
                                   id="newPassword_confirmation"
                                   name="newPassword_confirmation"
                                   placeholder="Retype your new password">
                            @error('newPassword_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
