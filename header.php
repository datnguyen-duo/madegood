<?php
$themeurl = get_bloginfo('template_url');
$pagename =  basename(get_permalink());
$ID = get_the_ID();

$template_path = get_post_meta(get_the_ID(), '_wp_page_template', true);
$templates = wp_get_theme()->get_page_templates();

$homepage_id = get_option( 'page_on_front' );
$services = get_field("home__services_service", $homepage_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-WH6LFV5QRW"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-WH6LFV5QRW');
    </script>

    <?php wp_head();?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="<?php echo $themeurl ?>/style-inline.css">
    <link rel="preload" href="<?php echo $themeurl ?>/style.css?v=2" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="<?php echo $themeurl ?>/style.css?v=2"></noscript>
    <link rel="preload" href="//webfonts3.radimpesko.com/RP-W-ff9519f0-8b59-41be-9ba0-3ff43e58d308" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="//webfonts3.radimpesko.com/RP-W-ff9519f0-8b59-41be-9ba0-3ff43e58d308"></noscript>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" defer></script>
    <script type="text/javascript" src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js" defer></script>
    <script type="text/javascript" src="<?php echo $themeurl ?>/scripts/gsap-lib/gsap.min.js" defer></script>
	 <script src="https://unpkg.com/split-type"></script>
    <script type="text/javascript" src="<?php echo $themeurl ?>/scripts/gsap-lib/ScrollSmoother.min.js" defer></script>
    <script type="text/javascript" src="<?php echo $themeurl ?>/scripts/gsap-lib/SplitText.min.js" defer></script>
    <script type="text/javascript" src="<?php echo $themeurl ?>/scripts/gsap-lib/ScrollTrigger.min.js" defer></script>
    <script type="text/javascript" src="<?php echo $themeurl ?>/scripts/gsap-lib/ScrollToPlugin.min.js" defer></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/TextPlugin.min.js" defer></script>
	<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrambleTextPlugin.min.js" defer></script>
    <script type="text/javascript" src="<?php echo $themeurl ?>/scripts/gsap-lib/MotionPathPlugin.min.js" defer></script>
    <script type="text/javascript" src="<?php echo $themeurl ?>/scripts/gsap-lib/MorphSVGPlugin.min.js" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" defer></script>
    <script type="text/javascript" src="https://unpkg.com/@barba/core" defer></script>
    <script type="text/javascript" src="<?php echo $themeurl ?>/scripts/global.min.js?v=3" defer></script>
    <script type="text/javascript" src="<?php echo $themeurl ?>/scripts/page.min.js?v=3" defer></script>
	<!-- Service page -->
 	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/service.css">
	<!-- <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/common-scripts.js" defer></script> -->
	<!-- Service page -->
<body <?php body_class("");?>  data-barba="wrapper">

<?php
// $checkoutPage = ( is_checkout() && empty( is_wc_endpoint_url('order-received')) );
// if( !$checkoutPage ):
//     render_shopping_cart();
// endif; 
?>

<?php if( have_rows('header_main', 'option') ):
    the_row(); 
    $logo = get_sub_field('logo');
    $cart_icon = get_sub_field('cart_icon');?>
    <div class="nav-icons nav-icon__logo">
        <a href="/"><img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>" width="59" height="55"/></a>
    </div>

    <div class="nav-icons nav-icon__toggle link">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
    
<?php endif; ?>
<div class="nav-container">
        <div class="inner">
            <a class="nav__preview" target="_blank" rel="noopener noreferrer" href="https://www.instagram.com/madegood.world/">
                <div class="img-wrapper">
                    <div class="circles">
                        <?php if( have_rows('header_navigation', 'option') ):
                            while( have_rows('header_navigation', 'option') ) : the_row();
                                $nav_circle_text = get_sub_field('nav_circle_text');?>
                                <?php if ($nav_circle_text) : 
                                    echo wp_get_attachment_image( $nav_circle_text['id'], 'medium', false, array( "class" => "circle", "loading" => "lazy" ) );
                                endif;  
                            endwhile;
                        endif;?>
                    </div>
                    <?php
                    if( have_rows('header_navigation', 'option') ):
                        while( have_rows('header_navigation', 'option') ) : the_row();
                            $nav_image = get_sub_field('nav_image');?>
                            <?php if ($nav_image) : 
                                echo wp_get_attachment_image( $nav_image['id'], 'medium', false, array( "class" => "preview-image", "loading" => "lazy" ) );
                            endif;  ?>
                        <?php  
                        endwhile;
                    endif;?>
                    <div class="col">
                        <img src="<?php echo $themeurl ?>/assets/globe_icon.svg" alt="text-svg" class="globe">
                        <img src="<?php echo $themeurl ?>/assets/localeverywhere.svg" alt="text-svg" class="text">
                    </div>

                </div>
            </a>

            <ul>
                <?php
                    if( have_rows('header_navigation', 'option') ):
                        while( have_rows('header_navigation', 'option') ) : the_row();

                            $nav_item = get_sub_field('nav_item');
                            $nav_link = get_sub_field('nav_link');

                            ?>

                            <h1> 
                                <a class="hover__headline nav-item" href="<?php echo esc_url( $nav_link ); ?>">
                                    <span class="major"><?php echo $nav_item; ?></span>
                                    <span class="minor"><?php echo $nav_item; ?></span>
                                </a>
                            </h1>
        
                        <?php  
                        endwhile;
                        else :
                    endif;
                ?>    
            </ul>

            <aside class="nav__contact-details">
                <div class="row">
                    <?php $social_media_icons = get_field('header_social_media', 'options');
                        if($social_media_icons): 
                            foreach ($social_media_icons as $icon): ?>
                                <a href="<?php echo $icon["link"]?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo $icon["icon"]["url"]?>" alt="social-icon"></a>
                            <?php endforeach; ?>
                        <?php endif; 
                    ?>
                </div>
                <?php the_field('header_contact_details', 'option'); ?>
            </aside>
        </div>
    </div>
<div class="cursor">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 750 750" style="width: 100%">
        <defs>
            <style>
            .mask-image {
                opacity: 0;
                transition: opacity 0.4s;
            }
            body.init__cursor-shapes.has-rect .mask-image-1 {
                opacity: 1;
            }
            body.init__cursor-shapes.has-halfcircle .mask-image-2 {
                opacity: 1;
            }
            body.init__cursor-shapes.has-circle .mask-image-3 {
                opacity: 1;
            }
            </style>
            <!-- CURSOR -->
            <circle id="cursor"  cx="375" cy="375" r="375" />
            <!-- RECTANGLE -->
            <rect
                id="msvgRectangle"
                y="70"
                width="750"
                height="562.5"
            />
            <!-- HALF CIRCLE -->
            <path
                id="msvgHalfCircle"
                d="M0,792.1V373l0,0C1.1,165.9,169.8-1.1,377,0c205.6,1.1,372,167.5,373,373l0,0v419.1H0z"
            />
            <!-- CIRCLE -->
            <circle
                id="msvgCircle"
                data-name="Ellipse 164"
                cx="375"
                cy="375"
                r="375"
            />
            <!-- PENTAGON -->
            <polygon
                id="msvgPentagon"
                points="522.74 557.26 163.96 557.26 53.09 216.04 343.35 5.15 633.61 216.04 522.74 557.26"
            />
            <!-- STAR -->
            <polygon
                id="msvgStar"
                points="348.7 0 398.78 155.26 536.94 68.51 475.51 219.64 637.1 242 492.9 318.28 602.32 439.28 442.82 405.02 448.86 568.04 348.7 439.28 248.54 568.04 254.58 405.02 95.08 439.28 204.5 318.28 60.3 242 221.89 219.64 160.46 68.51 298.62 155.26 348.7 0"
            />

        </defs>
        <clipPath id="mask">
            <use xlink:href="#cursor"/>
        </clipPath>
        <image
            style="clip-path:url(#mask);width:100%;height:100%;"
            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQIW2P45MjwHwAFjwIzl4b2KAAAAABJRU5ErkJggg=="
        />
        <?php if ($services): $i=0?>
        <?php foreach ($services as $service): $i++ ?>
        <image
            class="mask-image mask-image-<?php echo $i?>"
            style="clip-path:url(#mask);width:100%;height:100%;"
            xlink:href="<?php echo $service['home__services_service_video']['url'] ?>"
        />
        <?php endforeach ?>
        <?php endif ?>
    </svg>
</div>
<div class="page-transition">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>
<div id="smooth-wrapper" class="barba-container" data-barba="container" data-barba-namespace="<?php if ($template_path) {echo $templates[$template_path];} else {echo get_post_type();}?>">
    <main id="smooth-content" class="loading">



