<footer class="footer border-top">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<div class="copyright">&copy; <?php echo date('Y'); ?>
					{{ config("app.name") }}. Todos los derechos reservados </div>
			</div>
			<div class="col">
				<div class="footer-links text-right">
					
					<a href="{{ url('info/about') }}">Contacto</a> | 
					<!--
					<a href="{{ url('info/faq') }}">Ayuda y preguntas frecuentes</a> |
					<a href="{{ url('info/contact') }}">Contáctenos</a>  |
					<a href="{{ url('info/privacypolicy') }}">Política de privacidad</a> |
					<a href="{{ url('info/termsandconditions') }}">Términos y Condiciones</a>
					-->
				</div>
			</div>
			
		</div>
	</div>
</footer>