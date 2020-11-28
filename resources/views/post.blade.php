<!DOCTYPE html>
<html>
<head>
	<title>Post Table</title>
</head>
<body>
	<form action="post-data" method="post">
		@csrf
		<tr>
		<td>Name</td>
		<td><input type="text" name="name"></td>
		<button>submit</button>
        </tr>
	</form>

</body>
</html>