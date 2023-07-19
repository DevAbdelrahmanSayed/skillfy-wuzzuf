
@include('layout.seekers.header')
<body>
<div class="container-xxl bg-white p-0">

    <!-- Navbar Start -->
    @include('layout.seekers.nav')
    <!-- Navbar End -->
        <div class="row">
            <div class="col-md-6">
                <h1>Welcome back?</h1>
                <h3>Please log in to your account</h3>
                <img src="{{ asset('image/login.png') }}"  width="580" class="img-fluid" alt="Job Portal Image">
            </div>
            <div class="col-md-6 mt-5 mb-5">
                @include('message')
                <div class="card shadow" id="card" style="margin-top: 50px;">
                    <div class="card-header">Login</div>
                    <form action="{{route('login.create') }}" method="POST" id="registrationForm">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group mb-5 mt-3 text-center">
                                <button class="btn btn-dark" id="btnRegister" type="submit">L o g i n</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@include('layout.seekers.links')
</body>

</html>

