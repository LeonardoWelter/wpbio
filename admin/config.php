<?php ?>
<div class="wrap">
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
	<div id="lwbio_form_link" class="lwbio_form_card">
		<form method="post" action="options.php" class="lwbio_form">
			<?php settings_fields( 'lwbio' ); ?>
    		<?php do_settings_sections( 'lwbio' ); ?>
			<label for="text">URL do Logotipo</label>
			<input type="text" name="lwbio_logo" id="url" placeholder="Insira a URL" value="<?php echo esc_attr( get_option('lwbio_logo') ); ?>">
			<button type="submit" class="lwbio_button_submit">Salvar configurações</button>
		</form>
	</div>
</div>