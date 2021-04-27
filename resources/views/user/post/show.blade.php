@extends('user.dashboard')

@section('title','Detail post')

@section('content')

<!-- Content -->
<div class="wrapper">
    <div class="container ">
      <div class="row  mt-5">
        <!-- <div class="col-md-12 d-flex justify-content-start">
            <a href="{{route('admin.post.pending')}}" class="btn btn-danger p-1 mb-2"><i class="ni ni-bold-left"></i>BACK</a>       
        </div> -->

        <div class="col-xl-8 col-lg-8 mb-1">
          <div class="col-12 card shadow">
            <div class="nav-wrapper">
              <ul class="nav nav-pills nav-fill flex-column flex-md-row justify-content-start" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 " href="{{ route('home') }}" ><i class="ni ni-basket mr-2"></i>Timeline</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" href="{{ route('user.personal.profile') }}"><i class="ni ni-single-02 mr-2"></i>Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" href="{{ route('user.post.index') }}"><i class="ni ni-folder-17 mr-2"></i>Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" href="{{ route('user.comment.index') }}"><i class="ni ni-folder-17 mr-2"></i>Comments</a>
                </li>
              </ul>
            </div>
          </div>
        </div> 

        <div class="col-md-12 col-sm-12 mt-4">
          <div class="row">
            <div class="col-8">
              <div class="card shadow px-3 py-3">
                  <div class="card-body">
                    <!-- <h3 class="mb-0 mt-1">Title: <span class="text-primary">{{$post->title}}</span></h3> -->
                    <div class="d-flex justify-content-between mb-0">
                      <h3 class="mb-0 mt-1">Title: <span class="text-primary">{{$post->title}}</span></h3>
                                                  <div class="dropdown mr-0">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                      <div class="d-flex">
                                                        <a href="{{route('user.post.edit',  $post->id)}}" class="dropdown-item"><span class="btn btn-outline-warning btn-sm">Edit</span></a>
                                                        <a class="dropdown-item" href="#">
                                                          <form action="{{route('user.post.destroy',  $post->id)}}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <input onClick="return confirm('Do you want to delete? You sure?')" type="submit" class="btn btn-outline-danger btn-sm" value="Delete">
                                                          </form>
                                                        </a>
                                                      </div>
                                                    </div>
                                                  </div>
                    </div>
                    <small>Post on {{$post->created_at}}</small>
                      
                    <!-- <div class="dropdown-divider mt-3"></div> -->
                    <hr class="my-2">
                  </div>
                  <img class="img-fluid rounded mb-4" src="{{ asset('storage/posts/'. $post->image) }}" alt="" width=100%  style="background-position: center; background-size: cover; height: auto;">
                  <p class="summary">{{$post->summary}}</p>
                  <dd class="text-default">{{$post->content}}</dd>
              </div>

            </div>

            <div class="col-4">
              <!-- Category Widget -->
              <div class="card shadow">
                <div class="card-body pt-3 pl-3 pr-3">
                  <h5 class="h5 info-title text-primary">Category</h5>
                  <div class="dropdown-divider mt-3"></div>
                  <div class="row pt-1">
                    <div class="col-12 pl-4 pt-2 pb-2">
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
              <div class="card shadow my-4">
                <div class="card-body pt-3 pl-3 pr-3">
                  <h5 class="h5 info-title text-primary">Tag</h5>
                  <div class="dropdown-divider mt-3"></div>
                  <div class="row pt-1">
                    <div class="col-12 pl-4 pt-2 pb-2">
                      <ul class="list-unstyled mb-0">
                        <li>
                          <i class="ni ni-tag mr-2"></i><span class="badge badge-warning">{{$post->tag}}</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Source Widget -->
              <div class="card shadow my-4">
                <div class="card-body pt-3 pl-3 pr-3">
                  <h5 class="h5 info-title text-primary">Source link</h5>
                  <div class="dropdown-divider mt-3"></div>
                  <div class="row pt-1">
                    <div class="col-12 pl-4 pt-2 pb-2">
                      <ul class="list-unstyled mb-0">
                        <li>
                          <i class="fas fa-link mr-2"></i><small class="link">link</small>
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