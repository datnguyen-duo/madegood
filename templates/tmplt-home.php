<?php
/* Template Name: Home */

get_header();

$themeurl = get_bloginfo('template_url');

$banner_headline = get_field("home__banner_headline");
$banner_tagline = get_field("home__banner_tagline");
$banner_video = get_field("home__banner_showreel");
$banner_video_mobile = get_field("home__banner_showreel_mobile");

$banner_play_icon = get_field("home__banner_play_icon");

$intro_headline = get_field("home__intro_headline");
$intro_tagline = get_field("home__intro_tagline");
$intro_images = get_field("home__intro_images");

$about_headline = get_field("home__about_headline");
$about_tagline = get_field("home__about_tagline");
$about_projects = get_field("home__about_projects");
$about_cta = get_field("home__about_cta");

$services_headline = get_field("home__services_headline");
$services_tagline = get_field("home__services_tagline");
$services_icon = get_field("home__services_icon");
$services_service = get_field("home__services_service");

$join_headline = get_field("home__join_headline");
$join_tagline = get_field("home__join_tagline");
$join_cta = get_field("home__join_cta");

$contact_headline = get_field("home__contact_marquee");
$contact_images = get_field("home__contact_images");

$start_project_headline = get_field("home__start_project_headline");
$start_project_tagline = get_field("home__start_project_tagline");
$start_project_cta = get_field("home__start_project_cta");

?>
<div class="loader">
    <img src="<?php echo $themeurl ?>/assets/MadeGoodCo__M.svg" alt="loader">
</div>
<section id="banner">

    <?php if ($banner_video_mobile): ?>
        <video muted autoplay playsinline loop preload="metadata" class="home__video-showreel mobile">
            <source src="<?php echo $banner_video_mobile; ?>" type="video/mp4">
        </video>
        <video muted autoplay playsinline loop preload="metadata" class="home__video-showreel">
            <source src="<?php echo $banner_video; ?>" type="video/mp4">
        </video>
    <?php else: ?>
        <video muted autoplay playsinline loop preload="metadata" class="home__video-showreel no-mobile">
            <source src="<?php echo $banner_video; ?>" type="video/mp4">
        </video>
    <?php endif; ?>
    

    <div class="container">

        <?php if ($banner_tagline): ?>
            <img class="link play-icon" src="<?php echo $banner_tagline['url']; ?>" alt="tagline" width="189" height="83">
        <?php endif ?>
        
        <?php if ($banner_headline): ?>
            <div class="banner__headline__split-text">
                <?php echo $banner_headline; ?>
            </div>
        <?php endif ?>

    </div>
</section>

<section id="intro">
    <div class="container">

        <?php if ($intro_headline): ?>
            <?php echo $intro_headline; ?>
        <?php endif ?>
        <?php if ($intro_tagline): ?>
            <h4 class="st__fade"><?php echo $intro_tagline; ?></h4>
        <?php endif ?>

        <?php if ($intro_images): ?>
            <div class="intro__images">
                <?php foreach ($intro_images as $image): ?>
                    <div class="img-wrapper">
                        <?php echo wp_get_attachment_image( $image['home__intro-images-image']['id'], 'full', false, array("loading" => "lazy")); ?>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>

    </div>
</section>

<section id="who-we-are"> 
        <div class="grid-container">
            <?php if ($about_headline): ?>
                <h3 class="st__fade"><?php echo $about_headline; ?></h3>
            <?php endif ?>

            <?php if ($about_tagline): ?>

                <div class="wrapper">
                    <div class="icon link"><img src="<?php echo $themeurl ?>/assets/plus-icon.svg" alt="plus-icon" height="27" width="27"></div>
                    <p class="st__fade"><?php echo $about_tagline; ?></p>
                </div>

            <?php endif ?>
        </div>

        <div class="projects-wrapper">
            <?php if ($about_projects): $i = 1; ?>
                <div class="slider__projects" >

                    <?php foreach ($about_projects as $project): ?>
                        <a class="project-wrapper" id="project__<?php echo $i ?>" href="<?php echo $project['home__about_projects_project_link']['url']; ?>">
                            <?php echo wp_get_attachment_image( $project['home__about_projects_project_image']['id'], 'full', false, array("loading" => "lazy") ); ?>
                            <p class="title"><small><?php echo $project['home__about_projects_project_link']['title'] ?></small></p>
                            <p class="date"><small><?php echo $project['home__about_projects_project_date'] ?></small></p>
                            <p class="details"><small><?php echo $project['home__about_projects_project_details'] ?></small></p>
                        </a>

                        <?php $i++ ?>
                        
                    <?php endforeach ?>

                </div>
            <?php endif ?>

            <?php if ($about_cta): ?>
                <a class="cta-aside" href="<?php echo $about_cta['home__about-cta-link'] ?>">
                    <p><?php echo $about_cta['home__about-cta-label'] ?></p>
                    <img src="<?php echo $about_cta['home__about-cta-spinning-text']['url'] ?>" alt="who-we-are">
                    <img src="<?php echo $about_cta['home__about-cta-spinning-text-hover']['url'] ?>" alt="who-we-are" class="hover">
                </a>
            <?php endif; ?>
        </div>
</section>

<section id="services">
    <header class="st__fade">
        <?php if ($services_headline): ?>
            <p><small><?php echo $services_headline; ?></small></p>
        <?php endif ?>
        <?php if ($services_tagline): ?>
            <h3><?php echo $services_tagline; ?></h3>
        <?php endif ?>
        <?php if ($services_icon): ?>
            <div class="img-wrapper">
                <img src="<?php echo $services_icon['url']; ?>" alt="<?php echo $services_icon['alt']; ?>">
            </div>
        <?php endif ?>
    </header>

    <?php if ($services_service): ?>
        <div class="container">
            <?php foreach ($services_service as $service): ?>
                <a class="service-wrapper" href="<?php echo $service['home__services_service_link']['url'] ?>">
                    <h1 class="title headline__split-text"><?php echo $service['home__services_service_link']['title'] ?></h1>
                </a>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</section>
<?php if ($join_headline): ?>
    <section id="join">
        <div class="container">
            <img src="<?php echo $join_headline["url"]?>" alt="headline" class="st__curve">
            <?php if ($join_tagline): ?>
                <div class="st__fade"><?php echo $join_tagline ?></div>
            <?php endif ?>
            <?php if ($join_cta): ?>
                <div class="btn-wrapper">
                    <a class="btn__blob" href="<?php echo $join_cta['home__join_cta_link'] ?>">
                        <span><?php echo $join_cta['home__join_cta_label_initial'] ?></span>
                        <span><?php echo $join_cta['home__join_cta_label_hover'] ?></span>
                    </a>
                </div>
            <?php endif ?>
        </div>
    </section> 
<?php endif ?>
<?php if ($contact_headline): ?>
    <section id="contact">
        <div class="container">
            <h2 class="marquee"><span><?php echo $contact_headline ?></span></h2>
            <div class="img-wrapper">
                <?php foreach ($contact_images as $image): ?>
                    <img src="<?php echo $image['home__contact_images_image']['url'] ?>" alt="<?php echo $image['home__contact_images_image']['alt'] ?>">
                <?php endforeach ?>
            </div>
        </div>
    </section>
<?php endif ?>
<?php if ($start_project_headline): ?>
<section id="start-project">
    <div class="container">
    <?php if ($start_project_cta): ?>
        <div class="btn-wrapper">
            <a class="btn__blob" href="<?php echo $start_project_cta['home__start_project_cta_link'] ?>">
                <span><?php echo $start_project_cta['home__start_project_cta_label_initial'] ?></span>
                <span><?php echo $start_project_cta['home__start_project_cta_label_hover'] ?></span>
            </a>
        </div>
        <?php endif ?>
        <?php if ($start_project_tagline): ?>
            <div class="st__fade"><?php echo $start_project_tagline ?></div>
        <?php endif ?>
        <img src="<?php echo $start_project_headline["url"]?>" alt="headline" class="st__curve" >
    </div>
</section>
<?php endif ?>
<?php
get_footer();
?>