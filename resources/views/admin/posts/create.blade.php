@extends('admin.layouts.app')
@section('title', 'Add New Post')

@section('content')
    <div class="wrap">
        <h1 class="heading mb-4">{{ __('Add New Post') }}</h1>

        @include( 'admin.posts.form', [ 'action' => Config::get('constants.ACTION_CREATE'), 'route' => route('admin.post.store') ] );
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/assets/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/posts.js') }}"></script>
@endsection
