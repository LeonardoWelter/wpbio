<?php ?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <p style="text-align: center;">Precisa de ajuda sobre o plugin? Visite a <a href="https://wpbiodocs.readthedocs.io/en/latest/index.html">documentação</a> do plugin!</p>
    <div id="lwbio_action_bar">
        <a href="<?php echo admin_url('admin.php?page=lwbio_add'); ?>" class="lwbio_action_bar_button">Adicionar Link</a>
    </div>
    <table class="lwbio_table">
        <tr>
            <td colspan="3" class="lwbio_table_title">Botões</td>
        </tr>
        <tr>
            <th>Texto</th>
            <th>Link</th>
            <th>Ações</th>
        </tr>
        <?php  
            foreach(LW_DB::index(0) as $item) {
                echo "<tr>
						<td class='lwbio_td_text'>{$item->text}</td>
						<td class='lwbio_td_url'>{$item->url}</td>
						<td class='lwbio_td_actions'>
							<a href='".admin_url("admin.php?page=lwbio_edit&id={$item->id}")."' class='lwbio_td_actions_button'><i class='bi bi-pencil-square'></i></a>
							<form action=".admin_url('admin-post.php')." method='post' class='lwbio_table_form'>
                                <input type='hidden' name='action' value='remove_link'>
                                <input type='hidden' name='data' value='link'>
                                <input type='hidden' name='lwbio_id' value=".$item->id.">
 								<button class='lwbio_table_form_button' type='submit'><i class='bi bi-trash3-fill'></i></button>
							</form>
						</td>
					</tr>";
            }
        ?>
    </table>

    <table class="lwbio_table">
        <tr>
            <td colspan="3" class="lwbio_table_title">Redes Sociais</td>
        </tr>
        <tr>
            <th>Serviço</th>
            <th>Link</th>
            <th>Ações</th>
        </tr>
    <?php
        foreach(LW_DB::index(1) as $item) {
            echo "<tr>
					<td class='lwbio_td_service'>{$item->service}</td>
					<td class='lwbio_td_url'>{$item->url}</td>
					<td class='lwbio_td_actions'>
						<a href='".admin_url("admin.php?page=lwbio_edit&id={$item->id}")."' class='lwbio_td_actions_button'><i class='bi bi-pencil-square'></i></a>
						<form action=".admin_url('admin-post.php')." method='post' class='lwbio_table_form'>
                            <input type='hidden' name='action' value='remove_link'>
                            <input type='hidden' name='data' value='link'>
                            <input type='hidden' name='lwbio_id' value=".$item->id.">
							<button class='lwbio_table_form_button' type='submit'><i class='bi bi-trash3-fill'></i></button>
						</form>
					</td>
				</tr>";
        }
    ?>
    </table>
</div>