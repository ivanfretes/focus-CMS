<form method="post" enctype="multipart/form-data">
	
	<label for="g-title">page_title</label>
	<input <?= default_value_input($page_title); ?>
	type="text" name="g-title" id="g-title">

	<label for="g-url">page_url</label>
	<input <?= default_value_input($page_url); ?>
	type="text" name="g-url" id="g-url">

	<label for="g-portada_url">page_portada_url</label>
	<input <?= default_value_input($page_portada_url); ?>
	type="text" name="g-portada_url" id="g-portada_url">

	<label for="g-description">page_description</label>
	<input <?= default_value_input($page_description); ?>
	type="text" name="g-description" id="g-description">

	<label for="g-subtitle">page_subtitle</label>
	<input <?= default_value_input($page_subtitle); ?>
	type="text" name="g-subtitle" id="g-subtitle">

	<label for="g-status">page_status</label>
	<input <?= default_value_input($page_status); ?>
	type="text" name="g-status" id="g-status">

	<label for="g-main">page_main</label>
	<input <?= default_value_icheckbox($page_main, TRUE); ?>
	type="checkbox" name="g-main" id="g-main" >

	<input type="submit" name="g-submit" value="Guardar">

</form>