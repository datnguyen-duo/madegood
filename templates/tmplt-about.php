<?php
/* Template Name: About */

get_header();

$themeurl = get_bloginfo('template_url');

$about_banner_headline_initial = get_field("about__banner_headline");
$about_banner_headline_blurb = get_field("about__banner_headline-blurb");
$about_banner_headline_end = get_field("about__banner_headline-end");
$about_banner_headline_nl = get_field("about__banner_headline_nl");
$about_banner_blurb = get_field("about__banner_blurb");
$about_banner_images = get_field("about__banner_images");
$about_banner_cta = get_field("about__banner_cta");

$about_values_value_1 = get_field("about__values_value-1");
$about_values_jumbotron = get_field("about__values_jumbotron");
$about_values_headlines = get_field("about__values_jumbotron_headlines");
$about_values_value_2 = get_field("about__values_value-2");

$about_cta_headline = get_field("about__cta_headline");
$about_cta_blurb = get_field("about__cta_blurb");
$about_cta_button = get_field("about__cta_button");
$about_cta_button_hover = get_field("about__cta_button-hover");
?>

<section id="about_intro">
    <div class="mobile-only">
        <?php if ($about_banner_headline_blurb): ?>
            <p><?php echo $about_banner_headline_blurb; ?></p>
        <?php endif ?>
        <h1>
        <?php if ($about_banner_headline_initial): ?>
            <?php echo $about_banner_headline_initial; ?>
        <?php endif ?>
        <?php if ($about_banner_headline_end): ?>
                <?php echo $about_banner_headline_end; ?>
        <?php endif ?>
        <?php if ($about_banner_headline_nl): ?>
                <?php echo $about_banner_headline_nl; ?>
        <?php endif ?>
        </h1>
    </div>
    <div class="desktop-only">
        <div class="text-wrap">
            <?php if ($about_banner_headline_initial): ?>
                <h1><?php echo $about_banner_headline_initial; ?></h1>
            <?php endif ?>
            <?php if ($about_banner_headline_blurb): ?>
                    <span><?php echo $about_banner_headline_blurb; ?></span>
            <?php endif ?>
            <?php if ($about_banner_headline_end): ?>
                    <h1><?php echo $about_banner_headline_end; ?></h1>
            <?php endif ?>
            </h1>
        </div>
        <?php if ($about_banner_headline_nl): ?>
                <h1><?php echo $about_banner_headline_nl; ?></h1>
        <?php endif ?>
    </div>

    <div class="content st__fade">
        <?php if ($about_banner_blurb): ?>
            <?php echo $about_banner_blurb; ?>
        <?php endif ?>
    </div>
    <div class="fixed">
        <div class="img-wrapper st__image">
        <?php foreach ($about_banner_images as $image): ?>
            <?php echo wp_get_attachment_image( $image['about__banner_images_image']['id'], 'full', false, array(
                'sizes' => "(min-width: 750px) 30vw, 75vw",
                "loading" => "lazy"
            ) ); ?>
        <?php endforeach ?>
        </div>
        <div class="row">
            <?php if ($about_banner_cta): ?>
                <h2><?php echo $about_banner_cta["about__banner_cta_text"]; ?></h2>
            <div class="btn-wrapper">
                <a class="btn__blob" href="<?php echo $about_banner_cta["about__banner_cta_button"]["url"]; ?>">
                    <span><?php echo $about_banner_cta["about__banner_cta_button"]["title"]; ?></span>
                    <span><?php echo $about_banner_cta["about__banner_cta_button-hover"]; ?></span>
                </a>
            </div>
            <?php endif ?>
        </div>
    </div>
</section>

<section id="values">
    <?php if ($about_values_value_1): $values = $about_values_value_1["about__values_value-1_value"]; ?>
        <div class="row first">
            <?php foreach ($values as $value): ?>
                <div class="col">
                    <h4><?php echo $value["about__values_value-1_value_title"]; ?></h4>
                    <p><?php echo $value["about__values_value-1_value_content"]; ?></p>
                </div>
            <?php endforeach ?>
            <div class="col">
                <h2><?php echo $about_values_value_1["about__values_value-1_headline"] ?></h2>
            </div>
        </div>
    <?php endif ?>
    <div class="img-wrapper__lg">
        <?php if ($about_values_jumbotron): ?>
            <?php echo wp_get_attachment_image( $about_values_jumbotron['id'], 'full', false, array('class' => 'jumbotron__image', "loading" => "lazy")); ?>
        <?php endif ?>
        <?php if ($about_values_headlines): ?>
            <h1 class="headline__split-text">
                <?php foreach ($about_values_headlines as $headline): 
                    echo $headline["jumbotron_headlines_headline"] . "<br>";
                endforeach ?>
            </h1>
        <?php endif ?>
    </div>
    <?php if ($about_values_value_2): $values = $about_values_value_2["about__values_value-2_value"]; ?>
        <div class="row last">
            <div class="col">
                <h2><?php echo $about_values_value_2["about__values_value-2_headline"] ?></h2>
            </div>
            <?php foreach ($values as $value): ?>
                <div class="col">
                    <h4><?php echo $value["about__values_value-2_value_title"]; ?></h4>
                    <p><?php echo $value["about__values_value-2_value_content"]; ?></p>
                </div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</section>

<section id="connect">
    <div class="container">
        <?php if ($about_cta_headline): ?>
            <img class="st__curve" src="<?php echo $about_cta_headline["url"]; ?>" alt="<?php echo $about_cta_headline["alt"]; ?>">
        <?php endif ?>
        <?php if ($about_cta_blurb): ?>
            <div class="st__fade">
                <p><?php echo $about_cta_blurb; ?></p>
            </div>
        <?php endif ?>
        <?php if ($about_cta_button): ?>
            <div class="btn-wrapper">
                <a class="btn__blob" href="<?php echo $about_cta_button["url"] ?>">
                    <span><?php echo $about_cta_button["title"] ?></span>
                    <?php if ($about_cta_button_hover): ?>
                        <span><?php echo $about_cta_button_hover; ?></span>
                    <?php else :?>
                        <span><?php echo $about_cta_button["title"] ?></span>    
                    <?php endif ?>
                </a>
            </div>
        <?php endif ?>
    </div>
</section>

<?php
get_footer();
?>