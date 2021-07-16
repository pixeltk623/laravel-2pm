<?php 
	
	#echo "<pre>";

	#print_r($listOfName);
	#var_dump($listOfName);

	#dd($listOfName);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<h1>Hello This is Kumar</h1>

	{{-- {!! $listOfName !!} --}}

	{{ $listOfName['name'] }}
	{{ $listOfName['email'] }}

</body>
</html>