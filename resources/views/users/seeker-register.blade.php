
@include('layout.seekers.header')
<body>
<div class="container-xxl bg-white p-0">

    <!-- Navbar Start -->
    @include('layout.seekers.nav')
    <!-- Navbar End -->
    <div class="row">
        <div class="col-md-6">
            <h1>Looking for a job?</h1>
            <h3>Please create an account</h3>
            <img src="{{asset('image/jop.png')}}" width="580" class="img-fluid" alt="Job Portal Image">
        </div>

        <div class="col-md-6 mt-5 mb-5">
            <div class="card" id="card" style="margin-top:50px;">
                <div class="card-header">Register Seeker</div>
                <form action="{{route('seeker.store')}}" method="POST" id="registrationForm">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Full name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}" required>
                            @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" value="{{old('email')}}"  required>
                            @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" required>
                            @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">password_confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password')}}</span>
                            @endif
                        </div>
                        <br>
                        <div class="form-group mb-5 mt-3">
                            <button class="btn btn-dark" id="btnRegister">Register</button>
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
