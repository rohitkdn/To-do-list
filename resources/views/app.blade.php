<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet"
          href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">

    <style>
        .task-show {
            display: inline;
        }
        .task-update {
            display: none;
        }

        .editing .task-show {
            display: none;
        }

        .editing .task-update {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="navbar navbar-dark bg-inverse">
    <div class="container">

        <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2">
            &#9776;
        </button>
        <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
            <a href="#" class="navbar-brand">
                TODO List
            </a>

            @if(Auth::check())
                <ul class="nav navbar-nav pull-right">
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="#">({{Auth::user()->username}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</div>
<br>
<div class="container">
    @yield('body')
</div>
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('js/tether.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
<script>
    $(function () {
        $('button.task-update-btn').click(function (e) {
            e.preventDefault();
            $(this).parent().parent().parent().toggleClass('editing');
        })
    });
</script>
</body>
</html>
