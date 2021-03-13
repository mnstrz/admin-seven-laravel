<!DOCTYPE html>
<html>
<head>
	<title>{{ (isset($title)) ? $title.' - ' : '' }} {{ (AdminSeven::appConfig()->app_name) ? AdminSeven::appConfig()->app_name : config('app.name') }}</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ \Storage::url(AdminSeven::appConfig()->favicon) }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/simplemde/simplemde.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/highlight/highlight.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    @livewireStyles
    @stack('css')
</head>
<body>
	@yield('content')
	<script type="text/javascript" src="{{ asset('frontend/js/jquery-3.5.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/plugins/highlight/highlight.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/plugins/simplemde/simplemde.js') }}"></script>
	<script type="text/javascript">
		let base_url = '{{ url('/') }}'
		let csrf_token = '{{ csrf_token() }}'
	</script>
	<script type="text/javascript" src="{{ asset('frontend/js/admin-seven.js') }}"></script>
	@livewireScripts
	@stack('js')
</body>
</html>