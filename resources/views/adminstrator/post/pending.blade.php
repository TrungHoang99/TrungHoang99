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
                                <li class="breadcrumb-item active" aria-current="page">Browse post</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{route('admin.post.create')}}" class="btn btn-sm btn-neutral">Add new</a>
                        <a href="{{route('admin.post.index')}}" class="btn btn-sm btn-neutral">Post table</a>
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
                <h2 class="mb-0 mt-1">Post table <span class="badge bg"></span></h2>
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
                            <th scope="col" class="sort" data-sort="name">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Author</th>
                            <th scope="col">View</th>
                            <th scope="col">Image</th>
                            <th scope="col" class="sort">Status</th>
                            <th scope="col" class="sort">Is Approve</th>
                            <th scope="col" class="sort">Created at</th>
                            <th scope="col" class="sort">Updated at</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody class="list">
                    @foreach($post as $value)
                        <tr>
                            <th scope="row">{{$loop -> iteration}}</th>
                            <td>{{$value->title}}</td>
                            <td>{{$value->category['title']}}</td>
                            <td>{{$value->user['name']}}</td>
                            <td>{{$value->view_count}}</td>
                            <td>
                                @if($value->image)
                                    <img src="{{ asset('storage/posts/'. $value->image) }}" class="rounded" style="width:160%; height: auto">
                                @else
                                    <p>No image</p>
                                @endif
                            </td>
                            <td>
                                @if($value->post_status == true)
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-success"></i>
                                        <span class="status text-success">activate</span>
                                    </span>
                                @else
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-danger"></i>
                                        <span class="status text-danger">not activate</span>
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($value->is_approve == true)
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-info"></i>
                                        <span class="status text-info">published</span>
                                    </span>
                                @else
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-warning"></i>
                                        <span class="status text-warning">pending</span>
                                    </span>
                                @endif
                            </td>
                            <td>{{$value->created_at}}</td>
                            <td>{{$value->updated_at}}</td>
                            <td class="text-right">
                                <div class="dropup">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <div class="d-flex">
                                            <a class="dropdown-item" href="{{route('admin.post.show',[$value->id])}}"><span class="btn btn-outline-primary btn-sm">View</span></a>
                                            <a class="dropdown-item" href="{{route('admin.post.edit',[$value->id])}}"><span class="btn btn-outline-warning btn-sm">Edit</span></a>
                                            <a class="dropdown-item" href="#">
                                                <form action="{{route('admin.post.destroy', [$value->id])}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <input onClick="return confirm('Delete? You sure?')" type="submit" class="btn btn-outline-danger btn-sm" value="Delete">
                                                </form>
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        
            <div class="card-footer py-3"> 
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  {{$post->links()}} 
                </ul>
              </nav>
            </div>

            </div>
        </div>
    </div>
</div>
@endsection