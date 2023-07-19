@include('layout.seekers.header')

<body>
<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    @include('layout.seekers.spinner')
    <!-- Spinner End -->


    <!-- Navbar Start -->
    @include('layout.seekers.nav')
    <!-- Navbar End -->

    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-md-8">
                <h3>List of Jobs</h3>
                @foreach($userFavorites as $job)

                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{$job->title}}</h5>
                                <p class="card-text">Applied+{{$job->pivot->created_at}}</p>
                                <a href="{{route('show.jobs',[$job->slug])}}" class="btn btn-dark">View</a>
                            </div>
                        </div>
                    @endforeach

            </div>
        </div>
    </div>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
@include('layout.seekers.links')
</body>

</html>

