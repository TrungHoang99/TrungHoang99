<div class="container">
    <div class="row">
        <div class="card col-10">
            <h3 class="card-header text-center"><span class="display-3">BlogComic</span></h3>
            <div class="card-body d-flex justify-content-center px-3 py-3">
                <h4 class="display-4">Hello Adminstrator!</h4>
                <p>There are new posts from the user that need to be accepted.</p>
                <p>To approve the article. Click the button below:</p>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('admin.post.pending') }}" class="btn btn-primary">Post pending</a>
                </div>
                <p>Users are looking forward to your response.</p>
                <h5>Regrads,</h5>
                <h4>BlogComic</h4>
            </div>
        </div>
    </div>
</div>