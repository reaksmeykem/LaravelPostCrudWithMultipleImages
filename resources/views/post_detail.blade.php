@extends('app')
@section('main-content')
    <div class="container">
        <div class="my-3">
            <h1>Post Detail</h1>
        </div>
        <div class="mt-4">
            <form action="{{ route('post.edit', $post_detail->id) }}" method="get">
                @csrf
                <div class="card my-2">
                    <div class="card-body">
                        <div>
                            <div class="d-flex justify-content-between">
                                <h3>{{ $post_detail->title }}</h3>
                                <a href="{{ route('post.edit', $post_detail->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            </div>

                            <p>{{ $post_detail->description }}</p>
                            <div class="my-2">
                                @if(count($post_detail->rPhoto) > 0)
                                    @foreach($post_detail->rPhoto as $image)
                                        <img style="margin-right:15px; margin-bottom:15px;" src="{{ asset('uploads/'.$image->photo) }}" width="250px" alt="">
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
