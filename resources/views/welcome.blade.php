@extends('layouts.frontend.app')

@section('title','Home')

@section('content')

<header class="">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 h-100" src="assets/img/wizard-boat.jpg" alt="Smiley face">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 h-100" src="assets/img/wizard-city.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 h-100" src="assets/img/wizard-city.jpg" alt="Third slide">
    </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</header>

<div class="section features-1">
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto text-center">
        <h2 class="display-2">Category</h2>
        <p class="lead">The time is now for it to be okay to be great. For being a bright color. For standing out.</p>
      </div>
    </div>
    <div class="row">
    @foreach($categories as $category)
      @if ($category->category_status == 1) 
        <div class="col-lg-3 col-md-4 col-sm-6 col-6 my-2">
          <div class="info">
            <h6 class="info-title text-uppercase text-primary">{{$category->title}}</h6>
            <p class="description opacity-8"></p>
            <div class="card card-lift--hover shadow p-0 m-0">
              <img src="{{ asset('storage/categories/'. $category->image) }}" alt="" class="rounded" width=100%  
                style="background-position: cover; height: 160px">
            </div>
            @if($category->posts->count() >= 2)
              <p class="description opacity-8 text-small mt-1 mb-1">{{ $category->posts->count() }} posts</p>
            @else
              <p class="description opacity-8 text-small mt-1 mb-1">{{ $category->posts->count() }} post</p>
            @endif
            <a href="{{ route('category.posts', $category->title) }}" class="text-primary">More about...
              <i class="ni ni-bold-right text-primary"></i>
            </a>
          </div>
        </div>
      @endif  
    @endforeach
    </div>    
  </div>
</div>

<div class="section features-2">
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto text-center">
        <h4 class="display-3">Popular Stuff</h4>
      </div>
    </div>
    <hr class="mt-2 mb-2">
    <div class="row">
    @foreach($posts as $post)
    @if($post->is_approve == true)
      @if($post->user->id !== 1)
      <div class="col-lg-3 col-md-4 col-sm-6 col-6 my-2">
        <div class="card card-lift--hover shadow py-0 px-0 m-0">
            <div class="info pt-0">
            <p class="description opacity-8 mt-0"></p>
                <div class="description">
                    <img src="{{ asset('storage/posts/'. $post->image) }}" alt="{{$post->title}}" class="rounded" width=100%  
                    style="background-position: cover; height: 160px">
                </div>
                <div class="ml-2">
                    <h5 class="info-title text-primary content-tab-item__detail pt-1 mt-1 mb-1"><a href="{{ route('post.details', $post->id) }}">{{$post->title}}</a></h5>
                    <p class="description text-info mb-1"><a href="{{ route('user.profile', $post->user['name']) }}">{{$post->user['name']}}</a></p>
                    <p class="description opacity-8 text-sm mb-1">{{$post->created_at}}</p>
                </div>
                <div class="dropdown-divider mt-1"></div>
                <div class="card-body d-flex justify-content-around">
                    <!-- <a href="" class="text-sm"><i class="ni ni-favourite-28 text-danger"></i>10</a> -->
                    <a href="" class="text-sm"><i class="fas fa-eye text-primary"></i>{{$post->view_count}}</a>
                    <a href="" class="text-sm"><i class="ni ni-chat-round text-info"></i>{{ $post->comments->count() }}</a>
                </div>
            </div>
        </div>
      </div>
      @endif
    @endif
    @endforeach


    </div>    
  </div>
</div>

<div class="section features-2">
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto text-center">
        <h4 class="display-3">Posts on the Adminstrator</h4>
      </div>
    </div>
    <hr class="mt-2 mb-2">
    <div class="row">
    @foreach($posts as $post)
    @if($post->is_approve == true)
      @if($post->user->id == 1)
      <div class="col-lg-3 col-md-4 col-sm-6 col-6 my-2">
        <div class="card card-lift--hover shadow py-0 px-0 m-0">
            <div class="info pt-0">
            <p class="description opacity-8 mt-0"></p>
                <div class="description">
                    <img src="{{ asset('storage/posts/'. $post->image) }}" alt="{{$post->title}}" class="rounded" width=100%  
                    style="background-position: cover; height: 160px">
                </div>
                <div class="ml-2">
                    <h5 class="info-title text-primary content-tab-item__detail pt-1 mt-1 mb-1"><a href="{{ route('post.details', $post->id) }}">{{$post->title}}</a></h5>
                    <p class="description text-info mb-1"><a href="{{ route('user.profile', $post->user['name']) }}">{{$post->user['name']}}</a></p>
                    <p class="description opacity-8 text-sm mb-1">{{$post->created_at}}</p>
                </div>
                <div class="dropdown-divider mt-1"></div>
                <div class="card-body d-flex justify-content-around">
                    <!-- <a href="" class="text-sm"><i class="ni ni-favourite-28 text-danger"></i>10</a> -->
                    <a href="{{ route('post.details', $post->id) }}" class="text-sm"><i class="fas fa-eye text-primary"></i>{{$post->view_count}}</a>
                    <a href="" class="text-sm"><i class="ni ni-chat-round text-info"></i>{{ $post->comments->count() }}</a>
                </div>
            </div>
        </div>
      </div>
      @endif
    @endif
    @endforeach


    </div>    
  </div>
</div>







<!-- <div class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto text-center">
        <h4 class="display-3">Popular Author</h4>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="card mb-4">
          <img class="rounded" src="{{asset('assets/img/wizard.jpg')}}" alt="Card image cap" height=150px>
            <div class="card-body">
              <h7 class="card-title text-primary">Post Title</h7>
              <p class="description opacity text-small">
                <a href="#" class="text-default">Author</a>January 1, 2017
              </p>
              <div class="dropdown-divider"></div>
            </div>
            <div class="card-body d-flex justify-content-between">
              <a href="" class="text-sm"><i class="ni ni-favourite-28 text-danger"></i>10</a>
              <a href="" class="text-sm"><i class="fas fa-eye text-primary"></i>10</a>
              <a href="" class="text-sm"><i class="ni ni-chat-round text-info"></i>10</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="info">
          <h6 class="info-title text-uppercase text-primary">Title</h6>
          <p class="description opacity-8"></p>
          <div class="description opacity-8">
            <img src="{{asset('assets/img/no-default.png')}}" alt="..." class="img-thumbnail">
          </div>
          <p class="description opacity-8 text-small mt-1">2 posts</p>
          <a href="javascript:;" class="text-primary">More about us
            <i class="ni ni-bold-right text-primary"></i>
          </a>
        </div>
      </div>

    </div>    
  </div>
</div> -->



  <!-- Header -->
  <header class="bg-primary py-5 mb-5">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-lg-12">
          <h1 class="display-4 text-white mt-5 mb-2">Business Name or Tagline</h1>
          <p class="lead mb-5 text-white-50">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non possimus ab labore provident mollitia. Id assumenda voluptate earum corporis facere quibusdam quisquam iste ipsa cumque unde nisi, totam quas ipsam.</p>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  <div class="container">

    <div class="row">
      <div class="col-md-8 mb-5">
        <h2>What We Do</h2>
        <hr>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deserunt neque tempore recusandae animi soluta quasi? Asperiores rem dolore eaque vel, porro, soluta unde debitis aliquam laboriosam. Repellat explicabo, maiores!</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis optio neque consectetur consequatur magni in nisi, natus beatae quidem quam odit commodi ducimus totam eum, alias, adipisci nesciunt voluptate. Voluptatum.</p>
        <a class="btn btn-primary" href="#">Call to Action &raquo;</a>
      </div>
      <div class="col-md-4 mb-5">
        <h2>Contact Us</h2>
        <hr>
        <address>
          <strong>Start Bootstrap</strong>
          <br>3481 Melrose Place
          <br>Beverly Hills, CA 90210
          <br>
        </address>
        <address>
          <abbr title="Phone">P:</abbr>
          (123) 456-7890
          <br>
          <abbr title="Email">E:</abbr>
          <a href="mailto:#">name@example.com</a>
        </address>
      </div>
    </div>
    <!-- /.row -->


  </div>
  <!-- /.container -->

@endsection
