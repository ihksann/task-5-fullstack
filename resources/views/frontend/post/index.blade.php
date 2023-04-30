<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @forelse ($posts as $postitem)
                    <div class="card card-shadow mt-4">
                        <div class="card-body">
                            <a href="">
                                <h2 class="post-heading">{{ $postitem->title }}</h2>
                            </a>
                        </div>
                    </div>

                @empty
                    <div class="card card-shadow mt-4">
                        <div class="card-body">
                            <h1>No Post</h2>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
