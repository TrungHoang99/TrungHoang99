@extends('layouts.frontend.app')

@section('title','Update my post')

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
                    <a class="nav-link mb-sm-3 mb-md-0" href="{{ route('user.comment.index') }}"><i class="ni ni-folder-17 mr-2"></i>Comments</a>
                </li>
              </ul>
            </div>
          </div>
        </div> 

        <div class="col-md-12 col-sm-12 mt-4 mb-2">
            <form method="post" action="{{route('user.post.update', [$post->id])}}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" name="id" value="{{$post->id}}" />
                <div class="row">
                    <div class="col-md-8 col-12">
                        <div class="card shadow px-3 py-3">
                            <div class="card-body">
                                <!-- <h3 class="mb-0 mt-1">Title: <span class="text-primary">{{$post->title}}</span></h3> -->
                                <div class="d-flex justify-content-between mb-0">
                                <h3 class="mb-0 mt-1">Edit your post: <small class="text-primary">{{$post->title}}</small></h3>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small>Posted on {{$post->created_at}}</small>
                                    <small>Updated on {{$post->updated_at}}</small>
                                </div>
                                <hr class="my-2">
                                <!-- notification -->
                                @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Notification!</strong>     
                                            {{ Session::get('success') }}
                                            @php
                                                Session::forget('success');
                                            @endphp
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <strong>Warning!!!</strong> 
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <!-- End-notification -->
                            </div>

                            <div class="form-group my-2">
                                <label for="title" class="mb-0"><h6 class="text-default"><i class="ni ni-fat-delete mr-2"></i>The title</h6></label>
                                <input type="text" class="form-control form-control-alternative" id="" name="title" placeholder="The title of post" value="{{$post->title}}">
                            </div>
                            <div class="form-group my-2">
                                <label for="summary" class="mb-0"><h6 class="text-default"><i class="ni ni-fat-delete mr-2"></i>The summary</h6></label>
                                <textarea type="text" class="form-control form-control-alternative" id="" name="summary" rows="5" placeholder="The sumary of content">{{$post->summary}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <!-- Category Widget -->
                        <div class="card shadow">
                            <div class="card-body pt-3 pl-3 pr-3">
                            <h5 class="h5 info-title text-primary">Category</h5>
                            <div class="dropdown-divider mt-2"></div>
                            <div class="row pt-0">
                                <div class="col-12 px-3 py-1">
                                <select class="form-control form-control-alternative" id="" name="category_id">
                                    @foreach ($categories as $category)
                                        @if ($category->category_status !== 0)
                                            <option {{$post->category_id==$category->id ? 'selected' : '' }} value="{{$category->id}}">{{$category->title}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- Tag Widget -->
                        <div class="card shadow my-2">
                            <div class="card-body pt-3 pl-3 pr-3">
                            <h5 class="h5 info-title text-primary">Tag<i class="ni ni-tag ml-2"></i></h5>
                            <div class="dropdown-divider mt-2"></div>
                            <div class="row pt-0">
                                <div class="col-12 px-3 py-1">
                                    <textarea type="text" class="form-control form-control-alternative" id="" name="tag" rows="2" placeholder="Post's tag" value="{{$post->tag}}">{{$post->tag}}</textarea>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- Status Widget -->
                        <div class="card shadow my-2">
                            <div class="card-body pt-3 pl-3 pr-3">
                            <h5 class="h5 info-title text-primary">Status<i class="fas fa-thermometer-three-quarters ml-2"></i></h5>
                            <div class="dropdown-divider mt-2"></div>
                            <div class="row pt-0">
                                <div class="col-12 px-3 py-1">
                                    <select class="form-control form-control-alternative" id="" name="post_status">
                                        @if($post->post_status==1)
                                            <option selected value="1">Activate</option>
                                            <option value="0">Not activate</option>
                                        @else
                                            <option value="1">Activate</option>
                                            <option selected value="0">Not activate</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="form-group m-2">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('storage/posts/'. $post->image) }}" class="rounded" id="picturePreview" title="" alt="Card image cap" width=100%  style="background-position: center; background-size: cover; height: auto;"/>
                                    </div>
                                    <input type="file" id="pictureInput" class="form-control-file form-control-alternative btn btn-primary mt-1" name="image" onchange="showPreview(event);" value="{{ old('image') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="form-group my-2">
                                    <label for="content" class="mb-0"><h6 class="text-default"><i class="ni ni-fat-delete mr-2"></i>The body</h6></label>
                                    <textarea type="text" class="form-control form-control-alternative" id="texteditor" name="content" rows="7" cols="8" placeholder="The content">{!!$post->content!!}</textarea>
                                </div>
                                <div class="form-group my-2">
                                    <label for="source" class="mb-0"><h6 class="text-default"><i class="ni ni-fat-delete mr-2"></i>Source link</h6></label>
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <input type="text" class="form-control form-control-alternative" id="" name="source_title" placeholder="Source's title" value="{{ $post->source_title }}">
                                        </div>
                                        <div class="col-md-8 col-12">
                                            <input type="text" class="form-control form-control-alternative" id="" name="source_link" placeholder="Source's link" value="{{ $post->source_link }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center my-3">
                                    <button type="submit" class="btn btn-primary m-3">Save change </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

      </div>
    </div>
</div>
<!-- End content-->

<!-- <div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card shadow py-3 px-3">
                <div class="card-body">
                    <h3 class="display-3 text-primary text-center mb-0">Edit your post</h3>
                    <h6 class="text-center text-muted">{{ $post->title }}</h6>
                    <hr class="my-3">

                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Notification!</strong>     
                                {{ Session::get('success') }}
                                @php
                                    Session::forget('success');
                                @endphp
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Warning!!!</strong> 
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="post" action="{{route('user.post.update', [$post->id])}}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                        <input type="hidden" name="id" value="{{$post->id}}" />
                        <div class="form-group my-2">
                            <label for="title" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>The title</h5></label>
                            <input type="text" class="form-control form-control-alternative" id="" name="title" placeholder="The title of post" value="{{$post->title}}">
                        </div>
                        <div class="form-group my-2">
                            <label for="summary" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>The summary</h5></label>
                            <textarea type="text" class="form-control form-control-alternative" id="" name="summary" rows="3" placeholder="The sumary of content">{{$post->summary}}</textarea>
                        </div>
                        <div class="form-group my-2">
                            <label for="content" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>The body</h5></label>
                            <textarea type="text" class="form-control form-control-alternative" id="texteditor" name="content" rows="5" cols="8" placeholder="The content">{!!$post->content!!}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group m-2">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('storage/posts/'. $post->image) }}" class="rounded" id="picturePreview" title="" alt="Card image cap" width=70%  style="background-position: center; background-size: cover; height: auto"/>
                                    </div>
                                    <input type="file" id="pictureInput" class="form-control-file form-control-alternative btn btn-primary mt-1" name="image" onchange="showPreview(event);" value="{{ old('image') }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group m-2">
                                    <label for="tag" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>Tag</h5></label>
                                    <textarea type="text" class="form-control form-control-alternative" id="" name="tag" rows="5" placeholder="Post's tag" value="{{$post->tag}}">{{$post->tag}}</textarea>
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <label for="title" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>Category</h5></label>
                                    <select class="form-control form-control-alternative" id="" name="category_id">
                                        @foreach ($categories as $category)
                                            @if ($category->category_status !== 0)
                                                <option {{$post->category_id==$category->id ? 'selected' : '' }} value="{{$category->id}}">{{$category->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <label for="post_status" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>Status</h5></label>
                                    <select class="form-control form-control-alternative" id="" name="post_status">
                                        @if($post->post_status==1)
                                            <option selected value="1">Activate</option>
                                            <option value="0">Not activate</option>
                                        @else
                                            <option value="1">Activate</option>
                                            <option selected value="0">Not activate</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary m-3">Save change </button>
                        </div>
                        </form>
                    
                </div>
            </div>
        </div>
    </div>
</div> -->

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
