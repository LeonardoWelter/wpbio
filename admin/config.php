<?php ?>
<div class="wrap">
	<div class="card w-75 mt-5 text-center mx-auto">
		<div class="card-body p-5">
			<h5 class="card-title">Configurações</h5>
			<form method="post" action="options.php" class="lwbio_form">
				<?php settings_fields('lwbio'); ?>
				<?php do_settings_sections('lwbio'); ?>
				<div class="mb-3 mt-3">
					<label class="form-label" for="lwbio_logo">URL do Logotipo</label>
					<input class="form-control" type="text" name="lwbio_logo" id="lwbio_logo" placeholder="Insira a URL" value="<?php echo esc_attr(get_option('lwbio_logo')); ?>">
				</div>
				<div class="mb-3 mt-3">
					<label class="form-label" for="lwbio_channel_text">Texto Redes Sociais</label>
					<input class="form-control" type="text" name="lwbio_channel_text" id="lwbio_channel_text" placeholder="Insira o texto" value="<?php echo esc_attr(get_option('lwbio_channel_text')); ?>">
				</div>
				<button type="submit" class="btn btn-primary">Salvar configurações</button>
			</form>
		</div>
	</div>
</div>