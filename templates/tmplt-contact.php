<?php
/* Template Name: Contact */

get_header();

$themeurl = get_bloginfo('template_url');

$headline = get_field("contact__headline");
$blurb = get_field("contact__blurb");
$form = get_field("contact__form");

?>

<section id="contact_main" class="contact-main">
    <div class="headline">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2293.34 1356.54" version="1.1">
        <defs>
            <style>
            .cls-1 {
                <!-- fill: #e1ded5; -->
                <!-- stroke: #fff; -->
            }
            </style>
        </defs>
        <g id="Layer_2" data-name="Layer 2">
            <g id="Layer_1-2" data-name="Layer 1">
            <path id="curvePath" d="M2293.3,678.3c0-0.1,0-0.2,0-0.3C2293.2,303.4,1779.7-0.2,1146.4-0.1S-0.1,303.7,0,678.3" class="cls-1"/>
            </g>
        </g>
        </svg>
        <h1 class="text"><?php echo str_replace(' ', '&nbsp;', $headline); ?>&nbsp;<?php echo str_replace(' ', '&nbsp;', $headline); ?>&nbsp;</h1>
    </div>

    <div class="row">
        <a class="inner" href="/contact/follow-us/">
            <img src="<?php echo $themeurl?>/assets/smallarrow-left.svg" alt="arrow" width="25" height="20">
            <h5>Follow Us</h5>
        </a>
        <?php if ($blurb): ?>
            <p><?php echo $blurb; ?></p>
        <?php endif ?>

        <a class="inner" href="/contact/follow-us/">
            <h5>Follow Us</h5>
            <img src="<?php echo $themeurl?>/assets/smallarrow-right.svg" alt="arrow" width="25" height="20">
        </a>
    </div>

    <?php if ($form): ?>
        <?php echo do_shortcode($form); ?>
    <?php endif ?>

</section>

<?php get_footer(); ?>