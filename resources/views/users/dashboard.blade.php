@extends('layout.admin.main')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            @include('message')
            <div class="container-fluid px-4">
                <h1 class="mt-4">Welcome to Skillify</h1>
                <ol class="breadcrumb mb-4">
                    Hello, {{auth()->user()->name}}
                    @if (!auth()->user()->billing_ends)
                        @if (Auth::check() && auth()->user()->user_type == 'employer')
                            <p>Your trial {{ now()->format('Y-m-d') > auth()->user()->user_trial ? 'has expired' : 'will expire' }}
                                on {{ auth()->user()->user_trial }}</p>
                        @endif
                    @endif

                    @if (Auth::check() && auth()->user()->user_type == 'employer' && auth()->user()->billing_ends)
                        <p>Your trial {{ now()->format('Y-m-d') > auth()->user()->user_trial ? 'has expired' : 'will expire' }}
                            on {{ auth()->user()->user_trial }}</p>
                    @endif
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Total jobs ({{App\Models\Listing::where('user_id',auth()->user()->id)->count()}})</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="/jop">View</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">Profile</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="/profile">View</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Plan ({{App\Models\User::where('id',auth()->user()->id)->first()->plan}})</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="/subscribe">View</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>

                </div>
                <br> <br>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Area Chart Example
                            </div>
                            <div class="card-body">
                                <canvas id="myAreaChart" width="100%" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Bar Chart Example
                            </div>
                            <div class="card-body">
                                <canvas id="myBarChart" width="100%" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
