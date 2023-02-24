@extends('admin.layouts.app')
@section('title', 'Posts')

@section('content')
    <div class="top-warp d-flex align-items-center pt-3 pb-3">
        <h1 class="heading m-0 me-3">
            {{ __('Posts') }}
        </h1>

        <a class="btn border" href="{{ route('admin.post.create') }}">{{ __('Add New') }}</a>
    </div>

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
@endsection