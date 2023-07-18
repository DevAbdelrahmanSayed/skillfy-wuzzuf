@extends('layout.admin.main')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="card mb-4">
                @include('message')
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Jop posts
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Salary</th>
                            <th>Jop type</th>
                            <th>Created at</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($get_post as $posts)
                            <tr>
                                <td>{{$posts->title}}</td>
                                <td>{{$posts->salary}}</td>
                                <td>{{$posts->job_type}}</td>
                                <td>{{$posts->created_at->format('Y-m-d')}}</td>
                                <td><a href="{{route('jop.edit',[$posts->id])}} " class="btn btn-primary">Edit</a></td>
                                <td><a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                       data-bs-target="#exampleModal{{$posts->id}}">Delete</a></td>

                            </tr>
                            <!-- Modal -->

                            <div class="modal fade" id="exampleModal{{$posts->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="{{route('jop.destroy',[$posts->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete confirmation </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                are you sure you want to delete this post ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>


            <div/>
            <div/>
@endsection
