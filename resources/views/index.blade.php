@extends('app')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin:25px 0;">
                    @if(session()->get('success'))
                        <span class="alert alert-success w-100">{{ session()->get('success') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div>
                    <h1>Creat Post</h1>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('store_post') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="">Title</label><br>
                                <input type="text" placeholder="Enter Title" class="form-control" value="{{ old('title') }}" name="title" >
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-2 ">
                                <label for="">Description</label><br>
                                <textarea class="form-control" name="description" placeholder="Enter description" cols="30" rows="5">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Photos (Multi Photo)</label><br>
                                <input type="file" name="photo[]"  class="form-control input-file-now-custom-3" multiple>
                                @if($errors->has('photo.*'))
                                    @foreach($errors->get('photo.*') as $key => $error)
                                        <span class="text-danger">{{ $errors->first($key) }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group mb-2">
                                {{-- <input type="submit" class="btn btn-primary" value="Create"> --}}
                                <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-plus"></i> Create</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-8">

                <div>
                    <h1>All Posts</h1>
                </div>
                <div>
                    @foreach($posts as $post)
                    <div class="card my-2 mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('view_detail', $post->id) }}">
                                    <h4>{{ $post->title }}</h4>
                                </a>
                                <a href="{{ route('post.delete', $post->id) }}" class="text-danger">Delete</a>
                            </div>
                            <p>{{ $post->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>


    </div>


@endsection
