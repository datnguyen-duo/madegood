<?php
/* Template Name: Portfolio */

get_header();

$themeurl = get_bloginfo('template_url');
$args = array(
    'post_type' => 'case_studies',
    'posts_per_page' => '-1',
    'post_status' => 'publish',
    'orderby' => "date",
    'order' => 'ASC',
);


$case_studies = new WP_Query( $args );

$terms = get_terms( array(
    'taxonomy' => 'category',
    'hide_empty' => true,
) );

$categories = get_categories($args);

$banner_headline = get_field("portfolio__banner_headline");

?>

<section id="portfolio_banner">
    <?php if ($banner_headline): echo $banner_headline; endif;?>
</section>

<section id="portfolio_main">
    <ul class="filters__mobile mobile-only">
        <li>Filters:</li>
        <li class="filter__item active">All</li>
        <?php if ($terms): foreach ( $terms as $term ): ?>
            <li class="filter__item" data-attribute-filter="<?php echo $term->slug; ?>"><?php echo $term->name; ?></li>
        <?php endforeach; ?>
        <?php endif; ?>
        <a class="plus-icon" href="/portfolio/behind-the-good/">
    </ul>

    <?php if ( $case_studies -> have_posts() ):
        while ( $case_studies -> have_posts() ):
            $case_studies -> the_post(); 
            $ID = get_the_ID();
            $categories = get_the_category($ID);
            $category_names = array();
            $tags = get_the_tags($ID);
            $tag_names = array();
            $video = get_field("cs__banner_video", $ID);
            $client = get_field("cs__banner_client", $ID);
            $details = get_field("cs__banner_details", $ID);
            $poster_image = get_field("cs__banner_video-poster", $ID);
            $blurb = get_field("cs__intro-blurb", $ID);
            $featured_images = get_field("cs__index_images", $ID);
            ?>

        <ul class="filters__mobile mobile-only">

        </ul>
        <div class="project <?php foreach($categories as $category) { $category_names[] = (str_replace(' ', '-', strtolower($category->cat_name))) ; } echo implode(', ', $category_names); ?>">
            <a class="video link st__fade" href="<?php echo get_the_permalink($ID); ?>">
                <?php if ($video): ?>
                    <video loop muted playsinline src="<?php echo $video["url"]; ?>"
                    <?php if ($poster_image): ?>
                        poster="<?php echo $poster_image["url"]; ?>"
                    <?php endif ?>
                    ></video>
                <?php endif ?>      
                <?php if ($poster_image):
                    echo wp_get_attachment_image( $poster_image['id'], 'full', false, array( 'sizes' => '(min-width: 750px) 55vw, 90vw', "loading" => "lazy" ) );
                endif ?>          
                <div class="title">
                    <?php if ($client): ?>
                        <h5><?php echo $client; ?></h5>
                    <?php endif ?>
                    <h2><?php the_title();?></h2>
                </div>
                <?php if ($details): ?>
                    <p class="details"><?php echo $details; ?></p>
                <?php endif ?>

                <?php if ($tags): ?>
                    <p class="tag">Project tags: <?php foreach ( $tags as $tag ) {$tag_names[] = $tag->name; } echo implode(', ', $tag_names); ?></p>
                <?php endif ?>

            </a>
        </div>
        <?php endwhile; wp_reset_postdata();?>
    <?php endif; ?>
</section> 

<section id="connect" class="bg__red">
    <div class="container">
        <img class="st__curve" src="<?php echo $themeurl ?>/assets/lets-connect.svg" alt="lets-connect">
        
        <div class="st__fade">
            <p style="text-align: center;">There's more where that came from.<br/>Let's get in touch!</p>
        </div>

        <div class="btn-wrapper">
            <a class="btn__blob" href="/contact/">
                <span>Go</span>
                <span>Connect</span>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>