<?php
$links = BioLinks::index();
$channels = BioChannels::index();
?>
<div class="wrap">
    <h1><?= esc_html(get_admin_page_title()); ?></h1>
    <p style="text-align: center;">Precisa de ajuda sobre o plugin? Visite a <a href="https://wpbiodocs.readthedocs.io/en/latest/index.html">documentação</a> do plugin!</p>
    <div class="text-end">
        <a href="<?= admin_url('admin.php?page=lwbio_add'); ?>" class="btn btn-primary">Adicionar Link</a>
    </div>
    <h4 class="text-center">Links</h4>
    <table class="table table-striped">
        <tr>
            <th>Texto</th>
            <th>Link</th>
            <th>Ações</th>
        </tr>
        <?php foreach (BioDatabase::index(0) as $item) : ?>
            <tr>
                <td style="min-width: 45%; max-width: 45%;"><?= $item->text ?></td>
                <td style="min-width: 45%; max-width: 45%;"><?= $item->url ?></td>
                <td class="btn-group w-100" role='group'>
                    <div class="w-100">
                        <a href='<?= admin_url("admin.php?page=lwbio_edit&id={$item->id}") ?>' class='btn btn-primary'><i class='bi bi-pencil-square'></i></a>
                        <button class="btn btn-danger" onclick="confirmModal(<?= $item->id ?>,'remove_link')"><i class='bi bi-trash3-fill'></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h4 class="text-center mt-5">Redes Sociais</h4>
    <table class="table table-striped">
        <tr>
            <th scope="col">Serviço</th>
            <th scope="col">Link</th>
            <th scope="col">Ações</th>
        </tr>
        <?php foreach (BioDatabase::index(1) as $item) : ?>
            <tr>
                <td style="min-width: 45%; max-width: 45%;"><?= ucfirst($item->service) ?></td>
                <td style="min-width: 45%; max-width: 45%;"><?= $item->url ?></td>
                <td>
                    <a href='<?= admin_url("admin.php?page=lwbio_edit&id={$item->id}") ?>' class='btn btn-primary'><i class='bi bi-pencil-square'></i></a>
                    <button class="btn btn-danger" onclick="confirmModal(<?= $item->id ?>,'remove_link')"><i class='bi bi-trash3-fill'></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<!-- Button trigger modal -->
<button id="launchModal" type="button" data-bs-toggle="modal" data-bs-target="#confirmModal" hidden></button>

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Remover pedido?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="confirmModalBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="<?= admin_url('admin-post.php') ?>" method='post' class='d-inline'>
                    <input id="formAction" type='hidden' name='action' value=''>
                    <input id="formId" type='hidden' name='lwbio_id' value=''>
                    <input id="formBtn" type="submit" class="btn" value="Confirmar">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var js_data = '<?php echo json_encode($linksAll); ?>';
    js_data = JSON.parse(js_data);


    function confirmModal(id, action) {

        let link = js_data.find(o => o.id == id);

        type = link.type == 0 ? 'Link' : 'Rede Social';

        modalBody = document.getElementById('confirmModalBody');
        modalBody.innerHTML = `<p>Texto: <br> ${link.text}</p>
                                <p>Link: <br> ${link.url}</p>
                                <p>Tipo: <br> ${type}</p>
                                <p>Serviço:  <br> ${link.service}</p>`;

        formAction = document.getElementById('formAction');
        formAction.value = action;

        formId = document.getElementById('formId');
        formId.value = id;

        switch (action) {
            case 'remove_link':
                modalLabel = document.getElementById('confirmModalLabel');
                modalLabel.innerHTML = "Remover pedido?"

                formBtn = document.getElementById('formBtn');
                formBtn.className = 'btn btn-danger';
                formBtn.value = 'Remover';
                break;
        }

        document.getElementById('launchModal').click();

    }
</script>