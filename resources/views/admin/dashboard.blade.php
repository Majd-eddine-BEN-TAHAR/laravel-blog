@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.posts') }}"
                    class="list-group-item list-group-item-action {{ request()->is('admin/posts') ? 'active' : '' }}">Posts</a>
                <a href="{{ route('admin.categories') }}"
                    class="list-group-item list-group-item-action {{ request()->is('admin/categories') ? 'active' : '' }}">Categories</a>
                <a href="{{ route('admin.users') }}"
                    class="list-group-item list-group-item-action {{ request()->is('admin/users') ? 'active' : '' }}">Users</a>
                <a href="{{ route('admin.settings') }}"
                    class="list-group-item list-group-item-action {{ request()->is('admin/settings') ? 'active' : '' }}">Settings</a>
            </div>
        </div>

        <!-- Content Area -->
        <div class="col-md-9">
            @yield('dashboard-content')
        </div>
    </div>
@endsection
