<?php ?>
<div class="wrap mx-auto w-75">
	<h1 class="text-center mb-2 d-block">Adicionar novo botão</h1>
	<p style="text-align: center;">Alterne entre as abas para selecionar o tipo do botão!</p>

	<ul class="nav nav-tabs nav-justified mt-5" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<button class="nav-link active" id="link-tab" data-bs-toggle="tab" data-bs-target="#link" type="button" role="tab" aria-controls="link" aria-selected="true">Links</button>
		</li>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="channel-tab" data-bs-toggle="tab" data-bs-target="#channel" type="button" role="tab" aria-controls="channel" aria-selected="false">Redes</button>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="link" role="tabpanel" aria-labelledby="link-tab">
			<h5 class="fs-5 text-center mt-5">Adicionar link</h5>
			<form action="<?php echo admin_url('admin-post.php') ?>" method="post" class="w-50 mx-auto mt-2">
				<input type="hidden" name="action" value="link_store">
				<input type="hidden" name="data" value="link">
				<input type="hidden" name="lwbio_type" value="0">
				<input type="hidden" name="lwbio_service" value="link">
				<div class="mb-3">
					<label for="lwbio_text" class="form-label">Texto do botão</label>
					<input type="text" class="form-control" name="lwbio_text" id="lwbio_text" placeholder="Digite o texto">
				</div>
				<div class="mb-3">
					<label for="lwbio_url" class="form-label">Link do botão</label>
					<input type="url" class="form-control" name="lwbio_url" id="lwbio_url" placeholder="https://...">
				</div>
				<div class="mb-3 text-center">
					<button type="submit" class="btn btn-primary">Adicionar Link</button>
				</div>
			</form>
		</div>
		<div class="tab-pane fade" id="channel" role="tabpanel" aria-labelledby="channel-tab">
			<h5 class="fs-5 text-center mt-5">Adicionar rede social</h5>
			<form action="<?php echo admin_url('admin-post.php') ?>" method="post" class="w-50 mx-auto mt-2">
				<input type="hidden" name="action" value="channel_store">
				<input type="hidden" name="data" value="link">
				<input type="hidden" name="lwbio_type" value="1">
				<input type="hidden" name="lwbio_text" value="channel">
				<div class="mb-3">
					<label class="form-label" for="service">Rede social</label>
					<select class="form-select" style="min-width: 100%;" name="lwbio_service" id="service">
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
				</div>
				<div class="mb-3">
					<label for="lwbio_url" class="form-label">Link da Rede Social</label>
					<input type="url" class="form-control" name="lwbio_url" id="lwbio_url" placeholder="https://...">
				</div>
				<div class="mb-3 text-center">
					<button type="submit" class="btn btn-primary">Adicionar Rede Social</button>
				</div>
			</form>
		</div>
	</div>
</div>