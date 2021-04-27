@extends('layouts.frontend.app')

@section('title','Add new post')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card shadow py-3 px-3">
                <div class="card-body">
                    <h3 class="text-primary mb-0">Add new post</h3>
                    <hr class="my-2">

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

                    <form autocomplete="on" method="post" action="{{ route('user.post.store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group m-2">
                            <label for="title">Post's title</label>
                            <input type="text" class="form-control form-control-alternative" id="" name="title" placeholder="The title of post" value="{{ old('title') }}">
                        </div>
                        <div class="form-group m-2">
                            <label for="summary">Post's summary</label>
                            <textarea type="text" class="form-control form-control-alternative" id="" name="summary" rows="2" cols="3" placeholder="The summary of content">{{ old('summary') }}</textarea>
                        </div>
                        <div class="form-group m-2">
                            <label for="content">Post's content</label>
                            <textarea type="text" class="form-control form-control-alternative" id="ckeditor_content" name="content" rows="5" cols="8" placeholder="The content" value="{{ old('content') }}">{{ old('content') }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group m-2">
                                    <img src="{{asset('assets/img/default.png')}}" class="rounded" id="picturePreview" title="" alt="Card image cap" width=70%  style="background-position: center; background-size: cover; height: auto"/>
                                    <input type="file" id="pictureInput" class="form-control-file btn btn-primary mt-1" name="image" onchange="showPreview(event);" value="{{ old('image') }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group m-2">
                                    <label for="tag">Post's tag</label>
                                    <textarea type="text" class="form-control form-control-alternative" id="" name="tag" rows="5" placeholder="Post's tag" value="{{ old('tag') }}">{{ old('content') }}</textarea>
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-2">
                                    <label for="exampleFormControlInput1">Category</label>
                                    <select class="form-control form-control-alternative" id="" name="category_id">
                                        @foreach ($categories as $category)
                                            @if ($category->category_status == 0)
                                                <option value=""></option>
                                            @else
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-2">
                                    <label for="exampleFormControlInput1">Post status</label>
                                    <select class="form-control form-control-alternative" id="" name="post_status">
                                        <option value="1">Activate</option>
                                        <option value="0">Not activate</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox m-2">
                            <input class="custom-control-input" id="exampleCheck1" type="checkbox" name="checkbox">
                            <label class="custom-control-label" for="exampleCheck1">I agree to Terms and Conditions</label>
                        </div>
                        <button type="submit" class="btn btn-primary m-3">Add new post</button>
                    </form>
                </div>
            </div>

        <div class="col-md-4">
        
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