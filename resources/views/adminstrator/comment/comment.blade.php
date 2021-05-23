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
                                <li class="breadcrumb-item active" aria-current="page">Comment</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('admin.comment.index') }}" class="btn btn-sm btn-neutral">Comment table</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End header:breadcrumb -->

<div class="container-fluid mt--5">
<div class="row">
        <div class="col">
            <div class="card">
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
            <!-- Card header -->
            <div class="card-header border-0 d-flex justify-content-between">
                <h2 class="mb-0 mt-1">Comment table</h2> 
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col" class="sort" data-sort="name">Comment</th>
                            <th scope="col" class="sort text-center" data-sort="name">Comment's user</th>
                            <th scope="col" class="sort" data-sort="name">Post info</th>
                            <th scope="col" class="sort" data-sort="name">Author</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody class="list">
                    @foreach($comments as $comment)
                        <tr>
                            <td scope="row">{{$loop -> iteration}}</td>
                            <td scope="row">{{$comment->comment}}</td>
                            <td scope="row" class="text-center py-3">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="{{ asset('storage/profiles/'. $comment->user->image) }}">
                                </span>
                                <p class="my-0"><a href="" class="text-sm text-info">{{$comment->user->name}}</a></p>
                            </td>
                            <td scope="row"><a href="" target="_blank">{{ $comment->post->title }}</a></td>
                            <td scope="row">{{$comment->post->user->name}}</td>
                            <td class="text-center">
                                <a class="dropdown-item" href="#">
                                    <form action="{{route('admin.comment.destroy', $comment->id)}}" method="post">
                                    @method('delete')
                                    @csrf
                                        <input onClick="return confirm('Do you want to delete? You sure?')" type="submit" class="btn btn-outline-danger btn-sm" value="Delete">
                                    </form>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer py-3"> 
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  {{$comments->links()}} 
                </ul>
              </nav>
            </div>

            </div>
        </div>
    </div>
</div>
@endsection