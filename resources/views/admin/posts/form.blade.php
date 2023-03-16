<form class="form-post" action="{{ $route }}" method="post" enctype="multipart/form-data">
    @csrf
    @if($action == Config::get('constants.ACTION_EDIT'))
        {{ method_field('PUT') }}
    @endif

    <div class="post-body row">
        <div class="post-body__content col-12 col-md-9">
            <div class="form-group mb-4">
                <input type="text" id="title" class="form-control" value="{{ isset( $post ) ? $post->title : '' }}" name="title"
                       placeholder="{{ __('Add title') }}" autocomplete="off" aria-label="">
            </div>

            <div class="form-group mb-4">
                <textarea id="editor-content" class="form-control" aria-label="" name="content">{!! isset( $post ) ? $post->content : '' !!}</textarea>
            </div>

            <div class="form-group mb-4">
                <div class="card card-post-publish mb-4">
                    <div class="card-header">
                        <label for="excerpt">Excerpt</label>
                    </div>

                    <div class="card-body">
                        <textarea id="excerpt" class="form-control" aria-label="" name="excerpt" rows="5">{{ isset( $post ) ? $post->excerpt : '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="post-body__sidebar col-12 col-md-3">
            <div class="card card-post-publish mb-4">
                <div class="card-header">
                    {{ __('Publish') }}
                </div>

                <div class="card-body">
                    <button type="submit" class="btn btn-primary">{{ __('Publish') }}</button>
                </div>
            </div>

            <div class="card card-post-cate mb-4">
                <div class="card-header">
                    {{ __('Category') }}
                </div>

                <div class="card-body">
                    @if( $categories->isNotEmpty() )
                        <ul class="category-checklist list-group">
                            @foreach( $categories as $category )
                                <li class="list-group-item border-0 pt-0 px-0">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="post_category[]"
                                           value="{{ $category->id }}"
                                           id="in-category-{{ $category->id }}"
                                           {{ isset( $categoryIds ) && in_array($category->id, $categoryIds) ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="in-category-{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="card card-post-image">
                <div class="card-header">
                    {{ __('Featured image') }}
                </div>

                <div class="card-body">
                    @if( isset( $post ) && $post->getFirstMedia() )
                        <img src="{{ $post->getFirstMedia()->getUrl() }}" alt="{{ __('Featured image') }}">
                    @else
                        <button class="btn btn-set-image p-0" type="button">{{ __('Set featured image') }}</button>
                    @endif

                    <input class="form-control" id="post-image" type="file" aria-label="" name="image">
                </div>
            </div>
        </div>
    </div>
</form>
