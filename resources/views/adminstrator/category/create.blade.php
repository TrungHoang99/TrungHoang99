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
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Category</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add new</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{route('admin.category.index')}}" class="btn btn-sm btn-neutral">Category table</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End header:breadcrumb -->

<div class="container">
<div class="row justify-content-center mt--5">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header border-0 d-flex justify-content-between">
                    <h2 class="mb-0 mt-1">Add new category</h2>
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

                    <form autocomplete="off" method="post" action="{{route('admin.category.store')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Title</label>
                            <input type="text" class="form-control" id="" name="title" placeholder="The title of category">
                        </div>
                        <div class="form-group m-2">
                            <img id="picturePreview" class="img-thumbnail" src="{{asset('assets/img/no-default.png')}}" alt="Card image cap" width=50%  style="background-position: center; background-size: cover; height: auto">
                            <input type="file" id="pictureInput" class="form-control-file btn btn-primary mt-1" name="image" onchange="showPreview(event);">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Category status</label>
                            <select class="form-control" id="" name="category_status">
                                <option value="1">Activate</option>
                                <option value="0">Not activate</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Create category</button>
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