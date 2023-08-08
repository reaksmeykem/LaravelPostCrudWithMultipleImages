@extends('app')
@section('main-content')
    <div class="container">
        <div class="my-3">
            <h1>Edit Post</h1>
        </div>
        <div class="mt-4">
            <form action="{{ route('post.update', $post_detail->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card my-2">
                    <div class="card-body">
                            <div class="d-flex flex-wrap my-3">
                                @if(count($post_detail->rPhoto) > 0)
                                    @foreach($post_detail->rPhoto as $image)
                                        <div class="px-2">
                                            <div class="d-flex justify-content-end">
                                                <a style="margin-right:15px;margin-bottom:7px;" href="{{ route('post.delete.image', $image->id) }}" class="text-danger deleteIcon">Delete</a>
                                            </div>
                                            <div>
                                                <img style="margin-right:15px;margin-bottom:15px;" src="{{ asset('uploads/'.$image->photo) }}" width="250px" alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" placeholder="Enter Title" class="form-control" value="{{ $post_detail->title }}" name="title" >
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-2 ">
                                <textarea class="form-control" name="description" placeholder="Enter description" cols="30" rows="5">{{ $post_detail->description }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Photos (Multi Photo)</label><br>
                                <input type="file" name="photo[]"  class="form-control input-file-now-custom-3" multiple>
                                @if($errors->has('photo.*'))
                                    @foreach($errors->get('photo.*') as $key => $error)
                                        <span class="text-danger">{{ $errors->first($key) }}</span>
                                    @endforeach
                                @endif
                            </div>

                            <div class="my-3">
                                {{-- <a class="btn btn-primary" href="{{ route('post.update', $post_detail->id) }}"><i class="fa-solid fa-pen-to-square"></i> Update</a> --}}
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                            </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
