@extends('layouts.frontend.app')

@section('title','Post')

@section('content')

<div class="wrapper">
    <div class="container">
      <!-- Page Heading/Breadcrumbs -->
    <h2 class="display-3 mt-4 mb-3">Blog's post
      <small>{{$post->title}}</small>
    </h1>

    <nav aria-label="breadcrumb" role="navigation">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Post</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
      </ol>
    </nav>

    <!-- Preview Image -->
    <img class="img-fluid rounded mb-4" src="{{ asset('storage/posts/'. $post->image) }}" alt="" width=100%  style="background-position: center; background-size: cover; height: auto;">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-12">

        <hr class="mt-0 mb-2">

        <div class="d-flex justify-content-between">
          <!-- Author -->
          <a href="{{ route('user.profile', $post->user->name) }}" class="d-flex justify-content-start">
            <img class="d-flex mr-2 rounded-circle" src="{{asset('storage/profiles/'. $post->user->image)}}" alt="{{$post->user->image}}" style="background-position: center; width: 34px; height: 34px;"/>
            <span class="pt-1">{{$post->user->name}}</span>
          </a>
          <!-- Date/Time -->
          <p class="opacity-8 text-muted">Posted on {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}} </p>
        </div>

        <hr class="mt-0 mb-2">

        <!-- Post Content -->
        <p class="text-sm"><a href="{{ route('category.posts', $post->category->title ) }}">{{$post->category['title']}}</a></p>
        <p class="summary">{{$post->summary}}</p>
        <dd class="text-default">{!!$post->content!!}</dd>
        <h6 class="text-primary mt-3">Tags:</h6><p class="text-md text-muted"><i class="ni ni-tag mr-2"></i>{{$post->tag}}</p>

        <blockquote class="blockquote">
          <h6 class="text-primary mb-0">Source:</h6> 
          <footer class="blockquote-footer">Link:
            <i class="fas fa-link"></i><cite title="Source Title">Source link</cite>
          </footer>
        </blockquote>

        <hr class="my-0">

        <div class="card-body d-flex justify-content-end">
          <!-- <a href="" class="text-md mx-4"><i class="ni ni-favourite-28 text-danger mr-1"></i>10</a> -->
          <span class="text-md mx-4"><i class="fas fa-eye text-primary mr-1"></i>{{$post->view_count}}</span>
          <span class="text-md mx-4"><i class="ni ni-chat-round text-info mr-1"></i>{{$post->comments->count()}}</span>
        </div>

        <hr class="my-0">

        <div class="col-md-8 mx-auto text-center">
          <h4 class="display-4">Related posts:</h4>
        </div>
        <div class="col-md-10 mx-auto text-left mb-2">
          <ul class="list-group list-group-flush">
            @foreach($related as $relapost)
            @if($relapost->user->id !== 1)
            @if($relapost->count() == 0)
              <h6>Không có bài viết liên quan</h6>
            @else
              <li class="list-group-item pt-0 pb-0">
                <blockquote class="blockquote mt-1">
                  <h6 class="info-title text-primary info-title mb-0"><a href="{{ route('post.details', $relapost->id) }}">{{$relapost->title}}</a></h6>
                  <footer class="blockquote-footer"><small>Post on {{\Carbon\Carbon::parse($relapost->created_at)->diffForHumans()}} by</small>&nbsp;<cite title="Source Title"><a href="{{ route('user.profile', $relapost->user->name) }}" class="description text-info">{{ $relapost->user->name}}</a></cite></footer>
                </blockquote>
              </li>
            @endif
            @endif
            @endforeach
          </ul>
        </div>
        
        <hr class="mt-0 mb-2">

        <!-- Comments Form -->
        <div class="card shadow my-4">
          <div class="card-body pt-3">
            <h5 class="h5 info-title text-primary">Comment:</h5>
            <div class="dropdown-divider"></div>
            @guest
              <h6 class="info-title text-center text-muted info-title my-4">To be able to comment, you need to &nbsp;<a href="{{ route('login') }}" class="text-info"><span>Log in</span></a></h6>
            @else
              <form method="post" action="{{ route('comment.add', $post->id) }}">
              @csrf
                <div class="form-group">
                  <textarea class="form-control" rows="3" name="comment" placeholder="Enter your comment..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3 mb-3">Comment</button>
              </form>
            @endguest
          </div>
        </div>

        <h5 class="text-primary mb-4">Comments ({{ $post->comments()->count() }})</h5>

        @if($comments->count() > 0)
        @foreach($post->comments as $comment)
        <div class="media mb-3">
          <a href="{{ route('user.profile', $comment->user->name) }}">
            <img class="d-flex mr-3 rounded-circle" src="{{ asset('storage/profiles/'. $comment->user->image) }}" alt="{{ $comment->user->image }}" style="background-position: center; width: 43px; height: 43px;">
          </a>
          <div class="media-body">
            <dt class="mt-0 mb-1"><a href="{{ route('user.profile', $comment->user->name) }}">{{ $comment->user->name }}</a></dt>
            <span class="text-default mb-1">{{ $comment->comment }}</span>
            <div class="d-flex justify-content-start">
              <p class="text-sm text-muted pt-1 mb-0 mr-2">Commented {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</p>
              <button class="btn text-primary btn-secondary btn-sm mt-0" onclick="showReplyForm('{{$comment->id}}','{{$comment->user->name}}')">Reply</button>
              @if($comment->user->id == Auth::id())
              <a class="mx-1 my-0">
                <form action="{{route('user.comment.destroy', [$comment->id])}}" method="post">
                  @method('delete')
                  @csrf
                  <input class="btn btn-danger btn-sm" onClick="return confirm('Delete this comment? Are you sure?')" type="submit" value="Delete">
                </form>
              </a>
              @endif
            </div>
            <!-- <p class="text-sm text-muted mb-1">Commented {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}} &nbsp; <button class="btn text-primary btn-secondary btn-sm mt-0" onclick="showReplyForm('{{$comment->id}}','{{$comment->user->name}}')">Reply</button></p> -->
            
            @guest
              {{-- Show none --}}
            @else
            <div class="comment-list left-padding" id="reply-form-{{$comment->id}}" style="display:none">
              <div class="single-comment justify-content-between d-flex">
                <div class="user justify-content-between d-flex">
                  <div class="thumb">
                    <img class="d-flex mr-3 rounded-circle" src="{{asset('storage/profiles/'.Auth::user()->image)}}" alt="{{Auth::user()->image}}" style="background-position: center; width: 34px; height: 34px;"/>
                  </div>
                  <div class="desc">
                    <h6 class="mt-0 mb-1"> <a href="#">{{Auth::user()->name}}</a></h6>
                    <!-- <p class="text-sm text-muted">{{date('D, d M Y H:i')}}</p> -->

                    <form action="{{ route('reply.add', $comment->id) }}" method="post">
                      @csrf
                      <div class="form-group shadow">
                        <textarea id="reply-form-{{$comment->id}}-text" name="reply" class="form-control" cols="160" rows="2" required=""></textarea>
                      </div>
                      <button type="submit" class="btn btn-info btn-sm mt-2 mb-2">Reply</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            @endguest

            @if($comment->replies->count() > 0)
            @foreach ($comment->replies as $reply)
            <div class="media mt-1">
              <a href="{{ route('user.profile', $reply->user->name) }}">
                <img class="d-flex mr-3 rounded-circle" src="{{ asset('storage/profiles/'. $reply->user->image) }}" alt="{{$reply->user->image}}" style="background-position: center; width: 34px; height: 34px;">
              </a>
              <div class="media-body">
                <h6 class="mt-0 mb-1"> <a href="#">{{$reply->user->name}}</a></h6>
                <dd class="mb-0">{{ $reply->reply }}</dd>
                <div class="d-flex justify-content-start">
                  <p class="text-sm text-muted pt-1 mb-0 mr-2">Replied {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</p>
                  <button class="btn btn-secondary btn-sm mt-0" onclick="showReplyOfReplyForm('{{$reply->id}}','{{$reply->user->name}}')">Reply</button>
                  <!-- <button class="btn btn-neutral btn-fab btn-icon btn-round btn-sm mx-1 my-0">
                    <i class="fas fa-trash-alt text-danger"></i>
                  </button> -->
                  @if($comment->user->id == Auth::id() || $reply->user->id == Auth::id())
                    <a class="mx-1 my-0">
                      <form action="{{ route('reply.destroy', $reply->id) }}" method="post">
                      @method('delete')
                      @csrf
                        <input class="btn btn-danger btn-sm" onClick="return confirm('Delete this reply? Are you sure?')" type="submit" value="Delete">
                      </form>
                    </a>
                  @endif
                </div>
              </div>
            </div>

            @guest
              {{-- Show none --}}
            @else
            <div class="comment-list left-padding" id="reply-form-{{$reply->id}}" style="display:none">
              <div class="single-comment justify-content-between d-flex">
                <div class="user justify-content-between d-flex">
                  <div class="thumb">
                    <a href="">
                      <img class="d-flex mr-3 rounded-circle" src="{{asset('storage/profiles/'.Auth::user()->image)}}" alt="{{Auth::user()->image}}" style="background-position: center; width: 34px; height: 34px;"/>
                    </a>
                  </div>
                  <div class="desc">
                    <h6 class="mt-1 mb-1"> <a href="#">{{Auth::user()->name}}</a></h6>
                    <!-- <p class="text-sm text-muted">{{date('D, d M Y H:i')}}</p> -->

                    <form action="{{ route('reply.add', $comment->id) }}" method="post">
                      @csrf
                      <div class="form-group shadow">
                        <textarea id="reply-form-{{$reply->id}}-text" name="reply" class="form-control" cols="160" rows="2" required=""></textarea>
                      </div>
                      <button type="submit" class="btn btn-info btn-sm mt-2 mb-2">Reply</button>
                      <!-- <button id="reply-btn" class="btn btn-danger btn-sm" onclick="closeReplyForm('{{$reply->id}}','{{$reply->user->image}}')">Cancel</button> -->
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="media mt-1" id="reply-form-{{$reply->id}}" style="display:none">
              <img class="d-flex mr-3 rounded-circle" src="{{asset('storage/profiles/'.Auth::user()->image)}}" alt="{{Auth::user()->image}}" style="background-position: center; width: 34px; height: 34px;"/>
              <div class="media-body">
                <div class="d-flex justify-content-between">
                  <h6 class="mt-0"> <a href="#">{{Auth::user()->name}}</a></h6>
                  <button id="reply-btn" class="btn btn-danger btn-sm" onclick="closeReplyForm('{{$reply->id}}','{{$reply->user->image}}')">Close</button>
                </div>
                
                <p class="text-sm text-muted">{{date('D, d M Y H:i')}}</p>
                    
                <form action="{{ route('reply.add', $comment->id) }}" method="post">
                @csrf
                  <div class="col-11">
                    <div class="form-group shadow">
                      <textarea id="reply-form-{{$reply->id}}-text" name="reply" class="form-control" rows="2" required=""></textarea>
                    </div>
                    <button type="submit" class="btn btn-info btn-sm mt-2 mb-2">Reply</button>
                  </div>
                </form>
                
              </div>
            </div> -->
            @endguest
            @endforeach
            @endif

          </div>
          
        </div>
        @endforeach

        @else
        <h6 class="info-title text-center text-muted info-title mb-0">This post does not have any comment, be the first one</h6>
        @endif
        <!-- Single Comment -->

      </div>
    </div>



    </div>
    <!-- /.row -->
    </div>
  </div>
<?php 
echo '<script type="text/javascript">
function showReplyForm(commentId,user) {
  var x = document.getElementById(`reply-form-${commentId}`);
  var input = document.getElementById(`reply-form-${commentId}-text`);
  if (x.style.display === "none") {
    x.style.display = "block";
    input.innerText=`@${user} `;
  } else {
    x.style.display = "none";
  }
}

function showReplyOfReplyForm(replyId,user) {
  var x = document.getElementById(`reply-form-${replyId}`);
  var input = document.getElementById(`reply-form-${replyId}-text`);
  if (x.style.display === "none") {
    x.style.display = "block";
    input.innerText=`@${user} `;
  } else {
    x.style.display = "none";
  }
}

function closeReplyForm(commentId,user) {
  var x = document.getElementById(`reply-form-${commentId}`);
  var input = document.getElementById(`reply-form-${commentId}-text`);
  x.style.display = "none";
}

</script>';
?>
@endsection