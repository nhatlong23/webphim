
@section('sidebar')
    @if (Auth::check())
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                    <a href="{{ url('/home') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                @php
                    $segment = Request::segment(1);
                @endphp
                <li class="treeview {{ $segment == 'category' ? 'active' : '' }} ">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>Danh mục phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('category.index') }}"><i class="fa fa-angle-right"></i>
                                Liệt kê danh mục
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('category.create') }}"><i class="fa fa-angle-right"></i>
                                Thêm danh mục
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ $segment == 'genre' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-industry"></i>
                        <span>Thể loại phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('genre.index') }}"><i class="fa fa-angle-right"></i>
                                Liệt kê thể loại
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('genre.create') }}"><i class="fa fa-angle-right"></i>
                                Thêm thể loại
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ $segment == 'country' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-globe"></i>
                        <span>Quốc gia phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('country.index') }}"><i class="fa fa-angle-right"></i>
                                Liệt kê quốc gia
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('country.create') }}"><i class="fa fa-angle-right"></i>
                                Thêm quốc gia
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="treeview {{ in_array($segment, ['movie', 'episode']) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-film"></i>
                        <span>Phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('movie.index') }}"><i class="fa fa-angle-right"></i>
                                Liệt kê Phim
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('movie.create') }}"><i class="fa fa-angle-right"></i>
                                Thêm Phim
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('episode.create') }}"><i class="fa fa-angle-right"></i>
                                Thêm tập Phim
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('episode.index') }}"><i class="fa fa-angle-right"></i>
                                Liệt kê Tập Phim
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ $segment == 'linkmovie' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-link"></i>
                        <span>Server phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('linkmovie.index') }}"><i class="fa fa-angle-right"></i>
                                Liệt kê Server
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('linkmovie.create') }}"><i class="fa fa-angle-right"></i>
                                Thêm Server phim
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="treeview {{ $segment == 'info' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-info"></i>
                        <span>Website phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('info.create') }}"><i class="fa fa-angle-right"></i>
                                Thông tin website Phim
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-envelope"></i> <span>Mailbox </span>
                        <i class="fa fa-angle-left pull-right"></i><small
                            class="label pull-right label-info1">08</small><span
                            class="label label-primary1 pull-right">02</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="inbox.html"><i class="fa fa-angle-right"></i> Mail Inbox
                            </a>
                        </li>
                        <li>
                            <a href="compose.html"><i class="fa fa-angle-right"></i> Compose Mail
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    @endif
@endsection
