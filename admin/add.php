<?php ?>
<div class="wrap">
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
	<div class="lwbio_form_type">
			<label for="lwbio_type">Tipo</label>
			<select name="type" id="lwbio_type" required>
				<!-- <option value="0" selected disabled>Selecione o tipo</option> -->
				<option value="link" selected>Link</option>
				<option value="channel">Rede Social</option>
			</select>
	</div>

		<div id="lwbio_form_link" class="lwbio_form_card">
			<form action="<?php echo admin_url('admin-post.php') ?>" method="post" class="lwbio_form">
				<input type="hidden" name="action" value="store_link">
				<input type="hidden" name="data" value="link">
				<input type="hidden" name="lwbio_type" value="0">
				<input type="hidden" name="lwbio_service" value="link">
				<label for="text">Texto do botão</label>
				<input type="text" name="lwbio_text" id="text" placeholder="Digite o texto">
				<label for="url">Link do botão</label>
				<input type="url" name="lwbio_url" id="url" placeholder="Digite o link">
				<button type="submit" class="lwbio_button_submit">Adicionar Link</button>
			</form>
		</div>
		<div id="lwbio_form_channel" class="lwbio_form_card" hidden>
			<form action="<?php echo admin_url('admin-post.php') ?>" method="post" class="lwbio_form">
				<input type="hidden" name="action" value="store_link">
				<input type="hidden" name="data" value="link">
				<input type="hidden" name="lwbio_type" value="1">
				<input type="hidden" name="lwbio_text" value="channel">
				<label for="service">Rede social</label>
				<select name="lwbio_service" id="service">
					<option disabled selected>Selecione a Rede Social</option>
					<option value="facebook">Facebook</option>
					<option value="instagram">Instagram</option>
					<option value="youtube">Youtube</option>
					<option value="twitter">Twitter</option>
					<option value="linkedin">Linkedin</option>
					<option value="github">Github</option>
					<option value="tiktok">Tiktok</option>
					<option value="wordpress">Wordpress</option>
					<option value="outro">Outro</option>
				</select>
				<label for="url">Link da Rede Social</label>
				<input type="url" name="lwbio_url" id="url" placeholder="Digite o link">
				<button type="submit" class="lwbio_button_submit">Adicionar Rede Social</button>
			</form>
		</div>
		<script src="<?= plugins_url('/includes/js/lwbio_form.js', __FILE__) ?>"></script>
</div>