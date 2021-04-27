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
                                <li class="breadcrumb-item active" aria-current="page">Category</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{route('admin.category.create')}}" class="btn btn-sm btn-neutral">Add new</a>
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
                <h2 class="mb-0 mt-1">Category table</h2> 
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
                            <th scope="col" class="sort" data-sort="name">Image</th>
                            <th scope="col" class="sort" data-sort="name">Created at</th>
                            <th scope="col" class="sort" data-sort="name">Updated at</th>
                            <th scope="col" class="sort" data-sort="status">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody class="list">
                    @foreach($category as $key => $cate)
                        <tr>
                            <td scope="row">{{$key}}</td>
                            <td scope="row">{{$cate->title}}</td>
                            <td>
                                @if($cate->image)
                                    <img src="{{ asset('storage/categories/'. $cate->image) }}" class="rounded w-50 h-auto">
                                @else
                                    <p class="text-muted">No image</p>
                                @endif
                            </td>
                            <td scope="row">{{$cate->created_at}}</td>
                            <td scope="row">{{$cate->updated_at}}</td>
                            <td class="">
                                @if($cate->category_status==1)
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-success"></i>
                                        <span class="status text-success">Activate</span>
                                    </span>
                                @else
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-danger"></i>
                                        <span class="status text-danger">Not activate</span>
                                    </span>
                                @endif 
                            </td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <div class="d-flex">
                                            <a class="dropdown-item" href="{{route('admin.category.edit',[$cate->id])}}"><span class="btn btn-outline-warning btn-sm">Edit</span></a>
                                            <a class="dropdown-item" href="#">
                                                <form action="{{route('admin.category.destroy', [$cate->id])}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <input onClick="return confirm('Do you want to delete? You sure?')" type="submit" class="btn btn-outline-danger btn-sm" value="Delete">
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
                  {{$category->links()}} 
                </ul>
              </nav>
            </div>

            </div>
        </div>
    </div>
</div>
@endsection