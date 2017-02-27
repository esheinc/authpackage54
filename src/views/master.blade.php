<!DOCTYPE html>
<html lang="en">
<head>
 @include('AuthView::fragments.head')
 @yield('head-addon')
</head>
<body id="app-layout">
    @yield('content')
	
    @include('AuthView::fragments.scripts')
    @yield('scripts-addon')
</body>
</html>