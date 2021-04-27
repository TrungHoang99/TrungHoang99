@extends('user.dashboard')

@section('title','Comment')

@section('content')

<!-- Content -->
<div class="wrapper">
    <div class="container ">
        <div class="row mt-5">
            <div class="col-xl-4 col-lg-4 order-xl-2 order-lg-2">
            <div class="grid-tab-content">
                <div class="card card-profile shadow">
                <img src="{{asset('assets/img/wizard-city.jpg')}}" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        <a href="#">
                        <img src="{{ asset('storage/profiles/'. Auth::user()->image) }}" class="rounded-circle" width=133px  style="background-position: center; background-size: cover; height: auto;">
                        </a>
                    </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-7 pt-md-4 pb-md-4">
                    <div class="d-flex justify-content-around">
                    <a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
                    <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center">
                                <div class="d-flex flex-column mr-5">
                                    <span class="text-center heading">10</span>
                                    <span class="description text-md text-muted">Post</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-center heading">89</span>
                                    <span class="description text-md text-muted">Comments</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <h5 class="text-center display-4 text-info text-md lh-120">
                            {{Auth::user()->name}}
                        </h5>
                        <h6 class="text-default mt-3 pl-2">Personal information:</h6>
                        <div class="pl-3 mt-2"> 
                            <div class="mt-2">
                            @if (Auth::user()->address == '')
                            <i class="ni ni-square-pin text-primary"></i><small class="text-muted ml-2">You have not updated this information</small>
                            @else
                            <i class="ni ni-square-pin text-primary"></i><small class="text-muted ml-2">{{Auth::user()->address}}</small>
                            @endif
                            </div>

                            <div class="mt-2">
                            @if (Auth::user()->job == '')
                            <i class="ni ni-briefcase-24 text-primary"></i><small class="text-muted ml-2">You have not updated this information</small>
                            @else
                            <i class="ni ni-briefcase-24 text-primary"></i><small class="text-muted ml-2">{{Auth::user()->job}}</small>
                            @endif
                            </div>

                            <div class="mt-2">
                            @if (Auth::user()->about == '')
                            <i class="ni ni-hat-3 text-primary"></i><small class="text-muted ml-2">You have not updated this information</small>
                            @else
                            <i class="ni ni-hat-3 text-primary"></i><small class="text-muted ml-2">{{Auth::user()->about}}</small>
                            @endif
                            </div>
                    
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center p-4">
                    <a class="btn btn-outline-info btn-sm btn-fw" href="{{ route('user.personal.profile') }}">Edit profile</a>
                </div>
                </div>
            </div>
            </div>
            
            <div class="col-xl-8 col-lg-8 order-xl-1 order-lg-1 mb-1">
                <div class="col-12 card shadow">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row justify-content-start" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 " href="{{ route('home') }}" ><i class="ni ni-basket mr-2"></i>Timeline</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" href="{{ route('user.personal.profile') }}"><i class="ni ni-single-02 mr-2"></i>Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" href="{{ route('user.post.index') }}"><i class="ni ni-folder-17 mr-2"></i>Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" href="{{ route('user.comment.index') }}"><i class="ni ni-folder-17 mr-2"></i>Comments</a>
                        </li>
                        </ul>
                    </div>
                </div>

                <div class="card shadow my-2 px-5">
                    <div class="d-flex justify-content-between align-items-center">
                    <h1 class="display-4 text-right text-primary my-1">Display comment</h1>
                        <div>
                            <a href="{{ route('user.post.index') }}" class="badge badge-success py- px-2">Comment</a>
                            <span class="badge badge-danger py- px-2 disabled">Pending</span>
                        </div>
                    </div>
                </div>   

                <div class="col-12 card mt-3 pt-4 shadow">
                    <div class="card-body">
                    <!-- Notification -->
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
                        
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Notification!</strong>     
                                    {{session('error')}}
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
                    <!-- End notification -->

                        <div class="tab-pane fade show active" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">

                            <h5 class="display-4 info-title text-primary px-4">Comment of your post:</h5>
                            <div class="dropdown-divider mt-3"></div>
                            @foreach($posts as $post)
                                @foreach($post->comments as $comment)
                                <div class="card shadow py-3 px-3 mb-3">
                                    <div class="d-flex justify-content-between pb-0">
                                        <span class="mb-0"><a href="">{{$comment->user->name}}</a> added a comment to your <a href="{{ route('post.details', $comment->post->id) }}" target="_blank">{{$comment->post->title}}</a> post {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
                                        
                                        @if($comment->user->role->id == 1)
                                        @else
                                            <div class="dropdown mr-0">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <div class="d-flex">
                                                        <a class="dropdown-item" href="#">
                                                            <form action="{{route('user.comment.destroy', [$comment->id])}}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <input onClick="return confirm('Do you want to delete? You sure?')" type="submit" class="btn btn-outline-danger btn-sm" value="Delete">
                                                            </form>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            @endforeach

                            <h5 class="display-4 info-title text-primary px-4">Personal comment:</h5>
                            <div class="dropdown-divider mt-3"></div>

                            @foreach($comments as $comment)
                            <div class="card shadow py-3 px-3 mb-4">
                                <div class="d-flex justify-content-between pb-0">
                                    <span>You added a comment to the post with title is <a href="{{ route('post.details', $comment->post->id) }}" class="text-primary">{{$comment->post->title}}</a> of <a href="{{ route('user.profile', $comment->post->user->name) }}">{{$comment->post->user->name}}</a> {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
                                    <div class="dropdown mr-0">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <div class="d-flex">
                                                        <a class="dropdown-item" href="#">
                                                            <form action="{{route('user.comment.destroy', [$comment->id])}}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <input onClick="return confirm('Do you want to delete? You sure?')" type="submit" class="btn btn-outline-danger btn-sm" value="Delete">
                                                            </form>
                                                        </a>
                                                    </div>
                                                </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
  <!-- End content-->
@endsection

