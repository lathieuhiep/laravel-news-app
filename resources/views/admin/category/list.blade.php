@extends('admin.layouts.app')
@section('title', 'Categories')

@section('content')
    <h1 class="heading mt-4">Categories</h1>

    <div class="table-warp table-users">
        <table class="table">
            <thead class="table-light">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Slug</th>
                <th scope="col">Count</th>
            </tr>
            </thead>

            <tbody>
            @foreach($categories as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ count( $item->categoryPost ) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $categories->links() }}
    </div>
@endsection