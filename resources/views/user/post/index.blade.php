@extends('user.dashboard')

@section('title','My posts')

@section('content')

<!-- Content -->
<div class="wrapper">
    <div class="container ">
      <div class="row mt-5">
        <div class="col-xl-4 col-lg-4 order-xl-2 order-lg-2 ">
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
                  <a href="#" class="btn btn-sm btn-info mr-4 disabled">Connect</a>
                  <a href="#" class="btn btn-sm btn-default float-right disabled">Message</a>
                </div>
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center">
                      <div class="d-flex flex-column mr-5">
                        @if (Auth::user()->posts->count() < 2 )
                          <span class="text-center heading">{{ Auth::user()->posts->count() }}</span>
                          <span class="description text-md text-muted">Post</span>
                        @else
                          <span class="text-center heading">{{ Auth::user()->posts->count() }}</span>
                          <span class="description text-md text-muted">Posts</span>
                        @endif
                      </div>
                      <div class="d-flex flex-column">
                        @if (Auth::user()->comments->count() < 2 )
                          <span class="text-center heading">{{ Auth::user()->comments->count() }}</span>
                          <span class="description text-md text-muted">Comment</span>
                        @else
                          <span class="text-center heading">{{ Auth::user()->comments->count() }}</span>
                          <span class="description text-md text-muted">Comments</span>
                        @endif
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

                    <div class="mt-2">
                    @if (Auth::user()->social_network == '')
                      <i class="ni ni-world-2 text-primary"></i><small class="text-muted ml-2">You have not updated this information</small>
                    @else
                      <i class="ni ni-world-2 text-primary"></i><small class="text-muted ml-2"><span class="text-primary">{{ Auth::user()->social_network }}</span> - {{ Auth::user()->social_network_link }}</small>
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

            <div class="card shadow my-2 px-5">
                <div class="d-flex justify-content-between align-items-center">
                <h1 class="display-4 text-right text-primary my-1">Display Post</h1>
                    <div>
                        <span class="badge badge-success py- px-2">Approved</span>
                        <span class="badge badge-danger py- px-2">Pending</span>
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

                <div class="col-12">
                    <!-- Title tab -->
                        
                    <!-- End title tab -->

                    <!-- Content tab -->
                        <div class="card-body mt-0">
                        <div class="tab-content" id="myTabContent">        

                            <!-- Tab panel 1 -->
                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                              <h5 class="display-4 info-title text-primary">All my posts:</h5>
                              <div class="dropdown-divider mt-3"></div>
                                <!-- <div class=" mb-3 pt-1"> -->
                                    @foreach ($post as $p)
                                    <div class="card card-lift--hover shadow mt-3">
                                        <div class="row p-2">
                                            <div class="col-md-6 col-sm-12">
                                                <a href="#">
                                                    <img class="rounded" src="{{ asset('storage/posts/'. $p->image) }}" alt="" width=100%  
                                                    style="background-position: center; min-height: 8rem; max-height: 14rem">
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="d-flex justify-content-between mb-0">
                                                  <a href="#" class="text-sm text-muted">{{$p->category['title']}}</a> 
                                                  <div class="dropdown mr-0">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                      <div class="d-flex">
                                                        <a href="{{route('user.post.edit',  $p->id)}}" class="dropdown-item"><span class="btn btn-outline-warning btn-sm">Edit</span></a>
                                                        <a class="dropdown-item" href="#">
                                                          <form action="{{route('user.post.destroy',  $p->id)}}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <input onClick="return confirm('Do you want to delete? You sure?')" type="submit" class="btn btn-outline-danger btn-sm" value="Delete">
                                                          </form>
                                                        </a>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <h6 class="text-primary lh-110 mb-2"><a href="#">{{$p->title}}</a></h6>
                                                <p class="text-sm text-muted mb-0">Posted on {{$p->created_at}}</p>
                                                <a href="{{route('user.post.show',  $p->id)}}" class="btn btn-link"><span>Read more</span> &rarr;</a>
                                                @if ($p->is_approve == true)
                                                  <span class="badge badge-success py- px-2">Approved</span>
                                                @else
                                                  <span class="badge badge-danger py- px-2">Pending</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach                    
                                    <!-- else -->
                                    <!-- <h6 class="text-muted text-center mt-2">Chưa có bài viết nào cả :))</h6> -->
                                    <!-- end-else -->
                                <!-- </div>   -->

                            </div>
                            <!-- End tab panel 1 -->
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
