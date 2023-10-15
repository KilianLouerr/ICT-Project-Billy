<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>@yield('title', 'custom auth laravel')</title>

  	<!-- STYLES -->
  	<link rel="stylesheet" href="{{asset('css/screen.css')}}">
  	<link rel="stylesheet" href="{{asset('css/navbar.css')}}">
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
  	@yield('head')
</head>

<body>
	@include('include.header')
	<div class="container">
    @yield('content')
  	</div>

  	<!-- SCRIPTS -->
  	<script src="/js/jquery-3.7.0.min.js"></script>
  	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
  	<script>
    let table = new DataTable('#data-table', {
      	"lengthMenu": [5, 10, 25],
      	"language": {
        	url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/nl-NL.json',
    	},
    });
	</script>
</body>

</html>
