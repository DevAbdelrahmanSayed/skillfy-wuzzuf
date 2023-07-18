<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.seekers.header')
</head>

<body>
<div class="container-xxl bg-white p-0">

    <!-- Spinner Start -->
    @include('layout.seekers.spinner')
    <!-- Spinner End -->

    <!-- Navbar Start -->
    @include('layout.seekers.nav')
    <!-- Navbar End -->

    <!-- Header Start -->
    <div class="container-xxl py-5 bg-dark page-header mb-5">
        <div class="container my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Job Detail</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item text-white active" aria-current="page">Job Detail</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Header End -->
    @include('message')
    <!-- Job Detail Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gy-5 gx-4">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-5">
                        <img class="flex-shrink-0 img-fluid border rounded" src="{{ Storage::url($listing->feature_photo) }}" alt="" style="width: 80px; height: 80px;">
                        <div class="text-start ps-4">

                            <h2 class="card-title">{{ $listing->title }}</h2>

                            <a href="{{ route('show.company', [$listing->user_posts->id]) }}">
                                <p>{{ $listing->user_posts->name }}</p>
                            </a>
                            <span class="badge bg-primary">{{ $listing->job_type }}</span>
                            <p>Salary: {{ number_format($listing->salary, 2) }}$ </p>
                            <p>Address: {{ $listing->address }}</p>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h4 class="mb-3">Job description</h4>
                        <p>{!! $listing->description !!}</p>
                        <h4 class="mb-3">Roles and Responsibilities</h4>
                        {!! $listing->roles !!}
                    </div>

                    <p class="card-text mt-4">Application closing date:  {{ $listing->application_close_date }}</p>

                    @if(auth()->user()->resume)
                        <form action="{{ route('submit.post.resume', $listing->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary mt-3">Apply now</button>
                        </form>
                    @else
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Apply Now
                        </button>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!-- Job Detail End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Upload Resume</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update.post.resume') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="file" class="form-control" name="resume">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.seekers.links')
</body>

</html>
