<?php //WP Links Template

    $links = LW_DB::index(0);
    $channels = LW_DB::index(1);
    $logo = esc_attr( get_option('lwbio_logo') );

?>
<section id="lwbio__outer-card">
    <div id="lwbio__card">
        <?php 
            if (!empty($logo)) {
                echo "<img id='lwbio__logo' src='{$logo}' alt='logo' />";
            } else {
                echo "<i id='lwbio__temp_logo' class='fas fa-globe' style='font-size: 128px;'></i>";
            }
        ?>
        <div class="lwbio__links">
            <?php
                foreach($links as $value) {
                    echo "<div class='lwbio__links__item'>
                                 <a class='lwbio__links__item lwbio__links__item--lb' href='{$value->url}' 
                                     target='_blank' rel='noopener'>{$value->text}
                                 </a>
                            </div>";
                }                                       
            ?>
        </div>
        <h2 id="lwbio__h2">Me siga nas redes sociais</h2>
        <div class="lwbio__channels">
            <?php
                foreach($channels as $value) {
                        echo "<a class='lwbio__channels__item' 
                                href='{$value->url}' target='_blank' rel='noopener'>
                                <i class='". lwbio_fa_icon($value->service)."'></i>
                              </a>";
                }
            ?>
        </div>
</div>
</section>