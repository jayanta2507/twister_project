<!DOCTYPE html>
<html>
<head>
	<title>Project Form</title>
</head>
<body>
	<center>
	<h2>Project Form</h2>
   <form  action="save-data" method="post">
      @csrf
   	<tr>
   		<td>Title</td>
   		<td><input type="text" name="title"></td><br><br><br>
   		
   		<br>
   		<button type="submit">submit</button>
   	</tr>
   </form>
</center>
</body>
</html>