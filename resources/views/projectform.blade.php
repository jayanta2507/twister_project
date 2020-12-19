<!DOCTYPE html>
<html>
<head>
	<title>Project Form</title>
</head>
<body>
	<center>
	<h2>Project Form</h2>
   <form action="{{route('saveData')}}" method="post">
      @csrf
   	<tr>
   		<td>Name</td>
   		<td><input type="text" name="name"></td><br><br><br>
            <td>Description</td>
         <td><input type="text" name="descr"></td><br><br><br>
         
   		
   		<br>
   		<button type="submit">submit</button>
   	</tr>
   </form>
</center>
</body>
</html>