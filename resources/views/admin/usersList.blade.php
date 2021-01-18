@extends('layouts/menu')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<table class="table">
  <thead>
   
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Verification Status</th>
      <th scope="col">Phone Number</th>
    </tr>
  </thead>

  <tbody>

  @foreach ($site_users as $key => $site_user ) 
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$site_user['name']}}</td>
      <td>{{$site_user['email']}}</td>
      <td>
        <select id="mySelect" onchange="myFunction()" >
          <option <?php echo ($site_user->email_verified_status==1)?"selected ='selected'":""; ?>>Active
         </option>
         <option  <?php echo ($site_user->email_verified_status==0)?"selected ='selected'":""; ?>>Inactive
         </option>
       </select>
     </td>
       <td>{{$site_user['phone']}}</td>
    @endforeach
  </tr>
  </tbody>

</div>

</table>


</div>
<script >

function myFunction() {
  var x = document.getElementById("mySelect").value;
  document.getElementById("demo").innerHTML = "You selected: " + x;
}
</script>
</body>
</html>

@endsection
