@extends('layout.admin.main')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <h1>Post a job</h1>
            <form action="{{ route('jop.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="feature_photo">Feature Image</label>
                    <input type="file" name="feature_photo" id="feature_photo" class="form-control">
                    @error('feature_photo')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                    @error('title')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control summernote"></textarea>
                    @error('description')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="roles">Roles and Responsibility</label>
                    <textarea name="roles" id="roles" class="form-control summernote"></textarea>
                    @error('roles')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Job types</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="job_type" id="Fulltime" value="Fulltime">
                        <label for="Fulltime" class="form-check-label">Fulltime</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="job_type" id="Parttime" value="Parttime">
                        <label for="Parttime" class="form-check-label">Parttime</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="job_type" id="casual" value="Casual">
                        <label for="casual" class="form-check-label">Remote</label>
                    </div>

                    @error('job_type')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control">
                    @error('address')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="salary">Salary</label>
                    <input type="text" name="salary" id="salary" class="form-control">
                    @error('salary')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="application_close_date">Application closing date</label>
                    <input type="text" name="application_close_date" id="application_close_date" class="form-control">
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
