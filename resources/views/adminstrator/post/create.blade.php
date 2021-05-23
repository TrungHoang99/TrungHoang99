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
                                <li class="breadcrumb-item active" aria-current="page">Add new</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
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
                    <h3 class="display-3 mb-0">Create new post</h3>
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
                    <form autocomplete="off" method="post" action="{{route('admin.post.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-3">
                            <label for="title" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>The title</h5></label>
                            <input type="text" class="form-control form-control-alternative" id="" name="title" placeholder="The title of post" value="{{ old('title') }}">
                        </div>
                        <div class="form-group my-3">
                            <label for="summary" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>The summary</h5></label>
                            <textarea type="text" class="form-control form-control-alternative" id="" name="summary" rows="2" cols="3" placeholder="The summary of content">{{ old('summary') }}</textarea>
                        </div>
                        <div class="form-group my-3">
                            <label for="content" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>The body</h5></label>
                            <textarea type="text" class="form-control form-control-alternative" id="texteditor" name="content" rows="5" cols="8" placeholder="The content" value="{{ old('content') }}">{!! old('content') !!}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group m-2">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{asset('assets/img/default.png')}}" class="rounded" id="picturePreview" title="" alt="Card image cap" width=70%  style="background-position: center; background-size: cover; height: auto"/>
                                    </div>
                                    <input type="file" id="pictureInput" class="form-control-file btn btn-primary mt-1" name="image" onchange="showPreview(event);" value="{{ old('image') }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group my-2">
                                    <label for="tag" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>Tag</h5></label>
                                    <textarea type="text" class="form-control form-control-alternative" id="" name="tag" rows="5" placeholder="Post's tag" value="{{ old('tag') }}">{{ old('content') }}</textarea>
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <label for="title" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>Category</h5></label>
                                    <select class="form-control form-control-alternative" id="" name="category_id">
                                        @foreach ($category as $cate)
                                            <option value="{{$cate->id}}">{{$cate->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <label for="post_status" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>Status</h5></label>
                                    <select class="form-control form-control-alternative" id="" name="post_status">
                                        <option value="1">Activate</option>
                                        <option value="0">Not activate</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group my-3">
                            <label for="source" class="mb-0"><h5 class="text-default"><i class="ni ni-fat-delete mr-2"></i>Source link</h5></label>
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <input type="text" class="form-control form-control-alternative" id="" name="source_title" placeholder="Source's title" value="{{old('source_title')}}">
                                </div>
                                <div class="col-md-8 col-12">
                                    <input type="text" class="form-control form-control-alternative" id="" name="source_link" placeholder="Source's link" value="{{old('source_link')}}">
                                </div>
                            </div>
                        </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary m-3">Add new </button>
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