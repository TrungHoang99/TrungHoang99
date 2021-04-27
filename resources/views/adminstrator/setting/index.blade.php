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
                    <li class="breadcrumb-item active" aria-current="page">Setting</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End header:breadcrumb -->

<div class="container-fluid">
    <div class="row justify-content-center mt--5">
        <div class="col-12">
            <div class="card shadow">
                <!-- Card header -->
                <div class="card-header border-0 d-flex justify-content-between">
                    <h2 class="mb-0 mt-1">Setting navbar<span class="badge bg"></span></h2>
                </div>
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
                </div>
            </div>
        </div>

        <div class="col-12 row">
            <div class="col-md-4 col-sm-12">
                <div class="card shadow">
                    <div class="card-header pt-3 pb-3">
                        <h4 class="mb-0">Card profile</h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('storage/profiles/'. Auth::user()->image) }}" class="img-fluid rounded-circle shadow" id="picturePreview" title="" alt="Card image cap" width=124px style="background-position: center; background-size: cover; height: auto"/>
                        </div>
                        <div class="m-2">
                            <h5>Name: <span class="text-muted">{{Auth::user()->name}}</span></h5>
                            <h5>Job: <span class="text-muted">{{Auth::user()->job}}</span></h5>
                            <h5>Address: <span class="text-muted">{{Auth::user()->address}}</span></h5>
                            <h5>About: <small class="text-sm text-primary">{{Auth::user()->about}}</small></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="card shadow">
                    <!-- Title tab -->
                    <div class="card header shadow pl-5 pr-5 mb-0">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="false"><i class="fas fa-pencil-alt mr-2"></i>Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fas fa-key mr-2"></i>Change password</a>
                                </li>
                            </ul>
                        </div>
                    </div>        
                    <!-- End title tab -->

                    <!-- Content tab -->
                    <div class="card-body mt-0">
                        <div class="tab-content" id="myTabContent">        

                            <!-- Tab panel 1 -->
                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                <h3 class="text-primary">Update profile</h3>
                                <form role="form" method="post" action="{{route('admin.profile.update')}}" enctype="multipart/form-data">
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
                                    <div class="form-group">
                                        <input id="email" type="email" value="{{Auth::user()->email}}" placeholder="Regular" class="form-control form-control-alternative" disabled />
                                        <!-- <div class="input-group input-group-merge input-group-alternative disabled">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="" id="email" type="email" value="{{Auth::user()->email}}" />
                                        </div> -->
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-briefcase-24"></i></span>
                                            </div>
                                            <input id="job" name="job" class="form-control" placeholder="Your job..." type="text" autofocus  value="{{Auth::user()->job}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                                            </div>
                                            <input id="address" name="address" class="form-control" placeholder="Your address..." type="text" autofocus  value="{{Auth::user()->address}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" id="pictureInput" class="form-control-file btn btn-primary mt-1" name="image" onchange="showPreview(event);">
                                    </div>
                                    <div class="form-group m-2">
                                        <textarea type="text" class="form-control" id="" name="about" rows="5" cols="8" placeholder="About you..." value="{{ old('about') }}">{{ Auth::user()->about}}</textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary my-4">Update profile</button>
                                    </div>
                                </form>
                            </div>
                            <!-- End tab panel 1 -->
        
                            <!-- Tab panel 2 han-->
                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                <h3 class="text-primary">Change password</h3>
                                <form action="{{ route('admin.password.update') }}" method="post">
                                @csrf
                                @method('put')
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input id="old_password" type="password" name ="old_password" class="form-control" placeholder="Enter your old password" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                            </div>
                                            <input id="password" name ="password" type="password" class="form-control" placeholder="Enter your new password" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                            </div>
                                            <input id="confirm_password" name ="password_confirmation" type="password" class="form-control" placeholder="Confirm the new password" >
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Change</button>
                                </form>
                            </div>
                            <!-- End tab panel 3 -->
                        </div>
                    </div>
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