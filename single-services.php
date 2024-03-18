<?php

get_header();

$themeurl = get_bloginfo('template_url');
$ID = get_the_ID();

$banner_video = get_field("services__banner_video", $ID);
$banner_video_mobile = get_field("services__banner_video_mobile", $ID);
$banner_video_poster = get_field("services__banner_video-poster", $ID);

$intro_headline = get_field("services__intro_headline", $ID);
$intro_blurb_title = get_field("services__intro_blurb_title", $ID);
$intro_blurb_content = get_field("services__intro_blurb_content", $ID);
$intro_blurb_img_1 = get_field("services__intro_blurb_img-1", $ID);
$intro_blurb_img_2 = get_field("services__intro_blurb_img-2", $ID);
$intro_jumbo_image = get_field("services__intro_jumbo-image", $ID);
$intro_jumbo_content = get_field("services__intro_jumbo-content", $ID);

$main_p_image = get_field("services__main_p-image", $ID);
$main_marquee = get_field("services__main_marquee", $ID);
$main_blurb = get_field("services__main_blurb", $ID);
$main_content_top = get_field("services__main_content-top", $ID);
$main_content_middle = get_field("services__main_content-middle", $ID);
$main_content_bottom = get_field("services__main_content-bottom", $ID);

$featured_headline = get_field("services__featured_headline", $ID);
$featured_cta_headline = get_field("services__featured_cta_headline", $ID);
$featured_cta_link = get_field("services__featured_cta_link", $ID);
$featured_projects = get_field("services__featured_projects", $ID);

$cta_headline = get_field("services__cta_headline", $ID);
$cta_blurb = get_field("services__cta_blurb", $ID);
$cta_button = get_field("services__cta_button", $ID);
$cta_button_hover = get_field("services__cta_button-hover", $ID);

$next_post = get_next_post();
if( !$next_post ):
    $posts_query = new WP_Query(array(
        'post_type' => 'services',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'order'=>'ASC',
    ));
    $next_post = $posts_query->posts[0];
endif;

$prev_post = get_previous_post();
if( !$prev_post ):
    $posts_query = new WP_Query(array(
        'post_type' => 'services',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'order'=>'DESC',
    ));
    $prev_post = $posts_query->posts[0];
endif;

?>



<section id="services_banner" <?php if ($banner_video_mobile) echo "class='has-mobile'"; ?>>
    <?php if ($banner_video): ?>
        <?php if ($banner_video_mobile): ?>
            <video muted autoplay playsinline loop preload="metadata" poster="<?php echo $banner_video_poster["url"] ?>" class="banner-video mobile">
                <source src="<?php echo $banner_video_mobile["url"]; ?>" type="video/mp4">
            </video>
            <video muted autoplay playsinline loop preload="metadata" poster="<?php echo $banner_video_poster["url"] ?>" class="banner-video">
                <source src="<?php echo $banner_video["url"]; ?>" type="video/mp4">
            </video>
        <?php else: ?>
            <video muted autoplay playsinline loop preload="metadata" poster="<?php echo $banner_video_poster["url"] ?>" class="banner-video no-mobile">
                <source src="<?php echo $banner_video["url"]; ?>" type="video/mp4">
            </video>
        <?php endif; ?>
    <?php endif ?>

    <div class="play link">
        <img src="<?php echo $themeurl?>/assets/PlayVideo.svg" alt="text-svg">
        <img src="<?php echo $themeurl?>/assets/play-icon.svg" alt="play-icon">
    </div>

    <div class="headline">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2293.34 1356.54">
        <defs>
            <style>
            .cls-1 {
                <!-- fill: #e1ded5;-->
                <!-- stroke: #ffffff;  -->
            }
            </style>
        </defs>
        <g id="Layer_2" data-name="Layer 2">
            <g id="Layer_1-2" data-name="Layer 1">
            <path id="curvePath" d="M2293.3,678.3c0-0.1,0-0.2,0-0.3C2293.2,303.4,1779.7-0.2,1146.4-0.1S-0.1,303.7,0,678.3" class="cls-1"/>
            </g>
        </g>
        </svg>
        <h1 class="text"><?php echo str_replace(' ', '&nbsp;', get_the_title()); ?>&nbsp;</h1>
    </div>

    <div class="banner-nav">
        <a class="prev link" href="<?php echo get_the_permalink($prev_post->ID);?>">
            <h5><?php echo get_the_title($prev_post->ID);?></h5>
            <img src="<?php echo $themeurl?>/assets/smallarrow-left.svg" alt="arrow" width="25" height="20">
        </a>
        <a class="next link" href="<?php echo get_the_permalink($next_post->ID);?>">
            <h5><?php echo get_the_title($next_post->ID);?></h5>
            <img src="<?php echo $themeurl?>/assets/smallarrow-right.svg" alt="arrow" width="25" height="20">
        </a>
    </div>
</section>

<section id="services_intro">
    <header>
        <?php if ($intro_blurb_img_1): ?>
            <?php echo wp_get_attachment_image( $intro_blurb_img_1['id'], 'full', false, array('class' => 'p__img', "loading" => "lazy") ); ?>
        <?php endif ?>
        <?php if ($intro_blurb_img_2): ?>
            <?php echo wp_get_attachment_image( $intro_blurb_img_2['id'], 'full', false, array('class' => 'p__img', "loading" => "lazy") ); ?>
        <?php endif ?>

        <?php if ($intro_headline): ?>
            <h1 class="headline__split-text"><?php echo $intro_headline;?></h1>
        <?php endif ?>
        <div class="content st__fade">
            <?php if ($intro_blurb_title): ?>
                <h2><?php echo $intro_blurb_title; ?></h2>
            <?php endif ?>
            <?php if ($intro_blurb_content): ?>
                <p><?php echo $intro_blurb_content; ?></p>
            <?php endif ?>
        </div>
    </header>

    <div class="row">
        <?php if ($intro_jumbo_image): ?>
            <div class="col">
                <?php echo wp_get_attachment_image( $intro_jumbo_image['id'], 'full', false, array('class' => 'st__image', "loading" => "lazy") ); ?>
            </div>
        <?php endif ?>
        <?php if ($intro_jumbo_content): ?>
            <div class="col">
                <h1 class="headline__split-text"><?php echo $intro_jumbo_content; ?></h1>
            </div>
        <?php endif ?>

    </div>
</section> 

<section id="services_main">
    <?php if ($main_p_image): ?>
        <?php echo wp_get_attachment_image( $main_p_image['id'], 'full', false, array('class' => 'img__offset p__img', "loading" => "lazy") ); ?>
    <?php endif ?>

    <div class="marquee__alt">
        <?php if ($main_marquee): ?>
            <div class="fwd">
                <h2><?php echo $main_marquee ?></h2>
            </div>
            <div class="rev">
                <h2><?php echo $main_marquee ?></h2>
            </div>
        <?php endif ?>
    </div>

    <?php if ($main_content_top): ?>
        <div class="content first st__fade">
            <p><?php echo $main_content_top["services_main_content_blurb"]; ?></p>
            <h2><?php echo $main_content_top["services_main_content_title"]; ?></h2>
        </div>
    <?php endif ?>

    <?php if ($main_content_middle): ?>
        
        <div class="row">
            <div class="col st__fade">
                <h2><?php echo $main_content_middle["services_main_content_title"]; ?></h2>
                <p><?php echo $main_content_middle["services_main_content_blurb"]; ?></p>
            </div>
            <div class="col">
                <?php if ($main_content_middle["services_main_content_image-main"]): ?>
                <div class="img-wrapper">
                    <?php echo wp_get_attachment_image( $main_content_middle["services_main_content_image-main"]['id'], 'full', false, array(
                        "sizes" => "(max-width: 750px) 50vw, 70vw",
                        "loading" => "lazy"
                        ) ); ?>
                </div>
                <?php endif; ?>
                <?php if ($main_content_middle["services_main_content_image-offset"]): ?>
                <aside>
                    <?php echo wp_get_attachment_image( $main_content_middle["services_main_content_image-offset"]['id'], 'full', false, array("class" => "p__img", "loading" => "lazy") ); ?>
                </aside>
                <?php endif; ?>
            </div>
        </div>
    <?php endif ?>
    <?php if ($main_content_bottom): ?>
        <div class="content last st__fade">
            <p><?php echo $main_content_bottom["services_main_content_blurb"]; ?></p>
            <h2><?php echo $main_content_bottom["services_main_content_title"]; ?></h2>
        </div>
    <?php endif ?>
</section>

<section id="featured_work">
    <header>
        <?php if ($featured_headline): ?>
            <h1 class="headline__split-text"><?php echo $featured_headline; ?></h1>
        <?php endif ?>
        <?php if ($featured_cta_headline): ?>
            <h2 class="st__fade"><?php echo $featured_cta_headline; ?></h2>
        <?php endif ?>
        <?php if ($featured_cta_link): ?>
            <div class="btn-wrapper st__fade">
            <a class="btn__blob" href="<?php echo $featured_cta_link["url"]; ?>">
                <span><?php echo $featured_cta_link["title"]; ?></span>
                <span><?php echo $featured_cta_link["title"]; ?></span>
            </a>
        </div>
        <?php endif ?>
        
        <?php if ($featured_projects):?>
            <div class="imgs">
            <?php foreach ($featured_projects as $project): ?>
                <div class="img-wrapper">
                    <div class="inner">
                        <?php echo wp_get_attachment_image( $project["services_featured_projects_image"]['id'], 'full', false, array(
                            'sizes' => "(min-width: 750px) 250px, 25vw",
                            "loading" => "lazy"
                        ), ); ?>
                    </div>
                </div>
            <?php endforeach ?>  
            </div>
        <?php endif ?>
    </header>
</section>

<section id="connect" class="bg__red">
    <div class="container">
        <?php if ($cta_headline): ?>
            <img class="st__curve" src="<?php echo $cta_headline["url"]; ?>" alt="<?php echo $cta_headline["alt"]; ?>">
        <?php endif ?>
        <?php if ($cta_blurb): ?>
            <div class="st__fade">
                <p><?php echo $cta_blurb; ?></p>
            </div>
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
</section>

<?php get_footer(); ?>