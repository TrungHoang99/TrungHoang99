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
                                <li class="breadcrumb-item active" aria-current="page">View detail</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{route('admin.post.create')}}" class="btn btn-sm btn-neutral">Add new</a>
                        <a href="{{route('admin.post.index')}}" class="btn btn-sm btn-neutral">Post table</a>
                        <a href="{{route('admin.post.pending')}}" class="btn btn-sm btn-neutral">Pending post table</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End header:breadcrumb -->

<div class="container-fluid">   
    <div class="row justify-content-center mt--5">
        <div class="col-md-12 d-flex justify-content-start">
            <a href="{{route('admin.post.pending')}}" class="btn btn-danger p-1 mb-2"><i class="ni ni-bold-left"></i>BACK</a>       
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header border-0 d-flex justify-content-between align-items-center">
                    <div class="">
                        <h2 class="mb-0 mt-1">Title: <span class="text-info">{{$post->title}}</span></h2>
                        <small>Post by
                            <strong><a href="">{{$post->user['name']}}</a></strong>
                            on {{$post->created_at}}
                        </small>
                    </div>
                    @if($post->is_approve == false)
                        <form action="{{route('admin.post.approve', [$post->id])}}" method="post">
                            @method('put')
                            @csrf
                            <button type="submit" class="btn btn-success pull-right" onClick="return confirm('Do you want to approve to public?')"><i class="fas fa-pencil-alt"></i><span class="ml-1">Approve</span></button>
                            <!-- <input onClick="return confirm('Are you sure?')" type="submit" class="btn btn-success pull-right" value="Approve"> -->
                        </form>
                    @else
                        <button type="button" class="btn btn-success pull-right" disabled>
                            <i class="fas fa-check"></i><span class="ml-1">Approved</span>
                        </button>
                    @endif

                </div>

                <div class="card-body">
                    <p>{{ $post->summary }}</p>
                    <dt>{!!$post->content!!}</dt>
                </div>
            </div>

            <div class="card">
                <div class="card-header border-0 ">
                    <h3 class="mb-0 mt-1">Image</h3>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <img class="rounded w-50 h-auto" src="{{ asset('storage/posts/'. $post->image) }}" alt="">
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-0">Category</h3>
                    <div class="dropdown-divider my-2"></div>
                    <a href="" class="badge badge-info">{{$post->category['title']}}</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="mb-0">Tag</h3>
                    <div class="dropdown-divider my-2"></div>
                    <span class="badge badge-warning">{{$post->tag}}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="mb-0">Source</h3>
                    <div class="dropdown-divider my-2"></div>
                    <dt>{{ $post->source_title }}</dt>
                    <small class="">{{ $post->source_link }}</small>
                </div>
            </div>

            <!-- <div class="card">
                <div class="card-header border-0 d-flex justify-content-between align-items-center">
                    <h3 class="mb-0 mt-1">Tag</h3>
                </div>
                <div class="card-body">
                    <span class="badge badge-warning">{{$post->tag}}</span>
                </div>
            </div> -->


        </div>
    </div>
</div>

@endsection