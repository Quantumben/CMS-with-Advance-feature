@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($post) ? 'Edit Post': 'Create Post'}}
        </div>

        <div class="card-body">
{{-- Code refactoring --}}
@include('partials.errors')

            <form action="{{ isset($post) ? route('post.update', $post->id) : route('post.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                @if (isset($post))

                    @method('PUT')

                    @endif

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                    value=" {{ isset($post) ? $post->title: ''}}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text"cols="5" rows="5" name="description" id="description" class="form-control">
                        {{ isset($post) ? $post->description : ''}}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    {{-- <textarea type="text"cols="5" rows="5" name="content" id="content" class="form-control">
                    </textarea> --}}
                    {{-- trix editor starts here --}}
                    <input type="hidden" name="content" id="content"
                    value=" {{ isset($post) ? $post->content: ''}}">
                    <trix-editor input="content"></trix-editor>
                </div>

                <div class="form-group">
                    <label for="published_at">Publised At</label>
                    <input type="text" name="published_at" id="published_at"  class="form-control"
                    value=" {{ isset($post) ? $post->published_at: ''}}">
                </div>

                @if (isset($post))
                    <div class="form-group">
                        <img src="{{ isset($post) ? $post->image: ''}}" alt="" style="100%">
                    </div>
                @endif

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" value="" class="form-control">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}"
                               @if (isset($post))
                                        @if ($category->id == $post->category_id)
                                        selected
                                        @endif
                               @endif>

                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if ($tags->count() > 0)
                <div class="form-group">
                    <label for="tags">Tags</label>

                        <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}"
                                   @if (isset($post))
                                        @if ($post->hasTag($tag->id))
                                            selected
                                        @endif
                                   @endif
                                   >

                                    {{$tag->name}}

                                </option>
                            @endforeach
                        </select>

                </div>
                  @endif

                <div class="form-group">
                    <button type="submit" class="btn btn-success mt-3">
                        {{ isset($post) ? 'Update Post': 'Create Post'}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
{{-- //trix editor --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
{{-- flatpickr --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
{{-- select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        flatpickr('#published_at',{
            enableTime: true,
            enableSeconds: true
    })

    $(document).ready(function() {
    $('.tags-selector').select2();
});
    </script>

@endsection

@section('css')
{{-- css editor --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
 {{-- flatpickr --}}
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
 {{-- Select2 --}}
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 @endsection
