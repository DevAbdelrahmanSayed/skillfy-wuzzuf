@extends('layout.admin.main')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Jop posts
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>created on</th>
                            <th>Total application</th>
                            <th>View jop</th>
                            <th>View application</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($listings as $listing)
                            <tr>
                                <td>{{$listing->title}}</td>
                                <td>{{$listing->created_at->format('Y-m-d')}}</td>
                                <td>{{$listing->users_count}}</td>
                                <td>View</td>
                                <td><a href="{{route('show.application',$listing->slug)}}">View</a></td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

@endsection
