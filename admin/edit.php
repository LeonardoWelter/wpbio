<?php
	$lwbio = admin_url('admin.php?page=lwbio');
	$link = LW_DB::show($_GET['id']);

	if(!isset($_GET['id']) OR !isset($link)) {
		echo "<script type='text/javascript'>
				window.location.href = '{$lwbio}'
			</script>";
		echo "<h1>Ative o JavaScript</h1>";
	};

	if (!isset($link)) {
		exit();
	}
?>
<div class="wrap">
	<h1>Editando Link <?= $link->id ?></h1>

		<?php if ($link->type == 0) : ?>

		<div id="lwbio_form_link" class="lwbio_form_card">
			<form action="<?php echo admin_url('admin-post.php') ?>" method="post" class="lwbio_form">
				<input type="hidden" name="action" value="update_link">
				<input type="hidden" name="data" value="link">
				<input type="hidden" name="lwbio_type" value="0">
				<input type="hidden" name="lwbio_service" value="link">
				<input type="hidden" name="lwbio_id" value=<?= $link->id ?>>
				<label for="text">Texto do botão</label>
				<input type="text" name="lwbio_text" id="text" placeholder="Digite o texto" value="<?= $link->text ?>">
				<label for="url">Link do botão</label>
				<input type="url" name="lwbio_url" id="url" placeholder="Digite o link" value="<?= $link->url ?>">
				<button type="submit" class="lwbio_button_submit">Alterar Link</button>
			</form>
		</div>
		<?php elseif ($link->type == 1) : ?>
		<div id="lwbio_form_channel" class="lwbio_form_card">
			<form action="<?php echo admin_url('admin-post.php') ?>" method="post" class="lwbio_form">
				<input type="hidden" name="action" value="update_link">
				<input type="hidden" name="data" value="link">
				<input type="hidden" name="lwbio_type" value="1">
				<input type="hidden" name="lwbio_text" value="channel">
				<input type="hidden" name="lwbio_id" value=<?= $link->id ?>>
				<label for="service">Rede social</label>
				<select name="lwbio_service" id="service">
					<option disabled>Selecione a Rede Social</option>
					<option value="facebook" <?= $link->service == 'facebook' ? 'selected' : '' ?>>Facebook</option>
					<option value="instagram" <?= $link->service == 'instagram' ? 'selected' : '' ?>>Instagram</option>
					<option value="youtube" <?= $link->service == 'youtube' ? 'selected' : '' ?>>Youtube</option>
					<option value="twitter" <?= $link->service == 'twitter' ? 'selected' : '' ?>>Twitter</option>
					<option value="linkedin" <?= $link->service == 'linkedin' ? 'selected' : '' ?>>Linkedin</option>
					<option value="github" <?= $link->service == 'github' ? 'selected' : '' ?>>Github</option>
					<option value="tiktok" <?= $link->service == 'tiktok' ? 'selected' : '' ?>>Tiktok</option>
					<option value="wordpress" <?= $link->service == 'wordpress' ? 'selected' : '' ?>>Wordpress</option>
					<option value="outro" <?= $link->service == 'outro' ? 'selected' : '' ?>>Outro</option>
				</select>
				<label for="url">Link da Rede Social</label>
				<input type="url" name="lwbio_url" id="url" placeholder="Digite o link" value="<?= $link->url ?>">
				<button type="submit" class="lwbio_button_submit">Alterar Rede Social</button>
			</form>
		</div>
		<?php endif; ?>
</div>