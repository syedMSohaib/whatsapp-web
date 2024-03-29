<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/4.6.0/css/bootstrap.min.css') }}">

        <style>
            .loading-indicator:before{content:'';background:#000000cc;position:fixed;width:100%;height:100%;top:0;left:0;z-index:10000000000}.loading-indicator:after{content:'Loading ...';position:fixed;width:100%;top:50%;left:0;z-index:10001;color:#fff;text-align:center;font-weight:700;font-size:1.5rem}.approve .dg-content:before{background:url("{{asset('/images/add-cat-popup.png')}}") no-repeat center !important}.reject .dg-content:before{background:url("{{asset('/images/block.png')}}") no-repeat center !important}.dg-content:before{background:url("{{asset('/images/block.png')}}") no-repeat center !important;}
        </style>

        @yield('styles')

        <script>
			window.Laravel = {!! json_encode([
                'baseurl' => url('/'),
                'csrfToken' => csrf_token(),
                'pusherKey' => config('broadcasting.connections.pusher.key'),
                'pusherCluster' => config('broadcasting.connections.pusher.options.cluster')
            ]) !!};
        </script>
    </head>
    <body>
        {{-- <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('conversations.index') }}">Conversations</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </li>
                </ul>
            </div>
        </nav> --}}

        <div class="container-fluid p-0">
            @yield('content')
        </div>

        <script src="{{ asset('assets/vendor/jquery/3.5.1/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/4.6.0/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        @yield('scripts')
    </body>
</html>
