<?php
get_header();
$themeurl = get_bloginfo('template_url');
?>

<div class="service-loader">
    <img src="<?php echo $themeurl ?>/assets/MadeGoodCo__M.svg" alt="loader">
</div>

<section class="main-content-wrap service">
	
	<?php
		$service_cta_section = get_field( 'service_cta_section');
		if(!empty($service_cta_section)) :
	?>
	<section class="service-cta-wrap">
		<div class="container">
			<div class="service-cta-inner flex">
				<div class="logo-wrap">
					<a href="<?php echo $service_cta_section['logo_link']; ?>" class="scale-logo">
						<img src="<?php echo $service_cta_section['logo']['url'];?>" alt="" loading="lazy">
					</a>
				</div>
				<nav class="service-nav-wrap">
					<ul>
						<li><a href="https://madegood.world/service/#work-about" target="_blank">aBOUT</a></li>
						<li><a href="https://madegood.world/service/#services-wrap" target="_blank">SERVICES</a></li>
						<li><a href="javascript:void(0)" class="current_page">WORK</a></li>
						<li><a href="https://madegood.world/service/#why-work" target="_blank">WHY</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</section>
	<?php endif; ?>

	
	<?php
		$work_single_hero_section = get_field( 'work_single_hero_section');
		if(!empty($work_single_hero_section)) :
	?>
	<section class="work-single-hero">
		<div class="container">
			<div class="work-single-inner">
				<div class="work-single-heading">
					<h1><?php echo $work_single_hero_section['heading'];?></h1>
					<span><?php echo $work_single_hero_section['sub_heading'];?></span>
					<p><?php echo $work_single_hero_section['paragraph'];?></p>
				</div>
				<div class="work-single-thumb">
					<figure>
						<img src="<?php echo $work_single_hero_section['thumb']['url'];?>" alt="" loading="lazy">
					</figure>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>
	
	<?php
		$work_single_description_section = get_field( 'work_single_description_section');
		if(!empty($work_single_description_section)) :
	?>
	<section class="work-single-description">
		<div class="container">
			<div class="work-single-description-inner flex">
				<aside class="work-single-description-left">
					<h5  text-randomize="true"><?php echo $work_single_description_section['heading'];?></h5>
					<h4><?php echo $work_single_description_section['sub_heading'];?></h4>
					<p><?php echo $work_single_description_section['paragraph'];?></p>
				</aside>
				<div class="work-single-description-item-wrap flex">
					<?php
						$work_single_description_items = $work_single_description_section['work_single_description_items'];
						if(!empty($work_single_description_items)) :
						foreach($work_single_description_items as $work_single_description_items):
					?>
					<div class="work-single-description-item">
						<h5 text-randomize="true"><?php echo $work_single_description_items['heading'];?></h5>
						<p><?php echo $work_single_description_items['paragraph'];?></p>
					</div>
					<?php endforeach; endif; ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>
	
	<?php
		$work_single_line_section = get_field( 'work_single_line_section');
		if(!empty($work_single_line_section)) :
	?>
	<section class="work-single-line-wrap">
		<div class="container">
			<span><em text-randomize="true"><?php echo $work_single_line_section['line_left_text'];?></em> <dfn text-randomize="true"><?php echo $work_single_line_section['line_right_text'];?></dfn></span>
		</div>
	</section>
	<?php endif; ?>
	
	<?php
		$work_single_video_section = get_field( 'work_single_video_section');
		if(!empty($work_single_video_section)) :
	?>
	<section class="work-single-video-wrap">
		<video controls autoplay muted disablePictureInPicture controlsList="nodownload" poster="https://madegood.world/wp-content/uploads/2024/02/video-thumb.png">
			<source src="<?php echo $work_single_video_section['video']['url'];?>" type="video/mp4">
		</video>
	</section>
	<?php endif; ?>
	
	<?php
		$work_single_line_tow_section = get_field( 'work_single_line_tow_section');
		if(!empty($work_single_line_tow_section)) :
	?>
	<section class="work-single-line-wrap">
		<div class="container">
			<span><em text-randomize="true"><?php echo $work_single_line_tow_section['line_left_text'];?></em> <dfn text-randomize="true"><?php echo $work_single_line_tow_section['line_right_text'];?></dfn></span>
		</div>
	</section>
	<?php endif; ?>
	
	<?php
		$work_single_gallery_section = get_field( 'work_single_gallery_section');
		if(!empty($work_single_gallery_section)) :
	?>
	<section class="work-single-gallery-wrap">
		<div class="container">
			<div class="work-single-gallery-item-wrap flex">
				<?php
					$work_single_gallery_items = $work_single_gallery_section['work_single_gallery_items'];
					if(!empty($work_single_gallery_items)) :
					foreach($work_single_gallery_items as $work_single_gallery_items):
				 ?>
				<div class="work-single-gallery-item">
					<figure>
						<img src="<?php echo $work_single_gallery_items['gallery_thumb']['url'];?>" alt="" loading="lazy">
					</figure>
				</div>
				<?php endforeach; endif; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>
	
	<?php
		$work_single_line_three_section = get_field( 'work_single_line_three_section');
		if(!empty($work_single_line_three_section)) :
	?>
	<section class="work-single-line-wrap">
		<div class="container">
			<span><em  text-randomize="true"><?php echo $work_single_line_three_section['line_left_text'];?></em> <dfn  text-randomize="true"><?php echo $work_single_line_three_section['line_right_text'];?></dfn></span>
		</div>
	</section>
	<?php endif; ?>
	
	<?php
		$work_single_slider_section = get_field( 'work_single_slider_section');
		if(!empty($work_single_slider_section)) :
	?>
	<section class="work-single-slider-wrap">
		<div class="work-single-slider-title">
			<h6><?php echo $work_single_slider_section['heading'];?></h6>
		</div>
		<div class="work-single-slider-item-wrap">
			<?php
				$work_single_slider_items = $work_single_slider_section['work_single_slider_items'];
				if(!empty($work_single_slider_items)) :
				foreach($work_single_slider_items as $work_single_slider_items):
			?>
			<div class="work-single-slider-item">
				<figure>
					<img src="<?php echo $work_single_slider_items['slider_thumb']['url'];?>" alt="" loading="lazy">
				</figure>
			</div>
			<?php endforeach; endif; ?>
		</div>
	</section>
	<?php endif; ?>
	
	<?php
		$explore_more_work_section = get_field( 'explore_more_work_section');
		if(!empty($explore_more_work_section)) :
	?>
	<section class="explore-more-work-wrap">
		<div class="container">
			<div class="explore-more-work-inner">
				<a href="<?php echo $explore_more_work_section['explore_more_work_btn']; ?>" class="btn"><?php echo $explore_more_work_section['btn_text'];?></a>
			</div>
		</div>
	</section>
	<?php endif; ?>
	
	<?php
		$work_single_explore_section = get_field( 'work_single_explore_section');
		if(!empty($work_single_explore_section)) :
	?>
	<section class="work-single-explore-more">
		<div class="container">
			<div class="work-single-explore-more-inner">
				<div class="work-single-explore-more-heading">
					<h4 text-randomize="true"><?php echo $work_single_explore_section['heading'];?></h4>
				</div>
				<div class="work-single-explore-more-item-wrap flex">
					<?php
						$work_single_explore_items = $work_single_explore_section['work_single_explore_items'];
						if(!empty($work_single_explore_items)) :
						foreach($work_single_explore_items as $work_single_explore_items):
					?>
					<a href="<?php echo $work_single_explore_items['explore_items_link']; ?>" class="work-single-explore-more-item">
						<div class="work-single-explore-more-thumb">
							<figure>
								<img src="<?php echo $work_single_explore_items['explore_thumb']['url'];?>" alt="" loading="lazy">
							</figure>
						</div>
						<div class="work-single-explore-more-content">
							<span><?php echo $work_single_explore_items['client_name_text'];?> <img src="<?php echo get_template_directory_uri(); ?>/assets/service-single/arrow.svg" alt=""></span>
						</div>
					</a>
					<?php endforeach; endif; ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>
	
	
</section>
 
