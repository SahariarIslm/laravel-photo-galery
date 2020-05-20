<!DOCTYPE html>
<html>
<head>
	<title>PhotoShow</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.6.3/css/foundation.min.css">
</head>
<body>
	@include('inc.topbar')
	<br>
	<div class="grid-container">
		@include('inc.messages')
		@yield('content')
	</div>
</body>
</html>