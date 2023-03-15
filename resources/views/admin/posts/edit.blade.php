@extends('admin.layouts.app')
@section('title', 'Edit Post')

@section('content')
    <div class="wrap">
        <div class="wrap__top d-flex align-items-center mb-4">
            <h1 class="heading mb-0 me-3">{{ __('Edit Post') }}</h1>

            <a class="btn btn-primary" href="{{ route('admin.post.create') }}">{{ __('Add New Post') }}</a>
        </div>

        @include( 'admin.posts.form', [ 'action' => Config::get('constants.ACTION_EDIT'), 'route' => route('admin.post.update', $post->id) ] )
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/assets/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/posts.js') }}"></script>
@endsection
