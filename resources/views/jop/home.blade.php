@include('layout.seekers.header')
<body>
<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    @include('layout.seekers.spinner')
    <!-- Spinner End -->


    <!-- Navbar Start -->
    @include('layout.seekers.nav')
    <!-- Navbar End -->

    @include('message')
    <!-- Header End -->
    <div class="container-xxl py-5 bg-dark page-header mb-5">
        <div class="container my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Job List</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-uppercase">

                </ol>
            </nav>
        </div>
    </div>
    <!-- Header End -->


    <!-- Jobs Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Job Listing</h1>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                    <li class="nav-item">
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Salary
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('create.jobs',['sort'=>'high_to_low'])}}">High to low</a></li>
                        <li><a class="dropdown-item" href="{{route('create.jobs',['sort'=>'low_to_high'])}}">Low to high</a></li>
                    </ul>

                    <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Date
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('create.jobs',['date'=>'latest'])}}">Latest</a></li>
                        <li><a class="dropdown-item" href="{{route('create.jobs',['date'=>'oldest'])}}">Oldest</a></li>
                    </ul>

                    <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Job type
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('create.jobs',['jop_type'=>'fulltime'])}}">Fulltime</a></li>
                        <li><a class="dropdown-item" href="{{route('create.jobs',['jop_type'=>'parttime'])}}">Parttime</a></li>
                        <li><a class="dropdown-item" href="{{route('create.jobs',['jop_type'=>'casual'])}}">Remote</a></li>
                    </ul>
                </div>
                        <br>
    <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="job-item p-4 mb-4">
                            @foreach($jobs as $job)
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded-circle" src="{{ Storage::url($job->feature_photo) }}" alt="" style="width: 80px; height: 80px;">

                                        <div class="text-start ps-4">
                                            <h5 class="mb-3">{{ $job->title }}</h5>
                                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $job->address }}</span>
                                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $job->job_type }}</span>
                                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>{{ number_format($job->salary, 2)}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">

                                            @if(auth()->user()->favorites->contains($job))
                                                <!-- If the job is a favorite, show the "Unfavorite" button -->
                                                <form action="{{ route('posts.UnFavorite', $job->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-light btn-square me-3">
                                                        <i class="fas fa-heart text-primary"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <!-- If the job is not a favorite, show the "Favorite" button -->
                                                <form action="{{ route('posts.favorite', $job->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-light btn-square me-3">
                                                        <i class="far fa-heart text-primary"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <a class="btn btn-primary" href="{{route('show.jobs',[$job->slug])}}">Apply Now</a>
                                        </div>
                                        <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: {{ $job->application_close_date }} </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Pagination links -->
                        <div class="pagination d-flex justify-content-center mt-4">
                            {{ $jobs->links() }}
                        </div>
                    </div>
                </div>


    <!-- Jobs End -->

    <!-- Footer Start -->
    @include('layout.seekers.footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
@include('layout.seekers.links')
</body>
</html>

