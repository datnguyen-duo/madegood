<?php

get_header();
$themeurl = get_bloginfo('template_url');
$ID = get_the_ID();
$categories = get_the_category($ID);
$category_names = array();
$tags = get_the_tags($ID);
$tag_names = array();

$banner_video = get_field("cs__banner_video", $ID);
$banner_video_mobile = get_field("cs__banner_video_mobile", $ID);

$banner_poster = get_field("cs__banner_video-poster", $ID);
$intro_blurb = get_field("cs__intro-blurb", $ID);

$main_image_1 = get_field("cs__main-image", $ID);
$main_image_1_mobile = get_field("cs__main-image_mobile", $ID);

$main_offset_image = get_field("cs__offset-image", $ID);

$stats_headline = get_field("cs__stats_headline", $ID);
$stats_images = get_field("cs__stats_images", $ID);
$stats_content = get_field("cs__stats_content", $ID);

$main_image_2 = get_field("cs__main-image--2", $ID);
$main_image_2_mobile = get_field("cs__main-image--2_mobile", $ID);


$social_headline = get_field("cs__social_headline", $ID);
$social_intro_content = get_field("cs__social_intro-content", $ID);
$social_slider = get_field("cs__social_slider", $ID);
$social_specs = get_field("cs__social_specs", $ID);
$social_marquee_images = get_field("cs__social_marquee_images", $ID);

$cta_headline = get_field("cs__next_headline", $ID);
$cta_blurb = get_field("cs__next_blurb", $ID);
$cta_button = get_field("cs__next_button", $ID);
$cta_button_hover = get_field("cs__next_button-hover", $ID);

$next_post = get_next_post();
if( !$next_post ):
    $posts_query = new WP_Query(array(
        'post_type' => 'case_studies',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'order'=>'ASC',
    ));
    $next_post = $posts_query->posts[0];
endif;

?>

<div class="horizontal">
    <section id="project_banner">
        <div class="vmarquee headline__rotate vm__banner"><h1><?php the_title(); ?></h1><h1><?php the_title(); ?></h1><h1><?php the_title(); ?></h1><h1><?php the_title(); ?></h1><h1><?php the_title(); ?></h1></div>
        <img src="<?php echo $themeurl?>/assets/play-icon.svg" alt="play-icon" class="play-icon link">
        <?php if ($banner_video_mobile): ?>
            <video muted autoplay playsinline loop preload="metadata" class="banner-video mobile">
                <source src="<?php echo $banner_video_mobile["url"]; ?>" type="video/mp4">
            </video>
            <video muted autoplay playsinline loop preload="metadata" class="banner-video">
                <source src="<?php echo $banner_video["url"]; ?>" type="video/mp4">
            </video>
        <?php else: ?>
            <video muted autoplay playsinline loop preload="metadata" class="banner-video no-mobile">
                <source src="<?php echo $banner_video["url"]; ?>" type="video/mp4">
            </video>
        <?php endif; ?>

        <p class="scroll">Scroll to view</p>
    </section>

    <section id="project_intro">
        <h1><?php foreach($categories as $category) { $category_names[] = $category->cat_name; } echo implode(', ', $category_names);?></h1>
        <div class="content">
            <?php if ($tags): ?>
                <p><?php foreach ( $tags as $tag ) {$tag_names[] = $tag->name; } echo implode(', ', $tag_names);?></p>
            <?php endif;?>
            <h4><?php echo $intro_blurb; ?></h4>
        </div>
    </section> 

    <section id="project_img-banner">
        <?php if ($main_image_1_mobile): ?>

            <?php if ($main_image_1_mobile): ?>
            <div class="img-wrapper mobile">
                <?php if ($main_image_1_mobile['type'] == 'video'): ?>
                    <video muted autoplay playsinline loop src="<?php echo $main_image_1_mobile['url'] ?>" preload="metadata"></video>
                <?php endif; ?>
                <?php if ($main_image_1_mobile['type'] == 'image'):
                    echo wp_get_attachment_image( $main_image_1_mobile['id'], 'full', false, array("loading" => "lazy") );
                endif;  ?>
            </div>
            <?php endif; ?>

            <?php if ($main_image_1): ?>
            <div class="img-wrapper">
                <?php if ($main_image_1['type'] == 'video'): ?>
                    <video muted autoplay playsinline loop src="<?php echo $main_image_1['url'] ?>" preload="metadata"></video>
                <?php endif; ?>
                <?php if ($main_image_1['type'] == 'image'):
                    echo wp_get_attachment_image( $main_image_1['id'], 'full', false, array("loading" => "lazy") );
                endif;  ?>
            </div>
            <?php endif; ?>

        <?php else: ?>
            <?php if ($main_image_1): ?>
            <div class="img-wrapper no-mobile">
                <?php if ($main_image_1['type'] == 'video'): ?>
                    <video muted autoplay playsinline loop src="<?php echo $main_image_1['url'] ?>" preload="metadata"></video>
                <?php endif; ?>
                <?php if ($main_image_1['type'] == 'image'):
                    echo wp_get_attachment_image( $main_image_1['id'], 'full', false, array("loading" => "lazy") );
                endif;  ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($main_offset_image): ?>
        <aside>
            <?php echo wp_get_attachment_image( $main_offset_image['id'], 'thumbail', false, array("loading" => "lazy") ); ?>
        </aside>
        <?php endif; ?>
    </section> 

    <section id="project_stats">
        <div class="vmarquee headline__rotate"><h1><?php echo $stats_headline; ?></h1><h1><?php echo $stats_headline; ?></h1><h1><?php echo $stats_headline; ?></h1><h1><?php echo $stats_headline; ?></h1><h1><?php echo $stats_headline; ?></h1></div>
        <div class="row">
            <div class="col">
                <?php if($stats_images["cs__stats_main-image"]): ?>
                <div class="img-wrapper">
                    <?php echo wp_get_attachment_image( $stats_images["cs__stats_main-image"]['id'], 'full', false, array("loading" => "lazy")); ?>
                </div>
                <?php endif; ?>
                <?php if($stats_images["cs__stats_offset-image"]): ?>
                <aside>
                    <?php echo wp_get_attachment_image( $stats_images["cs__stats_offset-image"]['id'], 'thumbail', false, array("loading" => "lazy")); ?>
                </aside>
                <?php endif; ?>
            </div>
            <div class="col">
                <h4><?php echo $stats_content["cs__stats_content_header"]; ?></h4>
                <?php if ($stats_content["cs__stats_content_stats"]): $stats = $stats_content["cs__stats_content_stats"]?>
                    <?php foreach ($stats as $stat): ?>
                        <div class="stat">
                            <h2><?php echo $stat["cs__stats_content_stats-title"] ?></h2>
                            <p><?php echo $stat["cs__stats_content_stats-blurb"] ?></p>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </section>

    <?php if ($main_image_2): ?>
    <section id="project_img-banner-full">
        <?php if ($main_image_2_mobile): ?>

            <?php if ($main_image_2_mobile['type'] == 'video'): ?>
                <video muted autoplay playsinline loop src="<?php echo $main_image_2_mobile['url'] ?>" preload="metadata" class="mobile"></video>
            <?php endif; ?>
            <?php if ($main_image_2_mobile['type'] == 'image'):
                echo wp_get_attachment_image( $main_image_2_mobile['id'], 'full', false, array("class" => "mobile", "loading" => "lazy") );
            endif;  ?>

            <?php if ($main_image_2): ?>
                <?php if ($main_image_2['type'] == 'video'): ?>
                    <video muted autoplay playsinline loop src="<?php echo $main_image_2['url'] ?>" preload="metadata"></video>
                <?php endif; ?>
                <?php if ($main_image_2['type'] == 'image'):
                    echo wp_get_attachment_image( $main_image_2['id'], 'full', false, array("loading" => "lazy") );
                endif;  ?>
            <?php endif; ?>

        <?php else: ?>
        <?php if ($main_image_2): ?>
            <?php if ($main_image_2['type'] == 'video'): ?>
                <video muted autoplay playsinline loop src="<?php echo $main_image_2['url'] ?>" preload="metadata" class="no-mobile"></video>
            <?php endif; ?>
            <?php if ($main_image_2['type'] == 'image'):
                echo wp_get_attachment_image( $main_image_2['id'], 'full', false, array("class" => "no-mobile", "loading" => "lazy") );
            endif;  ?>
        <?php endif; ?>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <section id="project_social">
        <div class="vmarquee headline__rotate"><h1><?php echo $social_headline; ?></h1><h1><?php echo $social_headline; ?></h1><h1><?php echo $social_headline; ?></h1><h1><?php echo $social_headline; ?></h1><h1><?php echo $social_headline; ?></h1></div>
        
        <div class="container">
            <div class="img-text-v">
                <?php if ($social_intro_content["cs__social_intro-content_image"]): 
                    echo wp_get_attachment_image( $social_intro_content["cs__social_intro-content_image"]['id'], 'full', false, array("loading" => "lazy"));
                endif;?>
                <p><?php echo $social_intro_content["cs__social_intro-content_blurb"] ;?></p>
            </div>
            <?php if ($social_slider): ?>
                <div class="slider">
                    <?php foreach ($social_slider as $slide): ?>
                        <?php if ($slide["cs__social_slider_image"]): ?>
                            <?php if ($slide["cs__social_slider_image"]['type'] == 'video'): ?>
                                <video playsinline loop autoplay muted src="<?php echo $slide["cs__social_slider_image"]['url'] ?>" id="video"></video>
                            <?php endif; ?>
                            <?php if ($slide["cs__social_slider_image"]['type'] == 'image'):  ?>
                                <?php echo wp_get_attachment_image( $slide["cs__social_slider_image"]['id'], 'full', false, array("loading" => "lazy") ); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <?php if ($social_specs): ?>
                <div class="img-text-h">
                    <?php if($social_specs["cs__social_specs_image"]): ?>
                    <div class="col">
                        <?php echo wp_get_attachment_image( $social_specs["cs__social_specs_image"]['id'], 'full', false, array("loading" => "lazy") ); ?>
                    </div>
                    <?php endif; ?>
                    <?php ?>
                    <div class="col">
                        <h1><?php echo $social_specs["cs__social_specs_header"]; ?></h1>
                        <p><?php echo $social_specs["cs__social_specs_blurb"]; ?></p>
                    </div>
                </div>
            <?php endif ?>

            <?php if ($social_marquee_images):
                $set1 = $social_marquee_images["cs__social_marquee_images_set-one"];
                $set2 = $social_marquee_images["cs__social_marquee_images_set2"];
                ?>
                <div class="vmarquee__alt">
                    <?php if ($set1): ?>
                        <div class="rev">
                            <div class="inner">
                                <?php foreach ($set1 as $image): echo wp_get_attachment_image( $image["cs__social_marquee_images_set1_image"]['id'], 'full', false, array("loading" => "lazy") ); endforeach ?>
                            </div>
                            <div class="inner">
                                <?php foreach ($set1 as $image): echo wp_get_attachment_image( $image["cs__social_marquee_images_set1_image"]['id'], 'full', false, array("loading" => "lazy") ); endforeach ?>
                            </div>
                            <div class="inner">
                                <?php foreach ($set1 as $image): echo wp_get_attachment_image( $image["cs__social_marquee_images_set1_image"]['id'], 'full', false, array("loading" => "lazy") ); endforeach ?>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php if ($set2): ?>
                        <div class="fwd">
                            <div class="inner">
                                <?php foreach ($set2 as $image): echo wp_get_attachment_image( $image["cs__social_marquee_images_set2_image"]['id'], 'full', false, array("loading" => "lazy") ); endforeach ?>
                            </div>
                            <div class="inner">
                                <?php foreach ($set2 as $image): echo wp_get_attachment_image( $image["cs__social_marquee_images_set2_image"]['id'], 'full', false, array("loading" => "lazy") ); endforeach ?>
                            </div>
                            <div class="inner">
                                <?php foreach ($set2 as $image): echo wp_get_attachment_image( $image["cs__social_marquee_images_set2_image"]['id'], 'full', false, array("loading" => "lazy") ); endforeach ?>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            <?php endif ?>
        </div>
    </section>
    <section id="next">
        <div class="row">
            <?php if ($cta_headline): ?>
                <div class="col">
                    <h1><?php echo $cta_headline; ?></h1>
                </div>
            <?php endif ?>

            <div class="col">
                <?php if ($cta_blurb): ?>
                    <p><?php echo $cta_blurb; ?></p>
                <?php endif ?>

                <?php if ($cta_button): ?>
                    <div class="btn-wrapper">
                        <a class="btn__blob" href="<?php echo $cta_button["url"] ?>">
                            <span><?php echo $cta_button["title"] ?></span>
                            <?php if ($cta_button_hover): ?>
                                <span><?php echo $cta_button_hover; ?></span>
                            <?php else :?>
                                <span><?php echo $cta_button["title"] ?></span>    
                            <?php endif ?>
                        </a>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <a class="next-project" href="<?php echo get_the_permalink($next_post->ID); ?>">
            <p>Next Project</p>
            <img src="<?php echo $themeurl?>/assets/smallarrow-right-black.svg" alt="arrow" width="25" height="20">
        </a>
    </section>
</div>

<?php
get_footer();
?>