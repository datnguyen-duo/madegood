<?php
$themeurl = get_bloginfo('template_url');
$social_media = get_field('footer_social_media', 'option');
?>

<footer>
    <div class="container">
        <div class="inner">
            <div class="col">
                <div class="row">
                    <?php $social_media_icons = $social_media["icons"];
                        if($social_media_icons): 
                            foreach ($social_media_icons as $icon): ?>
                                <a href="<?php echo $icon["link"]?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo $icon["img_icon"]["url"]?>" alt="social-icon"></a>
                            <?php endforeach; ?>
                        <?php endif; 
                    ?>
                </div>
                <h6><?php echo $social_media["headline"]; ?></h6>
                <p><?php echo $social_media["tagline"]; ?></p>
            </div>
            <div class="col">
                <?php 
                    $footer_logo = get_field("footer_logo", 'option');
                    if ($footer_logo):
                ?>
                    <a class="logo" href="/"><img src="<?php echo esc_url( $footer_logo['url'] ); ?>" alt="<?php echo esc_attr( $footer_logo['alt'] ); ?>" width="260" height="215" /></a>
                <?php endif ?>
            </div>

            <div class="col">
                <img src="<?php echo get_field('footer_contact_details', 'option')['icon']['url']; ?>" alt="globe-icon">
                <h6><?php echo get_field('footer_contact_details', 'option')['headline'];?></h6>
                <?php echo get_field('footer_contact_details', 'option')['tagline']; ?>
            </div>
        </div>

        <nav>
        <?php if( have_rows('footer_navigation', 'option') ): ?>
            <?php $i = 0; ?>
            <ul>
                <?php while ( have_rows('footer_navigation', 'option') ) : the_row();?>
                    <?php $i++; ?>
                        <?php if( $i > 2 ): ?>
                            <?php break; ?>
                        <?php endif; ?>
                    <li><a href="<?php the_sub_field('nav_link')?>"><?php the_sub_field('nav_item');?></a></li>
                <?php endwhile;?>
            </ul>
        <?php endif; ?>

        <?php 
            $contact_form = get_field("contact_form_shortcode", 'option');
                if ($contact_form):
        ?>
            <?php echo do_shortcode($contact_form); ?>
        <?php endif ?>
        
        <?php if( have_rows('footer_navigation', 'option') ): ?>
            <ul>
                <li><a href="<?php the_sub_field('nav_link')?>"><?php the_sub_field('nav_item');?></a></li>
                    <?php while ( have_rows('footer_navigation', 'option') ) : the_row();?>
                        <li><a href="<?php the_sub_field('nav_link')?>"><?php the_sub_field('nav_item');?></a></li>
                    <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        </nav>
    </div>
</footer>

</main>
</div>
<?php 

    $terms = get_terms( array(
        'taxonomy' => 'category',
        'hide_empty' => true,
    ) );
        
    ?>
<ul class="filters">
    <li class="filter__item active">All</li>
    <?php if ($terms): foreach ( $terms as $term ): ?>
        <li class="filter__item" data-attribute-filter="<?php echo $term->slug; ?>"><?php echo $term->name; ?></li>
    <?php endforeach; ?>
    <?php endif; ?>
    <a class="plus-icon" href="/portfolio/behind-the-good/"></a></div>
</ul>

<div id="cart-response">
    <?php render_shopping_cart(); ?>
</div>

<?php wp_footer(); ?>
</body>

</html>


