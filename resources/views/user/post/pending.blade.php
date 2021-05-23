@extends('user.dashboard')

@section('title','Pending post')

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
                <a class="btn btn-outline-info btn-sm btn-fw" href="{{route('user.personal.password')}}">Change password</a>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-8 col-lg-8 order-xl-1 order-lg-1 mb-1">
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
                    <a class="nav-link mb-sm-3 mb-md-0" href="{{ route('home') }}"><i class="ni ni-folder-17 mr-2"></i>Comments</a>
                </li>
              </ul>
            </div>
          </div>

            <div class="card shadow my-2">
                <div class="d-flex justify-content-around align-items-center">
                <h1 class="display-4 text-right text-primary my-1">Display Post</h1>
                    <div>
                        <a href="{{ route('user.post.index') }}" class="badge badge-success py- px-2">Approved</a>
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

                <div class="col-12">
                    <!-- Title tab -->
                        
                    <!-- End title tab -->

                    <!-- Content tab -->
                        <div class="card-body mt-0">
                        <div class="tab-content" id="myTabContent">        

                            <!-- Tab panel 1 -->
                            <div class="tab-pane fade show active" id="" role="tabpanel" aria-labelledby="">
                                <h4 class="m-3 text-primary">Pending post</h4>
                                <hr class="my-0">
                                <div class=" mb-3 pt-1">
                                    @foreach ($posts_pending as $post_pending)
                                    <div class="card card-lift--hover shadow mt-3">
                                        <div class="row p-2">
                                            <div class="col-md-6 col-sm-12">
                                                <a href="#">
                                                    <img class="rounded" src="{{ asset('storage/posts/'. $post_pending->image) }}" alt="" width=100%  
                                                    style="background-position: center; min-height: 8rem; max-height: 14rem">
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <p class="mb-0"><a href="#" class="text-sm text-muted">{{$post_pending->category['title']}}</a></p>
                                                <h6 class="text-primary lh-110 mb-2"><a href="#">{{$post_pending->title}}</a></h6>
                                                <p class="text-sm text-muted mb-0">Posted on {{$post_pending->created_at}}</p>
                                                <a href="{{route('user.post.show',  $post_pending->id)}}" class="btn btn-link"><span>Read more</span> &rarr;</a>
                                                <a href="{{route('user.post.edit',  $post_pending->id)}}" class="btn btn-link"><span>edit tạm</span> &rarr;</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach                    
                                    <!-- else -->
                                    <h6 class="text-muted text-center mt-2">Chưa có bài viết nào cả :))</h6>
                                    <!-- end-else -->
                                </div>  
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
