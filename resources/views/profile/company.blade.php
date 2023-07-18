@extends('layout.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col">
                <div class="hero-section" style="background-color:#f5f5f5;width:100%;height:200px;">
                    <!-- <img src="" style="width: 100%; height:250px;"> -->
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <img src="{{Storage::url($profileCompany->profile_pic)}}" alt="Company Logo" class="img-fluid">
                <h2>{{$profileCompany->name}}</h2>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <h3>About</h3>
                <p>{{$profileCompany->about}}</p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-8">
                <h3>List of Jobs</h3>
                @foreach($profileCompany->companys as $company)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$company->title}}</h5>
                        <p class="card-text">Location: {{$company->address}} </p>
                        <p class="card-text">Salary: {{number_format($company->salary,2)}}</p>
                        <a href="{{route('show.jobs',[$company->slug])}}" class="btn btn-dark">View</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
