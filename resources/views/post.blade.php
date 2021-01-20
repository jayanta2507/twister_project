<!DOCTYPE html>
<html>
<head>
	<title>Post Table</title>
</head>
<body>
	<form action="" method="">
		     
        <tbody>
                
              <tr>
               
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone}}</td>
                  <td>

                   <!-- <input type="button" name="" onclick="statusChange(1)" onc> -->
                    
                 
                  </td>
                   <td><a href="{{route('user',$user->id)}}"><button class="btn btn-primary btn-block">Edit</button></a></td>
                  <td>{{$user->created_at}}</td>
                  <td>{{$user->updated_at}}</td>
                 

              </tr>
                
       </tbody>
   </form>

</body>
</html>