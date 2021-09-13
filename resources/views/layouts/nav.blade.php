<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Home
                        
                    </p>
                </a>
            </li>


               @if(Auth::user()->level == "admin")
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Master
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('student.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Peserta</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('course.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pelajaran</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif



        @if(Auth::user()->level == "pengajar")
        <li class="nav-item">
            <a href="{{ route('module') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Materi
                    
                </p>
            </a>
        </li>

        @endif

        <li class="nav-item">
            <form action="{{ route('logout') }}" method="post" id="logout">
                @csrf
                <a class="nav-link" href="#" onclick="document.getElementById('logout').submit()">
                    <i class="nav-icon fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </li>
    </ul>
</nav>