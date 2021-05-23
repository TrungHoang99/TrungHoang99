@extends('layouts.frontend.app')

@section('title','Search')

@section('content')


<div class="wrapper">
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <h2 class="display-3 mt-4 mb-3">Search 
        <small>Result of search</small>
        </h1>

        <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Search</a></li>
            <li class="breadcrumb-item active" aria-current="page">Keyword search: {{ $query }}</li>
        </ol>
        </nav>

        <div class="card shadow my-2 py-3 px-3">
            <div class="card-body">
                <p>There are <strong class="text-danger">{{ $posts->count() }}</strong> 
                    @if( $posts->count() >= 2 )
                    results for the keyword: <strong class="text-primary">{{ $query }}</strong>
                    @else
                    result for the keyword: <strong class="text-primary">{{ $query }}</strong>
                    @endif
                </p>
            </div>
        </div>

        <div class="card shadow mt-4">
          <div class="card-body pt-3 pl-3 pr-3">
            <h5 class="display-4 info-title text-primary">Display result:</h5>
            <div class="dropdown-divider mt-3"></div>
            <div class="row">
              <div class="col-12 pl-4">
                <!-- Blog Post -->
                    @if($posts->count() > 0 )
                    @foreach($posts as $post)
                    @if($post->is_approve == true)
                    <!-- <div class="card card-lift--hover shadow mb-4">
                    <img class="rounded" src="{{ asset('storage/posts/'. $post->image) }}" alt="{{ $post->title }}" width=100%  style="background-position: center; background-size: cover; min-height:250px; max-height: 340px">
                    <div class="card-body pt-1 pb-1 pl-4 pr-4">
                        <h6 class="mb-0"><a href="#"><small><em>{{ $post->category->title }}</em></small></a></h6>
                        <h5 class="text-primary text-md lh-120 mt-1 mb-2"><a href="#">{{ $post->title }}</a></h5>
                        <p class="card-text opacity-8 text-md text-muted lh-120 mb-0">{{ $post->summary }}</p>
                        <a href="{{ route('post.details', $post->id) }}" class="btn btn-link">Read More &rarr;</a>
                        <div class="dropdown-divider mb-2"></div>
                        <div class="d-flex justify-content-between pb-0">
                        <a href="" class=""><i class="ni ni-single-02"></i>&nbsp;<span>{{ $post->user->name }}</span></a>
                        <p class="text-muted">Posted on {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}} </p>
                        </div>
                    </div>
                    </div> -->
                    <div class="card card-lift--hover shadow mt-3 ">
                        <div class="row p-3">
                            <div class="col-md-6 col-sm-12">
                                <a href="{{ route('post.details', $post->id) }}">
                                    <img class="rounded" src="{{ asset('storage/posts/'. $post->image) }}" alt="" width=100%  
                                    style="background-position: center; min-height: 8rem; max-height: 14rem">
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <p class="mb-0"><a href="#" class="text-sm text-muted">{{$post->category['title']}}</a></p>
                                <h5 class="text-primary lh-110 mb-2"><a href="{{ route('post.details', $post->id) }}">{{$post->title}}</a></h5>
                                <a href="{{ route('user.profile', $post->user['name']) }}" class=""><i class="ni ni-single-02" target="blank_"></i>&nbsp;<span>{{ $post->user->name }}</span></a>
                                <p class="text-sm text-muted mb-0">Posted on {{$post->created_at}}</p>
                                <a href="{{ route('post.details', $post->id) }}" class="btn btn-link"><span>Read more</span> &rarr;</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @else
                    <div class="card shadow my-3 py-3 px-3">
                        <h6 class="info-title text-center text-muted info-title mb-0">Sorry !!! There are no articles related to keyword</h6>
                    </div>
                    @endif
                <!-- EndBlog -->

              </div>
            </div>
          </div>
        </div>

    </div>
</div>  

<!-- <div class="row mt-7">
    <div class="col-md-8">

        @if($posts->count() > 0 )
        @foreach($posts as $post)
        @if($post->is_approve == true)
        <div class="card card-lift--hover shadow mb-4">
        <img class="rounded" src="{{ asset('storage/posts/'. $post->image) }}" alt="{{ $post->title }}" width=100%  style="background-position: center; background-size: cover; min-height:250px; max-height: 340px">
        <div class="card-body pt-1 pb-1 pl-4 pr-4">
            <h6 class="mb-0"><a href="#"><small><em>{{ $post->category->title }}</em></small></a></h6>
            <h5 class="text-primary text-md lh-120 mt-1 mb-2"><a href="#">{{ $post->title }}</a></h5>
            <p class="card-text opacity-8 text-md text-muted lh-120 mb-0">{{ $post->summary }}</p>
            <a href="{{ route('post.details', $post->id) }}" class="btn btn-link">Read More &rarr;</a>
            <div class="dropdown-divider mb-2"></div>
            <div class="d-flex justify-content-between pb-0">
            <a href="" class=""><i class="ni ni-single-02"></i>&nbsp;<span>{{ $post->user->name }}</span></a>
            <p class="text-muted">Posted on {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}} </p>
            </div>
        </div>
        </div>
        @endif
        @endforeach
        @else
        <div class="card shadow py-3 px-3">
        <h6 class="info-title text-center text-muted info-title mb-0">Sorry :((</h6>
        </div>
        @endif

    </div>
</div> -->



@endsection