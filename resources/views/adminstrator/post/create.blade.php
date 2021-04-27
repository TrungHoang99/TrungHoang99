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
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Create new post</h3>
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
                        <div class="form-group m-2">
                            <input type="text" class="form-control" id="" name="title" value="{{ old('title') }}" placeholder="The title of post">
                        </div>
                        <div class="form-group m-2">
                            <textarea type="text" class="form-control" id="" name="summary" rows="3" placeholder="The sumary of content"></textarea>
                        </div>
                        <div class="form-group m-2">
                            <textarea type="text" class="form-control" id="ckeditor_content" name="content" rows="5" cols="8" placeholder="The content"></textarea>
                        </div>
                        
                        <div class="card-body show">
                            <div class="form-group m-2">
                                <img src="{{asset('assets/img/no-default.png')}}" class="img-thumbnail w-50 h-auto" id="picturePreview" title=""/>
                                <input type="file" id="pictureInput" class="form-control-file btn btn-primary mt-1" name="image" onchange="showPreview(event);">
                            </div>
                        </div>

                        <div class="form-group m-2">
                            <input type="text" class="form-control" id="" name="tag" placeholder="Tag...">
                        </div>

                        <div class="form-group m-2">
                            <label for="exampleFormControlInput1">Category</label>
                            <select class="form-control" id="" name="category_id">
                                @foreach ($category as $cate)
                                    @if ($cate->category_status == 0)
                                        <option value=""></option>
                                    @else
                                        <option value="{{$cate->id}}">{{$cate->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group m-2">
                            <label for="exampleFormControlInput1">Post status</label>
                            <select class="form-control" id="" name="post_status">
                                <option value="1">Activate</option>
                                <option value="0">Not activate</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary m-3">Create new post</button>
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