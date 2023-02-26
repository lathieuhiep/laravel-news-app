@extends('admin.layouts.app')
@section('title', 'Add New Post')

@section('content')
    <div class="wrap">
        <h1 class="heading mb-4">{{ __('Add New Post') }}</h1>

        <form class="form-post" action="" method="post">
            @csrf
            <div class="post-body row">
                <div class="post-body__content col-12 col-md-8">
                    <div class="form-group mb-5">
                        <input type="text" id="title" class="form-control" name="post_title"
                               placeholder="{{ __('Add title') }}" autocomplete="off" aria-label="">
                    </div>

                    <div class="form-group mb-5">
                        <textarea id="editor-content" class="form-control" aria-label="" name="content"></textarea>
                    </div>

                    <div class="form-group mb-5">
                        <label for="excerpt" class="mb-3">Excerpt</label>
                        <textarea id="excerpt" class="form-control" aria-label="" name="excerpt"></textarea>
                    </div>
                </div>

                <div class="post-body__sidebar col-12 col-md-4"></div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('admin/assets/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/posts.js') }}"></script>
@endsection
