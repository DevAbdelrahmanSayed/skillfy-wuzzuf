<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ route('create.jobs') }}" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <h1 class="m-0 text-primary">Skillify</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ms-auto p-4 p-lg-0">
            <li class="nav-item">
                <a href="{{ route('create.jobs') }}" class="nav-link">Explore</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('show.applied') }}" class="nav-link">Application</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Saved</a>
            </li>
            <li class="nav-item">
                <a href="contact.html" class="nav-link">Contact</a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    @if(!auth()->user()->profile_pic || Storage::exists(auth()->user()->profile_pic))
                        <img src="{{ asset('image/profilephoto.png') }}" class="rounded-circle" width="55" height="30">
                    @else
                        <img src="{{ Storage::url(auth()->user()->profile_pic) }}" class="rounded-circle" width="50" height="50">
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end rounded-0 m-0">
                    <a href="{{ route('create.seeker.profile')}}" class="dropdown-item">profile</a>
                    <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                </div>
            </li>

        </ul>

    </div>
</nav>
<!-- Navbar End -->
