
@include('layout.seekers.header')

<body>
<div class="container-xxl bg-white p-0">


    <!-- Navbar Start -->
    @include('layout.seekers.nav')
    <!-- Navbar End -->

    <!-- ... rest of the code ... -->
    <div class="row justify-content-center">
        @include('message')
    </div>

    <div class="row justify-content-center mb-5">
        <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-md-8">
                <h2>Update your profile</h2>
                <hr>

                <div class="form-group">
                    <label for="logo" class="mb-2">Logo</label>
                    <input type="file" class="form-control" id="logo" name="profile_pic">
                    @if (auth()->user() && auth()->user()->profile_pic)
                        <img src="{{ Storage::url(auth()->user()->profile_pic) }}" class="mt-3 img-fluid rounded profile-pic" alt="Profile Picture">
                    @endif
                </div>
                <div class="form-group">
                    <label for="name" class="mb-2">Company name</label>
                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="about" class="mb-2">About</label>
                    <textarea class="form-control" name="about" rows="3">{{ auth()->user()->about ?? '' }}</textarea>
                </div>

                <div class="form-group mt-4">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row justify-content-center mb-5">
        <form action="{{ route('update.resume') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-md-8">
                <h2>Update your resume</h2>
                <hr>
                <div class="form-group">
                    <label for="resume" class="mb-2">Upload a resume</label>
                    <input type="file" name="resume" class="form-control" id="resume">
                    @error('resume')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                @if (auth()->user() && auth()->user()->resume)
                    <div class="form-group">
                        <label for="currentResume" class="mb-2">Current Resume:</label>
                        <p>{{ auth()->user()->resume }}</p>
                    </div>
                @endif

                <div class="form-group mt-4">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row justify-content-center">
        <form action="{{ route('update.password') }}" method="post">
            @csrf
            <div class="col-md-8">
                <h2>Change your password</h2>
                <hr>

                <div class="form-group">
                    <label for="current_password" class="mb-2">Your current password</label>
                    <input type="password" name="current_password" class="form-control" id="current_password">
                    @error('current_password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="mb-2">Your new password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="mb-2">Confirm password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>

                <div class="form-group mt-4">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>

</html>
<style>
    .profile-pic {
        width: 150px; /* Adjust the size of the circular image as needed */
        height: 150px;
        border-radius: 50%;
        object-fit: cover; /* This ensures the image fills the circular container */
    }
</style>
