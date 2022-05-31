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
            <th class="text-center">Ordem</th>
            <th>Texto</th>
            <th>Link</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($links as $link) : ?>
            <tr class="align-middle">
                <td class="text-center">
                    <?php if ($link->ordem == 1) : ?>
                        <button class="btn btn-link disabled px-3 py-0">
                            <i class="d-block bi bi-caret-up-fill"></i>
                        </button>
                    <?php else : ?>
                        <button class="btn btn-link px-3 py-0" onclick="changeOrder(<?= $link->id ?>, 'link_up', 'link')">
                            <i class="d-block bi bi-caret-up-fill"></i>
                        </button>
                    <?php endif; ?>
                    <span class="d-block"><?= $link->ordem ?></span>
                    <?php if ($link->ordem == BioLinks::getMaxOrder()) : ?>
                        <button class="btn btn-link disabled px-3 py-0">
                            <i class="d-block bi bi-caret-down-fill"></i>
                        </button>
                    <?php else : ?>
                        <button class="btn btn-link px-3 py-0" onclick="changeOrder(<?= $link->id ?>, 'link_down', 'link')">
                            <i class="d-block bi bi-caret-down-fill"></i>
                        </button>
                    <?php endif; ?>
                </td>
                <td style="min-width: 40%; max-width: 40%;"><?= (strlen($link->text) > 50) ? substr($link->text, 0, 50) . '...' : $link->text ?></td>
                <td style="min-width: 40%; max-width: 40%;"><?= (strlen($link->url) > 50) ? substr($link->url, 0, 50) . '...' : $link->url ?></td>
                <td>
                    <div class="btn-group w-100" role="group">
                        <div class="w-100">
                            <a href='<?= admin_url("admin.php?page=lwbio_link_edit&id={$link->id}") ?>' class='btn btn-primary'><i class='bi bi-pencil-square'></i></a>
                            <button class="btn btn-danger" onclick="confirmModal(<?= $link->id ?>,'link_remove')"><i class='bi bi-trash3-fill'></i></button>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h4 class="text-center mt-5">Redes Sociais</h4>
    <table class="table table-striped">
        <tr>
            <th class="text-center">Ordem</th>
            <th scope="col">Serviço</th>
            <th scope="col">Link</th>
            <th scope="col">Ações</th>
        </tr>
        <?php foreach ($channels as $channel) : ?>
            <tr class="align-middle">
                <td class="text-center">
                    <?php if ($channel->ordem == 1) : ?>
                        <button class="btn btn-link disabled px-3 py-0">
                            <i class="d-block bi bi-caret-up-fill"></i>
                        </button>
                    <?php else : ?>
                        <button class="btn btn-link px-3 py-0"  onclick="changeOrder(<?= $channel->id ?>, 'channel_up', 'channel')">
                            <i class="d-block bi bi-caret-up-fill"></i>
                        </button>
                    <?php endif; ?>
                    <span class="d-block"><?= $channel->ordem ?></span>
                    <?php if ($channel->ordem == BioChannels::getMaxOrder()) : ?>
                        <button class="btn btn-link disabled px-3 py-0">
                            <i class="d-block bi bi-caret-down-fill"></i>
                        </button>
                    <?php else: ?>
                        <button class="btn btn-link px-3 py-0" onclick="changeOrder(<?= $channel->id ?>, 'channel_down', 'channel')">
                            <i class="d-block bi bi-caret-down-fill"></i>
                        </butt>
                    <?php endif; ?>
                </td>
                <td style="min-width: 40%; max-width: 40%;"><?= ucfirst($channel->service) ?></td>
                <td style="min-width: 40%; max-width: 40%;"><?= (strlen($channel->url) > 50) ? substr($channel->url, 0, 50) . '...' : $channel->url ?></td>
                <td>
                    <a href='<?= admin_url("admin.php?page=lwbio_channel_edit&id={$channel->id}") ?>' class='btn btn-primary'><i class='bi bi-pencil-square'></i></a>
                    <button class="btn btn-danger" onclick="confirmModal(<?= $channel->id ?>,'channel_remove')"><i class='bi bi-trash3-fill'></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="hidden">
    <form id="formLink" action="<?= admin_url('admin-post.php') ?>" method='post'>
        <input type='hidden' name='action' value='link_order'>
        <input id="formLinkAction" type='hidden' name='link_action' value=''>
        <input id="formLinkId" type='hidden' name='link_id' value=''>
    </form>
    <form id="formChannel" action="<?= admin_url('admin-post.php') ?>" method='post'>
        <input type='hidden' name='action' value='channel_order'>
        <input id="formChannelAction" type='hidden' name='channel_action' value=''>
        <input id="formChannelId" type='hidden' name='channel_id' value=''>
    </form>
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
    var links = '<?= json_encode($links); ?>';
    links = JSON.parse(links);

    var channels = '<?= json_encode($channels); ?>';
    channels = JSON.parse(channels);


    function confirmModal(id, action) {

        formAction = document.getElementById('formAction');
        formAction.value = action;

        formId = document.getElementById('formId');
        formId.value = id;

        switch (action) {
            case 'link_remove':
                let link = links.find(o => o.id == id);

                modalLabel = document.getElementById('confirmModalLabel');
                modalLabel.innerHTML = "Remover Link?";

                modalBody = document.getElementById('confirmModalBody');
                modalBody.innerHTML = `<p>Ordem: <br> ${link.ordem}</p>
                                <p>Texto: <br> ${link.text}</p>
                                <p>Link: <br> ${link.url}</p>`;

                formBtn = document.getElementById('formBtn');
                formBtn.className = 'btn btn-danger';
                formBtn.value = 'Remover';
                break;
            case 'channel_remove':
                let channel = channels.find(o => o.id == id);

                modalLabel = document.getElementById('confirmModalLabel');
                modalLabel.innerHTML = "Remover Rede Social?"

                modalBody = document.getElementById('confirmModalBody');
                modalBody.innerHTML = `<p>Ordem: <br> ${channel.ordem}</p>
                                <p>Link: <br> ${channel.url}</p>
                                <p>Serviço:  <br> ${channel.service}</p>`;

                formBtn = document.getElementById('formBtn');
                formBtn.className = 'btn btn-danger';
                formBtn.value = 'Remover';
                break;
        }


        document.getElementById('launchModal').click();

    }

    function changeOrder(id, action, type) {
        if (type == 'link') {
            formLinkAction = document.getElementById('formLinkAction');
            formLinkAction.value = action;

            formLinkId = document.getElementById('formLinkId');
            formLinkId.value = id;

            formLink = document.getElementById('formLink');
            formLink.submit();
        } else if (type == 'channel') {
            formChannelAction = document.getElementById('formChannelAction');
            formChannelAction.value = action;

            formChannelId = document.getElementById('formChannelId');
            formChannelId.value = id;

            formChannel = document.getElementById('formChannel');
            formChannel.submit();
        }
    }
</script>