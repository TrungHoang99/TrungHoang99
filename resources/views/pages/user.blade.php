@extends('layouts.frontend.app')

@section('title','User')

@section('content')

<div class="wrapper">

    <div class="container mt-3">
        <h2 class="display-3 mt-4 mb-3">User 
            <small>profile</small>
        </h2>

        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
            </ol>
        </nav>
    </div>

    <section class="section">
      <div class="container">
        <div class="card card-profile shadow">
          <div class="px-4">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image mt-4">
                  <a href="javascript:;">
                    <img src="{{ asset('storage/profiles/'. $user->image) }}" class="rounded-circle" width=142px  style="background-position: center; background-size: cover; height: 142px;">
                  </a>
                </div>
              </div>
              <!-- btn -->
              <!-- <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                <div class="card-profile-actions py-4 mt-lg-0">
                  <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                  <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                </div>
              </div> -->
              <!-- end-btn -->
              <div class="col-lg-4 order-lg-1">
                <div class="card-profile-stats d-flex justify-content-center">
                  <div class="d-flex flex-column mr-3">
                    <span class="heading text-center"><b>{{ $posts->count() }}</b></span>
                    <span class="description text-md text-muted">Posts</span>
                  </div>
                  <div class="d-flex flex-column">
                    <span class="heading text-center"><b>{{ $user->comments->count() }}</b></span>
                    <span class="description text-md text-muted">Comments</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center mt-5">
              <h3>{{ $user->name }}<span class="font-weight-light"></span></h3>
              <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>{{ $user->address }}</div>
              <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>{{ $user->job }}</div>
              <!-- <div><i class="ni education_hat mr-2"></i>University of Computer Science</div> -->
            </div>
            <div class="mt-3 py-3 border-top text-center">
              <div class="row justify-content-center">
                <div class="col-lg-9">
                  <p><strong>{{ $user->about }}</strong></p>
                  <!-- <a href="javascript:;">Show more</a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="card shadow">
                <h3 class="display-3 text-muted text-center my-2">Popular Stuff</h3>
                <hr class="mt-0 mb-2">
                <div class="card-body mb-3 pt-2">
                  @if($posts->count() > 0)
                    <!-- User's post -->
                    @foreach ($posts as $post)
                      <div class="card card-lift--hover shadow mt-3">
                          <div class="row pt-3 pl-3 pb-3">
                              <div class="col-lg-6">
                                  <a href="{{ route('post.details', $post->id) }}">
                                  <img class="rounded" src="{{ asset('storage/posts/'. $post->image) }}" alt="" width=100%  
                                      style="background-position: center; min-height: 10rem; max-height: 14rem">
                                  </a>
                              </div>
                              <div class="col-lg-6">
                                  <h5 class="text-primary text-md lh-120 mt-1 mb-2"><a href="{{ route('post.details', $post->id) }}">{{ $post->title }}</a></h5>
                                  <p class="card-text opacity-8 text-md text-muted lh-120 mb-1">{{ $post->summary }}</p>
                                  <p class="text-sm text-muted">Posted on {{ $post->created_at }}</p>
                                  <a href="{{ route('post.details', $post->id) }}" class="btn btn-link"><span>Read more</span> &rarr;</a>
                              </div>
                          </div>
                      </div>
                    @endforeach
                    <!-- End User's post -->

                    <!-- <div class="card card-lift--hover show mt-3">
                        <div class="row pt-3 pl-3 pb-3">
                            <div class="col-lg-6">
                                <a href="#">
                                <img class="rounded" src="{{asset('assets/img/wizard.jpg')}}" alt="" width=100%  
                                    style="background-position: center; min-height: 10rem; max-height: 14rem">
                                </a>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="text-primary text-md lh-120 mt-1 mb-2"><a href="#">Post Title dsfjhsdfjksdhfj sdfhsjkfhsdjkfh sdfhskjfhsjkd hsdkfjh sdjfhskjfhsdjh fjksfsdjfhsd fhdjfhd dhjfhd</a></h5>
                                <p class="card-text opacity-8 text-md text-muted mb-1 lh-120">Summary of post summary of post summaryofpost summary of post summaryofpost summary of post</p>
                                <p class="text-sm text-muted">Posted on January 1, 2017</p>
                                <a href="#" class="btn btn-link"><span>Read more</span> &rarr;</a>
                            </div>
                        </div>
                    </div> -->
                    
                    <!-- else -->
                    @else
                    <h6 class="text-muted text-center mt-2">Chưa có bài viết nào cả :))</h6>
                    <!-- end-else -->
                  @endif
                </div>  
            </div>
        </div>
    </section>

    <section class="section ">

    </section>
</div>


@endsection