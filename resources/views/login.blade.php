<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-5">
				@if (isset($errors))
					<?php print_r($errors);?>
				@endif
					<form action="{{route('user.login')}}" method="POST" id="login">
						<input type="text" name="email" id="inputEmail" class="form-control" value="" title="">		
						
						<br/>
						<input type="password" name="password" id="inputPassword" class="form-control"title="">
						
					
						<input type="submit" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
		

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		$(function(){
			// $( "#login" ).on('submit',function( event ) {    
			//   event.preventDefault();
			//   $('.error').empty();
			//   var url = $(this).attr( "action" );     
			//   $.ajax({url: url,type: 'POST',data: new FormData(this),cache: false,dataType: 'json',processData: false,contentType: false,success: function(data) {
			//       alert("Success!", "Leads Assigned Successfully!", "success");
			//     },
			//     error: function(data)
			//     {
			//       $.each(data.responseJSON,function(key,value){
			//         $('#'+key+'_error').html(value);            
			//       });
			//     }
			//   });     
			// });
		});
		</script>
	</body>
</html>