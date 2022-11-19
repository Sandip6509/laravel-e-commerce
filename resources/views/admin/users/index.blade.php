@extends('admin.layouts')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Users</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
            @include('flash_message')
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-user me-1"></i>
                    Users
                    <a href="{{ route('admin_user_register') }}" class="btn btn-outline-primary btn-sm float-end"><i
                            class="fa fa-user me-1"></i>Add User</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Contact</th>
                                <th>Country</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->role_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->contact }}</td>
                                    <td>{{ $user->countryName->name }}</td>
                                    <td style="max-width: 30px">
                                        <div style="display: flex;">
                                            <a href="{{ route('admin_user_edit', ['id' => $user->id]) }}"
                                                class="text-warning "><i class="fa fa-edit me-2" style="height:1.5em;"></i></a>
                                            <a href="{{ route('admin_user_status', ['id' => $user->id, 'status' => $user->is_active == 1 ? 0 : 1]) }}"
                                                class="text-{{ $user->is_active == 1 ? 'danger' : 'success' }}">
                                                @if ($user->is_active == 1)
                                                    <i class="fa-solid fa-toggle-off me-2" style="height:1.8em;"></i>
                                                @else
                                                    <i class="fa-solid fa-toggle-on me-2" style="height:1.8em;"></i>
                                                @endif
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
