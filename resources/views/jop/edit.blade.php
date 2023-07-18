@extends('layout.admin.main')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <h1>Post a job</h1>
            @include('message')
            <form action="{{route('jop.update',[$post->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="feature_photo">Feature Image</label>
                    <input type="file" name="feature_photo" id="feature_photo" class="form-control">
                    @error('feature_photo')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$post->title}}">
                    @error('title')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description"
                              class="form-control summernote">{{$post->description}}</textarea>
                    @error('description')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="roles">Roles and Responsibility</label>
                    <textarea name="roles" id="roles" class="form-control summernote"
                              value="">{{$post->roles}}</textarea>
                    @error('roles')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Job types</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="job_type" id="Fulltime" value="Fulltime"
                            {{$post->job_type === 'Fulltime'? 'checked' :''}}>
                        <label for="Fulltime" class="form-check-label">Fulltime</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="job_type" id="Parttime" value="Parttime"
                            {{$post->job_type === 'Parttime'? 'checked' :''}}>
                        <label for="Parttime" class="form-check-label">Parttime</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="job_type" id="casual" value="Casual"
                            {{$post->job_type === 'casual'? 'checked' :''}}>
                        <label for="casual" class="form-check-label">Casual</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="job_type" id="Contract" value="Contract"
                            {{$post->job_type === 'Contract'? 'checked' :''}}>
                        <label for="Contract" class="form-check-label">Contract</label>
                    </div>
                    @error('job_type')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{$post->address}}">
                    @error('address')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="salary">Salary</label>
                    <input type="text" name="salary" id="salary" class="form-control" value="{{$post->salary}}">
                    @error('salary')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="application_close_date">Application closing date</label>
                    <input type="text" name="application_close_date" id="application_close_date" class="form-control"
                           value="{{$post->application_close_date}}">
                    @error('application_close_date')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-success">Post a job</button>
                </div>
            </form>
        </div>
    </div>
    <style>
        .note-insert {
            display: none !important;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
@endsection
