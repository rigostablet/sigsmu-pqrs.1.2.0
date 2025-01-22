@extends('layouts.info')
@section('content')
<div class="container my-4">
	<div class="jumbotron text-center">
		<h3>Ponte en contacto...</h3>
	</div>
	<div style="margin:40px 0">
		<div class="row">
			<div class="col-sm-5">
				<div class="panel-body panel">
					<h4>Contactate por via email</h4>
					<hr />
					<form method="post" action="<?php print_link("info/contact"); ?>">
						@csrf
						<div class="form-group">
							<input type="text" class="form-control" required id="name" name="name" placeholder="Enter Your name *">
						</div>
						<div class="form-group">
							<input type="email" class="form-control" required id="email" name="email" placeholder="Enter Your email *">
						</div>
						<div class="form-group">
							<textarea class="form-control" id="message" name="message" rows="4" required placeholder="Enter your Message *"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">enviar</button>
					</form>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection