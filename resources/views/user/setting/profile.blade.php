@extends('user.dashboard')

@section('title','My profile')

@section('content')

<!-- Content -->
<div class="wrapper">
    <div class="container ">
      <div class="row mt-5">
        <div class="col-xl-4 order-xl-2">
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
                  <a href="#" class="btn btn-sm btn-info  mr-4 disabled">Connect</a>
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
                      <i class="ni ni-hat-3 text-primary"></i><small class="text-muted ml-2">{{ Auth::user()->about }}</small>
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
                <a class="btn btn-outline-info btn-sm btn-fw" href="{{ route('user.personal.password') }}">Change password</a>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-8 order-xl-1 mb-1">
          <div class="col-12 card shadow">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row justify-content-start" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 " href="{{ route('user.personal.timeline') }}" ><i class="ni ni-basket mr-2"></i>Timeline</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" href="{{ route('user.personal.profile') }}"><i class="ni ni-single-02 mr-2"></i>Profile</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" href="{{ route('user.post.index') }}"><i class="ni ni-folder-17 mr-2"></i>Post</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" href="{{ route('user.comment.index') }}"><i class="ni ni-chat-round mr-2"></i>Comment</a>
                  </li>
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
                <h4 class="m-2 text-primary">Update profile</h4>
                <form role="form" method="post" action="{{route('user.profile.update')}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-badge"></i></span>
                                            </div>
                                            <input id="name" name="name" class="form-control" placeholder="" type="text" required autocomplete="name" autofocus value="{{Auth::user()->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                      <input id="email" type="email" value="{{Auth::user()->email}}" placeholder="" class="form-control form-control-alternative" disabled />
                                    </div>
                                    <div class="form-group mb-3">
                                      <div class="input-group input-group-merge input-group-alternative">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="ni ni-briefcase-24"></i></span>
                                          </div>
                                          <input id="job" name="job" class="form-control" placeholder="Your job..." type="text" autofocus  value="{{Auth::user()->job}}">
                                      </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                                            </div>
                                            <input id="address" name="address" class="form-control" placeholder="Your address..." type="text" autofocus  value="{{Auth::user()->address}}">
                                        </div>
                                    </div>
                                    <div class="card-body show">
                                        <div class="form-group m-2">
                                          <div class="d-flex justify-content-center">
                                            <img src="{{ asset('storage/profiles/'. Auth::user()->image) }}" class="img-fluid rounded-circle shadow" id="picturePreview" title="" alt="Card image cap" width=30%  style="background-position: center; background-size: cover; height: auto"/>
                                          </div> 
                                            <label class="d-flex justify-content-center text-info my-2" for="pictureInput">Select image</label>
                                            <input type="file" id="pictureInput" class="form-control-file btn btn-primary mt-1" name="image" onchange="showPreview(event);" hidden>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                      <div class="input-group input-group-merge input-group-alternative">
                                        <textarea type="text" class="form-control" id="" name="about" rows="5" cols="8" placeholder="About you..." value="{{ old('about') }}">{{ Auth::user()->about}}</textarea>
                                      </div>
                                    </div>
                                    <div class="form-group my-3">
                                      <label for="social_network" class="mb-0"><h6 class="text-primary"><i class="ni ni-fat-delete mr-2"></i>Social network</h6></label>
                                      <div class="row">
                                        <div class="col-md-4 col-12">
                                          <input type="text" class="form-control form-control-alternative" id="" name="social_network" placeholder="Social network" value="{{ Auth::user()->social_network }}">
                                        </div>
                                        <div class="col-md-8 col-12">
                                          <input type="text" class="form-control form-control-alternative" id="" name="social_network_link" placeholder="Social network link" value="{{ Auth::user()->social_network_link }}">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="text-center">
                                      <button type="submit" class="btn btn-primary my-3">Update profile</button>
                                    </div>
                                </form>
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

