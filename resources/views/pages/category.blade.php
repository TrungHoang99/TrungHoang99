@extends('layouts.frontend.app')

@section('title','Category')

@section('content')

<div class="wrapper">
    <div class="container">
      <!-- Page Heading/Breadcrumbs -->
    <h2 class="display-3 mt-4 mb-3">Blog's category
      <small>category</small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.html">Home</a>
      </li>
      <li class="breadcrumb-item">Category</li>
      <li class="breadcrumb-item active" aria-current="page">{{$category->title}}</li>
    </ol>

    <div class="row pt-4">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <!-- Blog Post -->
        @if($posts->count() > 0 )
        @foreach($posts as $post)
        @if($post->is_approve == true)
        @if($post->user->id !== 1)
        <div class="card card-lift--hover shadow mb-4">
          <img class="rounded" src="{{ asset('storage/posts/'. $post->image) }}" alt="{{ $post->title }}" width=100%  style="background-position: center; background-size: cover; min-height:250px; max-height: 340px">
          <div class="card-body pt-1 pb-1 pl-4 pr-4">
            <h6 class="mb-0"><small><em class="text-primary">{{ $post->category->title }}</em></small></h6>
            <h5 class="text-primary text-md lh-120 mt-1 mb-2"><a href="{{ route('post.details', $post->id) }}">{{ $post->title }}</a></h5>
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
        @endif
        @endforeach
        @else
        <div class="card shadow py-3 px-3">
          <h6 class="info-title text-center text-muted info-title mb-0">Sorry :(( This category currently has no posts. Be the first. <a href="{{ route('user.post.create') }}"></a></h6>
        </div>
        @endif

        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
          {{$posts->links()}} 
        </ul>
        <!-- End-pagination -->

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Categories Widget -->
        <div class="card shadow">
          <div class="card-body pt-3 pl-3 pr-3">
            <h5 class="h5 info-title text-primary">Categories</h5>
            <div class="dropdown-divider mt-3"></div>
            <div class="row pt-1">
              <div class="col-12 pl-4">
              @foreach($categories as $category)
                @if($category->category_status == 1)
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="{{ route('category.posts', $category->title) }}" class="text-default text-sm text-muted">{{ $category->title }}</a>
                  </li>
                </ul>
                @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card shadow my-4">
          <div class="card-body pt-3 pl-3 pr-3">
            <h5 class="h5 info-title text-primary">New posts</h5>

            <!-- post -->
            @foreach($lastedposts as $lpost)
            <!-- @if($lpost->is_approve == true) -->
            @if($lpost->user->id !== 1)
            <div class="dropdown-divider mt-3 mb-2"></div>
            <div class="description opacity-8">
              <a href="{{ route('post.details', $lpost->id) }}" class="card-lift--hover">
                <img src="{{asset('storage/posts/'. $lpost->image)}}" alt="$lpost->title" class="rounded" width=100%  
                  style="background-position: center; max-height: 160px; min-height: 120px">
              </a>
            </div>
            <div class="ml-2">
              <h6 class="info-title text-primary lh-120 pt-1 mt-1 mb-1"><a href="{{ route('post.details', $lpost->id) }}">{{ $lpost->title }}</a></h6>
              <p class="description opacity-8 text-sm mb-1 lh-100"><small>Posted on {{\Carbon\Carbon::parse($lpost->created_at)->diffForHumans()}}</small></p>
            </div>
            @endif
            <!-- @endif             -->
            @endforeach
            <!-- end-post -->
            <!-- post -->
            <!-- <div class="dropdown-divider mt-3 mb-2"></div>
            <div class="description opacity-8">
              <a href="#" class="card-lift--hover">
                <img src="{{asset('assets/img/tong-hop-anh-bia-facebook-dep-12_101148.jpg')}}" alt="alo" class="rounded" width=100%  
                  style="background-position: center; max-height: 160px; min-height: 120px">
              </a>
            </div>
            <div class="ml-2">
              <h6 class="info-title text-primary lh-120 pt-1 mt-1 mb-1"><a href="#">Title title titletile titleeee titletitletitletitle</a></h6>
              <p class="description opacity-8 text-sm mb-1 lh-100"><small>Post on January,11,2019</small></p>
            </div> -->
            <!-- end-post -->

          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->
    </div>
  </div>

@endsection