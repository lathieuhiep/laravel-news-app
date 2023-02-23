@extends('admin.layouts.app')
@section('title', 'Posts')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Posts</h1>

        <div class="table-warp table-users">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Categories</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>

                <tbody>
                @foreach($dataPost as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->author->name }}</td>
                        <td>{{ $item->getCategoryName() }}</td>
                        <td>{{ $item->created_at  }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $dataPost->links() }}
        </div>
    </div>
@endsection