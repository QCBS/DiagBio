<div style="width: 800px;">
	<div style="float: left; width: 400px;">
		<h3>Inscription:</h3>
		<a href="/administration/register\">Creation d'un compte administrateur</a>
		<br />
		<a href="/participant/register\">Creation d'un compte participant (interne à l'organisation)</a>
		<br />
		<a href="/externe/register\">Creation d'un compte d'évaluateur externe</a>
	</div>
	<div style="float: left; width: 400px;">
		<?php
		// Display Login Block For Users to Login.
		print(drupal_render(drupal_get_form('user_login_bloc'))); // Get Modfified Login Block Called at The Top of The Script.
		?>
	</div>
	<br style="clear: left;" />
</div>