@extends('layout.admin.main')
@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mt-5">
                @include('message')
                <h1 style="color: #212429;">{{$listings->title}}</h1>
            </div>
            @foreach($listings->users as $user)
                <div class="card mt-5" style="background-color: {{ ($user->pivot->accepted==1 || $user->pivot->reject==1) ? ($user->pivot->accepted ? '#0da574' : '#7f181b') : 'white' }}">
                    <div class="row g-0">
                        <div class="col-auto">
                            <img src="{{Storage::url($user->profile_pic)}}" style="width: 150px; border-radius: 50%;" alt="Profile Picture">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                <p class="fw-bold" style="color: #212429;">{{$user->name}}</p>
                                <p class="card-text" style="color: #212429;">{{$user->email}}</p>
                                <p class="card-text" style="color: #212429;">{{$user->pivot->created_at}}</p>
                            </div>
                        </div>
                        <div class="col-auto align-self-center">
                            <a href="{{Storage::url($user->resume)}}" class="btn btn-primary" target="_blank">Download Resume</a><br><br>
                            <form action="{{ route('Accepted.application', [$listings->id, $user->id]) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="{{$user->pivot->accepted ? 'btn btn-dark' : 'btn btn-danger'}}">Accepted</button>
                            </form>
                            <form action="{{ route('Reject.application', [$listings->id, $user->id]) }}" method="post" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="{{$user->pivot->accepted ? 'btn btn-danger' : 'btn btn-dark'}}">Reject</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
