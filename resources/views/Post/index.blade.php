@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('post.create')}}" class="btn btn-success">Add Post</a>
    </div>

    <div class="card card-default">
        <div class="card-header">Posts</div>

        <div class="card-body">
            @if ($posts->count() > 0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                </thead>

                <tbody>
                    <tr>
                        @foreach ($posts as $post)
                            <tr>
                                <td> <img src="{{ asset($post->image)}}"
                                    width="120px" height="60px"
                                    alt="" srcset=""> </td>

                                <td>{{ $post->title}}</td>
                                <td> <a href="{{route('categories.edit', $post->category->id)}}">{{$post->category->name}}</a></td>
                                    @if ($post->trashed())
                                     <td>
                                         {{-- //To prevent hackers --}}
                                        <form action="{{route('restore-posts',$post->id)}}" method="post">
                                            @csrf
                                            @method('PUT')

                                            <button type="submit" class="btn btn-info btn-sm">Restore</button>
                                        </form>
                                    </td>
                                    @else
                                    <td>
                                        <a href="{{route('post.edit', $post->id)}}" class="btn btn-info btn-sm">Edit</a>
                                    </td>
                                    @endif
                                <td>
                                    <form action="{{route('post.destroy', $post->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            @else
            <h3 class="text-center">
                No Post at the Moment
            </h3>
            @endif
        </div>
    </div>
@endsection
