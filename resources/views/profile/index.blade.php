{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Profile</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" required>
                            </div>

                            <div class="mb-3">
                                <div class="form-check" style="cursor: not-allowed">
                                    <input class="form-check-input" type="checkbox" id="isAdminCheckbox" disabled
                                        {{ $user->is_admin ? 'checked' : '' }}>
                                    <label class="form-check-label" for="isAdminCheckbox" style="cursor: not-allowed">
                                        Admin User
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}


@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Profile</h1>
        <div class="card">
            <div class="card-header">Edit Profile</div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- Avatar Display and Upload -->
                    <div class="mb-3">
                        @if ($user->avatar)
                            <img id="avatarImage" src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Avatar"
                                class="img-thumbnail" style="width: 100px; height: 100px;">
                        @else
                            <div class="default-avatar bg-primary text-white rounded-circle"
                                style="width: 100px; height: 100px; line-height: 100px; text-align: center; font-size: 40px;">
                                {{ strtoupper($user->name[0]) }}
                            </div>
                        @endif
                        <div class="mt-2">
                            <label for="avatar" class="form-label">Change Avatar</label>
                            <input type="file" class="form-control" id="avatarInput" name="avatar"
                                onchange="previewAvatar()">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <div class="form-check" style="cursor: not-allowed">
                            <input class="form-check-input" type="checkbox" id="isAdminCheckbox" disabled
                                {{ $user->is_admin ? 'checked' : '' }}>
                            <label class="form-check-label" for="isAdminCheckbox" style="cursor: not-allowed">
                                Admin User
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewAvatar() {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarImage').src = e.target.result;
            }
            reader.readAsDataURL(document.getElementById('avatarInput').files[0]);
        }
    </script>
@endsection
