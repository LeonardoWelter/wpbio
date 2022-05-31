<?php
$lwbio = admin_url('admin.php?page=lwbio');
$link = BioChannels::show($_GET['id']);

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
            <h5 class="card-title">Editando Rede Social <?= $link->id ?></h5>
            <div id="lwbio_form_channel" class="lwbio_form_card">
                <form action="<?php echo admin_url('admin-post.php') ?>" method="post" class="lwbio_form">
                    <input type="hidden" name="action" value="channel_update">
                    <input type="hidden" name="lwbio_id" value="<?= $link->id ?>">
                    <div class="mb-3">
                        <label class="form-label" for="service">Rede social</label>
                        <select class="form-select" name="lwbio_service" id="service">
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
                    </div>
                    <div class="mb-3">
                        <label for="lwbio_url" class="form-label">Link da Rede Social</label>
                        <input type="url" class="form-control" name="lwbio_url" id="lwbio_url" value="<?= $link->url ?>" placeholder="https://...">
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Alterar Rede Social</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>