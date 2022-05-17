<?php //WP Links Template

$links = BioDatabase::index(0);
$channels = BioDatabase::index(1);
$logo = esc_attr(get_option('lwbio_logo'));
$channel_text = esc_attr(get_option('lwbio_channel_text'));

?>
<section id="lwbio__outer-card">
    <div id="lwbio__card">
        <?php if (!empty($logo)) : ?>
            <img id='lwbio__logo' src='<?= $logo ?>' alt='logo' />
        <?php else: ?>
            <i id='lwbio__temp_logo' class='bi bi-globe2' style='font-size: 128px;'></i>
        <?php endif; ?>

        <div class="lwbio__links">
            <?php foreach ($links as $value) : ?>
                <div class='lwbio__links__item'>
                    <a class='lwbio__links__item lwbio__links__item--lb' href='<?= $value->url ?>' target='_blank' rel='noopener'><?= $value->text ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <h2 id="lwbio__h2"><?= empty($channel_text) ? 'Me siga nas redes sociais' : $channel_text ?></h2>
        <div class="lwbio__channels">
            <?php foreach ($channels as $value) : ?>
                <a class='lwbio__channels__item' href='<?= $value->url ?>' target='_blank' rel='noopener'>
                    <i class='<?= lwbio_fa_icon($value->service) ?>'></i>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>