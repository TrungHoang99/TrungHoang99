@extends('adminstrator.dashboard')

@section('content')

    <!-- Header:breadcrumb -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                                <li class="breadcrumb-item"><a href="#">Post</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Update post</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{route('admin.post.create')}}" class="btn btn-sm btn-neutral">Add new</a>
                        <a href="{{route('admin.post.index')}}" class="btn btn-sm btn-neutral">Post table</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End header:breadcrumb -->

<div class="container">
    <div class="row justify-content-center mt--5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="display-3 mb-0">Update post</h3>
                </div>

                <div class="card-body">
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
                    <form method="post" action="{{route('admin.post.update', [$post->id])}}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                        <input type="hidden" name="id" value="{{$post->id}}" />
                    
                        <div class="form-group my-2">
                            <label for="title" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>The title</h5></label>
                            <input type="text" class="form-control form-control-alternative" id="" name="title" placeholder="The title of post" value="{{$post->title}}">
                        </div>

                        <div class="form-group my-2">
                            <label for="summary" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>The summary</h5></label>
                            <textarea type="text" class="form-control form-control-alternative" id="" name="summary" rows="5" placeholder="The sumary of content">{{$post->summary}}</textarea>
                        </div>

                        <div class="form-group my-2">
                            <label for="content" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>The body</h5></label>
                            <textarea type="text" class="form-control form-control-alternative" id="texteditor" name="content" rows="7" cols="8" placeholder="The content">{!!$post->content!!}</textarea>
                        </div>
                        
                        <div class="card-body shadow">
                            <div class="form-group m-2">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('storage/posts/'. $post->image) }}" class="rounded" id="picturePreview" title="" alt="Card image cap" width=100%  style="background-position: center; background-size: cover; height: auto;"/>
                                </div>
                                <input type="file" id="pictureInput" class="form-control-file form-control-alternative btn btn-primary mt-1" name="image" onchange="showPreview(event);" value="{{ old('image') }}">
                            </div>
                        </div>

                        <div class="form-group m-2">
                            <label for="tag" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>Tag</h5></label>
                            <input type="text" class="form-control" id="" name="tag" placeholder="Tag..." value="{{$post->tag}}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <label for="title" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>Category</h5></label>
                                    <select class="form-control form-control-alternative" id="" name="category_id">
                                        @foreach ($category as $cate)
                                            @if ($cate->category_status == 0)
                                                <option value=""></option>
                                            @else
                                                <option {{$post->category_id==$cate->id ? 'selected' : '' }} value="{{$cate->id}}">{{$cate->title}}</option>
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
                        <div class="form-group my-3">
                            <label for="source" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>Source link</h5></label>
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <input type="text" class="form-control form-control-alternative" id="" name="source_title" placeholder="Source's title" value="{{ $post->source_title }}">
                                </div>
                                <div class="col-md-8 col-12">
                                    <input type="text" class="form-control form-control-alternative" id="" name="source_title_link" placeholder="Source's link" value="{{ $post->source_link }}">
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group m-2">
                            <label for="exampleFormControlInput1">Category</label>
                            <select class="form-control" id="" name="category_id">
                                @foreach ($category as $cate)
                                    @if ($cate->category_status == 0)
                                        <option value=""></option>
                                    @else
                                        <option {{$post->category_id==$cate->id ? 'selected' : '' }} value="{{$cate->id}}">{{$cate->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div> -->
                        <!-- <div class="form-group m-2">
                            <label for="exampleFormControlInput1">Post status</label>
                            <select class="form-control" id="" name="post_status">
                                @if($post->post_status==1)
                                    <option selected value="1">Activate</option>
                                    <option value="0">Not activate</option>
                                @else
                                    <option value="1">Activate</option>
                                    <option selected value="0">Not activate</option>
                                @endif
                            </select>
                        </div> -->
                        <div class="d-flex justify-content-center my-3">
                            <button type="submit" class="btn btn-primary m-3">Save change </button>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
