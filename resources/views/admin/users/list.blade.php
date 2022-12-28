@extends('admin.layouts.app')
@section('title', 'Users')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>

        <div class="table-warp table-users">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getUserRole() }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>

            {{ $users->links() }}
        </div>
    </div>
@endsection