@extends('admin.layouts.app')
@section('title', 'Add New Post')

@section('content')
    <div class="wrap">
        <h1 class="heading mb-4">{{ __('Add New Post') }}</h1>

        <form class="form-post" action="" method="post">
            @csrf
            <div class="post-body row">
                <div class="post-body__content col-12 col-md-8">
                    <div class="form-group">
                        <input type="text" id="title" class="form-control" name="post_title"
                               placeholder="{{ __('Add title') }}" autocomplete="off" aria-label="">
                    </div>
                </div>

                <div class="post-body__sidebar col-12 col-md-4"></div>
            </div>
        </form>
    </div>
@endsection