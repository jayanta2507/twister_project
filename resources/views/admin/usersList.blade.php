@extends('layouts/mainPage')
@section('content')
<section class="content">
<div class="container-fluid">
<!-- Small boxes (Stat box) -->



     
<section class="content">
<div class="container-fluid">
<div class="row">
  <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>


  <!-- testing script -->

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<div class="col-xs-12">
  <center>
    <div class="card-body table-responsive p-0" style="height: 300px;">
 <table class="table table-head-fixed" border="1">
        <thead>
     
              <tr>
                 <th>Id</th>
                 <th>Name</th>
                 <th>Email</th>
                 <th>Phone</th>
                 <th>Status</th>
                 <th>Edit</th>
                 <th>Delete</th>
                 <th>Created At</th>
                 <th>Updated At</th>
                
              </tr>
       </thead>  
            
        <tbody>
                @foreach($site_users as $key => $user)
              <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone}}</td>
                  <td>

                   <!-- <input type="button" name="" onclick="statusChange(1)" onc> -->
                    
                    <input data-id="{{$user->id}}" id="id_{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" onchange="statusChange('{{$user->id}}')" {{ $user->email_verified_status ? 'checked' : '' }}>
                   <td><a href="{{route('user',$user->id)}}"><button class="btn btn-primary btn-block">Edit</button></a></td>
                   <td><a href="javascript:void(0)" onclick="deleteRow('{{$user->id}}')" class="btn btn-danger btn-block">Delete</a> </td>
                  </td>
                  <td>{{$user->created_at}}</td>
                  <td>{{$user->updated_at}}</td>
                 

              </tr>
                 @endforeach
       </tbody>
            
   </table>
 </div>
   </center>
   </div>
</div>

</div><!-- /.container-fluid -->
</section>

<script>

  function statusChange(id){
    var status = $("#id_"+id).prop('checked') == true ? 1 : 0; 
    var user_id = $(this).data('id'); 
    alert(status);
    var _token = "<?php echo csrf_token(); ?>";
    $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ url('ChangeUserStatus') }}",
            data: {_token:_token, 'status': status, 'user_id': id},
            success: function(data){
              console.log(data.success)
            }
        });  

  }
  function deleteRow(id){

    var _token = "<?php echo csrf_token(); ?>";
    var delCheck = confirm("Are You Sure You Want To Delete");

    if (delCheck) {
         $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('deleteUser') }}",
            data: {_token:_token, 'status': status, 'user_id': id},
            success: function(response){
              console.log(response.success)
              
            }
        });  
    }else{
      alert("User is safe");
    }
  }
  
</script>


</div>
</section>
@endsection