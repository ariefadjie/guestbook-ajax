<!DOCTYPE html>
<html>
<head>
	<meta name="token" content="{{csrf_token()}}">
	<title>Guestbook AJAX</title>
	<link rel="stylesheet" type="text/css" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h1>Guestbook AJAX</h1>
	<form method="POST">
		<div class="form-group">
			<label for="name">Name :</label>
			<input type="text" name="name" class="form-control" id="name">
		</div>
		<div class="form-group">
			<label for="message">Message :</label>
			<textarea name="message" class="form-control" id="message"></textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-default" id="submit">Send Message</button>
		</div>
	</form>
	<hr>
	<div id="ajaxResponse"></div>
</div>
<script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $("meta[name='token']").attr('content')
			}
		});
		$.ajax({
			url: '/api/guestbooks',
			method: 'GET',
			data: {},
			success: function(data){
				$.each(data, function(i, obj){
					$('#ajaxResponse').prepend("<article><h3>"+obj.name+"</h3><div id='body'>"+obj.message+"</div></article>");
				});
			}
		});
		$('#submit').click(function(e){
			e.preventDefault();
			var name	= $('#name').val(),
				message	= $('#message').val();
				$('#ajaxResponse').prepend("<article><h3>"+name+"</h3><div id='body'>"+message+"</div></article>");
				$.ajax({
					url: '/api/guestbooks',
					method: 'POST',
					data: {
						name: name,
						message: message,
					}
				});
				$('#name').val('');
				$('#message').val('');
		});
	});
</script>
</body>
</html>
