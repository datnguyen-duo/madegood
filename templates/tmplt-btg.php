<?php
/* Template Name: BTG */

get_header();

$themeurl = get_bloginfo('template_url');

$text = get_field("marquee_text");
$images = get_field("images");

?>

<section id="fp_main">
    <a class="close" href="/portfolio/">
        <div class="line"></div>
        <div class="line"></div>       
        <div class="line"></div>
    </a>
    <?php if ($text): ?>
        <div class="marquee__alt-modal">
            <div class="fwd">
                <h2><?php echo $text; ?></h2>
            </div>
            <div class="rev">
                <h2><?php echo $text; ?></h2>
            </div>
        </div>
    <?php endif; ?>
    <?php if( $images ): $count = 0; $i = 0;?>
    <div class="images">
        <?php foreach ($images as $image): 
                echo wp_get_attachment_image( $image['image']["ID"], "large", "", array( "class" => "blog__post-item--thumbnail", "loading" => "lazy" ) ); 
            endforeach; ?>
    </div>
    <?php endif; ?>
    <div class="count">
        <div class="row"> 
            <div class="col">
            <?php foreach ($images as $image): $count++; ?>
                <h2><?php 
                    if ($count < 10) {
                        echo "0" . $count;
                    } else {
                        echo $count;
                    };
                ?></h2>
            <?php endforeach; ?>
            </div>
            <div class="col">
                <div class="inner-container">
                <?php foreach ($images as $image): $i++?>
                    <div class="inner">
                        <?php 
                        if ($i < 10) {
                            echo "0" . $i;
                        } else {
                            echo $i;
                        };
                    ?>
                    </div>
                <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>