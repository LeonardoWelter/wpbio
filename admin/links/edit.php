<?php
$lwbio = admin_url('admin.php?page=lwbio');
$link = BioLinks::show($_GET['id']);

if (!isset($_GET['id']) or !isset($link)) {
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
	<div class="card w-75 mt-5 text-center mx-auto">
		<div class="card-body p-5">
			<h5 class="card-title">Editando Link <?= $link->id ?></h5>
			<div id="lwbio_form_link" class="lwbio_form_card">
				<form action="<?php echo admin_url('admin-post.php') ?>" method="post" class="lwbio_form">
					<input type="hidden" name="action" value="link_update">
					<input type="hidden" name="lwbio_id" value="<?= $link->id ?>">
					<div class="mb-3">
						<label for="lwbio_text" class="form-label">Texto do botão</label>
						<input type="text" class="form-control" name="lwbio_text" id="lwbio_text" value="<?= $link->text ?>" placeholder="Digite o texto">
					</div>
					<div class="mb-3">
						<label for="lwbio_url" class="form-label">Link do botão</label>
						<input type="url" class="form-control" name="lwbio_url" id="lwbio_url" value="<?= $link->url ?>" placeholder="https://...">
					</div>
					<div class="mb-3 text-center">
						<button type="submit" class="btn btn-primary">Alterar Link</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>