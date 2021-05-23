@extends('user.dashboard')

@section('title','My post')

@section('content')

<!-- Content -->
<div class="wrapper">
    <div class="container ">
      <div class="row mt-5">

        <div class="col-xl-8 col-lg-8 mb-1">
          <div class="col-12 card shadow">
            <div class="nav-wrapper">
              <ul class="nav nav-pills nav-fill flex-column flex-md-row justify-content-start" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 " href="{{ route('user.personal.timeline') }}" ><i class="ni ni-basket mr-2"></i>Timeline</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" href="{{ route('user.personal.profile') }}"><i class="ni ni-single-02 mr-2"></i>Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" href="{{ route('user.post.index') }}"><i class="ni ni-folder-17 mr-2"></i>Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" href="{{ route('user.comment.index') }}"><i class="ni ni-chat-round mr-2"></i>Comment</a>
                </li>
              </ul>
            </div>
          </div>
        </div> 

        <div class="col-md-12 col-sm-12 mt-4 mb-2">
          <div class="row">
            <div class="col-md-8 col-12">
              <div class="card shadow px-3 py-3">
                  <div class="card-body">
                    <!-- <h3 class="mb-0 mt-1">Title: <span class="text-primary">{{$post->title}}</span></h3> -->
                    <div class="d-flex justify-content-between mb-0">
                      <h3 class="mb-0 mt-1">Title: <small class="text-primary">{{$post->title}}</small></h3>
                      <div class="dropdown mr-0">
                        <a class="btn btn-icon-only btn-outline-warning px-1 py-1" href="{{route('user.post.edit',  $post->id)}}" role="button">
                          <i class="ni ni-ruler-pencil"></i>
                        </a>
                      </div>
                      
                    </div>
                    <div class="d-flex justify-content-between">
                      <small>Posted on {{$post->created_at}}</small>
                      <small>Updated on {{$post->updated_at}}</small>
                    </div>
                      
                    <!-- <div class="dropdown-divider mt-3"></div> -->
                    <hr class="my-2">
                  </div>
                  <img class="img-fluid rounded mb-4" src="{{ asset('storage/posts/'. $post->image) }}" alt="" width=100%  style="background-position: center; background-size: cover; height: auto;">
                  <p class="summary">{{$post->summary}}</p>
                  <dd class="text-default">{!!$post->content!!}</dd>
              </div>

            </div>

            <div class="col-md-4 col-12">
              <!-- Category Widget -->
              <div class="card shadow">
                <div class="card-body pt-3 pl-3 pr-3">
                  <h5 class="h5 info-title text-primary">Category</h5>
                  <div class="dropdown-divider mt-2"></div>
                  <div class="row pt-0">
                    <div class="col-12 pl-4 py-1">
                      <ul class="list-unstyled mb-0">
                        <li>
                          <a href="{{ route('category.posts', $post->category['title']) }}" class="badge badge-info">{{ $post->category['title'] }}</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Tag Widget -->
              <div class="card shadow my-3">
                <div class="card-body pt-3 pl-3 pr-3">
                  <h5 class="h5 info-title text-primary">Tag</h5>
                  <div class="dropdown-divider mt-2"></div>
                  <div class="row pt-0">
                    <div class="col-12 pl-4 py-1">
                      <ul class="list-unstyled mb-0">
                        <li>
                          <i class="ni ni-tag mr-2"></i><small class="badge badge-warning">{{$post->tag}}</small>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Source Widget -->
              <div class="card shadow my-3">
                <div class="card-body pt-3 pl-3 pr-3">
                  <h5 class="h5 info-title text-primary">Source link</h5>
                  <div class="dropdown-divider mt-2"></div>
                  <div class="row pt-0">
                    <div class="col-12 pl-4 py-1">
                      <ul class="list-unstyled mb-0">
                        <li>
                          <i class="fas fa-link mr-2"></i>{{ $post->source_title }}
                        </li>
                        <li>
                          <small class="link">{{ $post->source_link }}</small>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Comment Widget -->
              <div class="card shadow my-3">
                <div class="card-body pt-3 pl-3 pr-3">
                  <h5 class="h5 info-title text-primary">Comments</h5>
                  <div class="dropdown-divider mt-2"></div>
                  <div class="row pt-0">
                    <div class="col-12 pl-4 py-1">
                      <ul class="list-unstyled mb-0">
                        <li>
                          <i class="ni ni-chat-round mr-2"></i>
                            @if ($post->comments->count() >= 2 )
                              <strong>{{ $post->comments->count() }}</strong><small class="link"> comments</small>
                            @else
                              <strong>{{ $post->comments->count() }}</strong><small class="link"> comment</small>
                            @endif
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
      </div>
    </div>
</div>
<!-- End content-->

<?php 
  echo '<script type="text/JavaScript"> 
    function showPreview(event){
        if(event.target.files.length > 0){
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("picturePreview");
        preview.src = src;
        preview.style.display = "block";
        }
    }
    </script>'
  ;
?>

@endsection