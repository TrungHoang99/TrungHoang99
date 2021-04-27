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
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboards</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Welcome! My Adminstrator</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{route('admin.category.create')}}" class="btn btn-sm btn-neutral">Add new</a>
                    </div>
                </div>
                <div class="row">
                    <!-- 1 -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total posts</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $posts->count() }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="ni ni-archive-2"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- <p class="mt-3 mb-0 text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p> -->
                            </div>
                        </div>
                    </div>
                    <!-- End 1 -->
                    <!-- 1 -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Categories</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $category_count }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                            <i class="ni ni-archive-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End 1 -->
                    <!-- 1 -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Pending posts</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_pending_posts }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                            <i class="ni ni-archive-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End 1 -->
                    <!-- 1 -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total views</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $all_views }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                            <i class="ni ni-archive-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End 1 -->
                    <!-- 1 -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total users</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $user_count }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                            <i class="ni ni-archive-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End 1 -->
                    <!-- 1 -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Today users</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $new_users_today }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                            <i class="ni ni-archive-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End 1 -->
                </div>
            </div>
        </div>
    </div>
    <!-- End header:breadcrumb -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                        <h3 class="mb-0">Most popular posts</h3>
                        </div>
                        <div class="col text-right">
                            <!-- <a href="#!" class="btn btn-sm btn-primary">See all</a> -->
                        </div>
                    </div>
                    </div>
                    <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col" class="text-center">Views</th>
                            <th scope="col" class="text-center">Comments</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($popular_posts as $key=>$post)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td class="text-center">{{ $post->view_count }}</td>
                                    <td class="text-center">{{ $post->comments->count() }}</td>
                                    <td>
                                        @if($post->post_status == true)
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
                                    <td class="text-right">
                                        <a class="dropdown-item" href="{{route('admin.post.show', $post->id)}}"><span class="btn btn-outline-primary btn-sm">View</span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                        <h3 class="mb-0">Top active users</h3>
                        </div>
                        <div class="col text-right">
                            <!-- <a href="#!" class="btn btn-sm btn-primary">See all</a> -->
                        </div>
                    </div>
                    </div>
                    <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-center">Posts</th>
                            <th scope="col" class="text-center">Comments</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($active_users as $key=>$user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->posts->count() }}</td>
                                    <td class="text-center">{{ $user->comments->count() }}</td>
                                    <td>
                                        <a class="dropdown-item" href="#">
                                            <form action="{{route('admin.users.destroy', $user->id)}}" method="post">
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
                </div>
            </div>
        </div>  
    </div>

@endsection