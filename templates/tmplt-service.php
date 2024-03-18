<?php
/* Template Name: service */

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
						<img src="<?php echo $service_cta_section['logo']['url'];?>" alt="">
					</a>
				</div>
				<nav class="service-nav-wrap">
					<ul>
						<li><a href="#work-about">ABOUT</a></li>
						<li><a href="#services-wrap">SERVICES</a></li>
						<li><a href="#our-work">WORK</a></li>
						<li><a href="#why-work">WHY</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</section>
	<?php endif; ?>

		
	
	<?php
		$work_about_section = get_field( 'work_about_section');
		if(!empty($work_about_section)) :
	?>
	<section class="work-about-wrap scroll-section" id="work-about">
		<div class="container flex">
			<div class="work-about-inner">
				<div class="work-about-content">
					<h2><?php echo $work_about_section['heading'];?></h2>
					<p><?php echo $work_about_section['paragraph'];?> <a href="<?php echo $work_about_section['link']; ?>">MADEGOOD.WORLD</a> </p>
				</div>
				<div class="work-about-thumb">
					<figure>
						<img src="<?php echo $work_about_section['thumb']['url'];?>" alt="" loading="lazy">
					</figure>
				</div>
			</div>
			<div class="additional-services-alart-wrap">
				<div class="additional-services-alart flex">
					<img src="<?php echo $work_about_section['network_logo']['url'];?>" alt="network">
					<p text-randomize="true"><?php echo $work_about_section['network_paragraph'];?></p>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
		$services_section = get_field( 'services_section');
		if(!empty($services_section)) :
	?>
	<section class="services-wrap scroll-section" id="services-wrap">
		<div class="container">
			<div class="services-title flex">
				<h2><?php echo $services_section['heading'];?></h2>
				<hr>
			</div>
		</div>
		<div class="services-item-wrap flex">
			<?php
				$services_items = $services_section['services_items'];
				if(!empty($services_items)) :
				foreach($services_items as $services_items):
			?>
			<a href="<?php echo $services_items['services_items_link']; ?>" class="services-item">
				<div class="services-item-title">
					<h3><?php echo $services_items['heading'];?></h3>
				</div>
				<div class="services-item-thumb">
					<img src="<?php echo $services_items['thumb']['url'];?>" alt="" loading="lazy">
				</div>
			</a>
			<?php endforeach; endif; ?>
			
		</div>
		<div class="container">
			<div class="additional-services flex">
				<div class="additional-services-content">
					<h5><?php echo $services_section['bottom_heading'];?></h5>
					<p class="lead-text"><?php echo $services_section['lead_text'];?></p>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	
	

	<?php
		$our_work_section = get_field( 'our_work_section');
		if(!empty($our_work_section)) :
	?>
	<section class="our-work-wrap scroll-section" id="our-work">
		<div class="container flex">
			<div class="our-work-content-wrap flex"> 
				<div class="our-work-title flex">
					<h2><?php echo $our_work_section['heading'];?></h2>
					<hr>
				</div>
				<div class="our-work-content flex">
					<p class="lead-text"><?php echo $our_work_section['paragraph'];?></p>
				</div>
			</div>
			<div class="work-item-wrap flex">
				
				<div class="work-item flex">
					<div class="work-item-title">
						<h5  text-randomize="true"><?php echo $our_work_section['work_item_title_one'];?></h5>
					</div>
					<div class="work-component-wrap">
							<?php
								$args = array(
								  'post_type' => 'works',
								  'posts_per_page' => 8, 
								  'category_name' => 'services-campaing-assets'
								);

								$query = new WP_Query($args);
								if ($query->have_posts()) :
								  while ($query->have_posts()) : $query->the_post();
								?>
								<?php $categories = get_field('categories');?>
									<a href="<?php the_permalink(); ?>" class="work-component" target="_blank"> <?php if($categories){foreach ($categories as $category){echo $category. " ";}}?>
										<figure>
											<?php if(has_post_thumbnail()){?>
												<img src="<?php the_post_thumbnail_url()?>" alt="">
											<?php } ?>
										</figure>
										<div class="work-component-content">
											<h3><?php the_title() ?></h3>
											<p><?php echo wp_trim_words( get_the_content(), 32);?></p>
											<p>SERVICES | SERVICES | SERVICES SERVICES | SERVICES | SERVICES </p>
										</div>
									</a>
								<?php
								  endwhile;
								  wp_reset_postdata();
								else :
								  echo '<p>No projects found.</p>';
								endif;
							?>
					</div>
				</div>
				
				<div class="work-item flex production-assets">
					<div class="work-item-title">
						<h5 text-randomize="true"><?php echo $our_work_section['work_item_title_two'];?></h5>
					</div>
					<div class="work-component-wrap">
							<?php
								$args = array(
								  'post_type' => 'works',
								  'posts_per_page' => 8, 
								  'category_name' => 'services-content-production'
								);

								$query = new WP_Query($args);
								if ($query->have_posts()) :
								  while ($query->have_posts()) : $query->the_post();
								?>
								<?php $categories = get_field('categories');?>
									<a href="<?php the_permalink(); ?>" class="work-component" target="_blank"> <?php if($categories){foreach ($categories as $category){echo $category. " ";}}?>
										<figure>
											<?php if(has_post_thumbnail()){?>
												<img src="<?php the_post_thumbnail_url()?>" alt="">
											<?php } ?>
										</figure>
										<div class="work-component-content">
											<h3><?php the_title() ?></h3>
											<p><?php echo wp_trim_words( get_the_content(), 32);?></p>
											<p>SERVICES | SERVICES | SERVICES SERVICES | SERVICES | SERVICES </p>
										</div>
									</a>
								<?php
								  endwhile;
								  wp_reset_postdata();
								else :
								  echo '<p>No projects found.</p>';
								endif;
							?>
					</div>
				</div>
				
				<div class="work-item flex">
					<div class="work-item-title">
						<h5 text-randomize="true"><?php echo $our_work_section['work_item_title_three'];?></h5>
					</div>
					<div class="work-component-wrap">
						<?php
								$args = array(
								  'post_type' => 'works',
								  'posts_per_page' => 8, 
								  'category_name' => 'services-event-production'
								);

								$query = new WP_Query($args);
								if ($query->have_posts()) :
								  while ($query->have_posts()) : $query->the_post();
								?>
								<?php $categories = get_field('categories');?>
									<a href="<?php the_permalink(); ?>" class="work-component" target="_blank"> <?php if($categories){foreach ($categories as $category){echo $category. " ";}}?>
										<figure>
											<?php if(has_post_thumbnail()){?>
												<img src="<?php the_post_thumbnail_url()?>" alt="">
											<?php } ?>
										</figure>
										<div class="work-component-content">
											<h3><?php the_title() ?></h3>
											<p><?php echo wp_trim_words( get_the_content(), 32);?></p>
											<p>SERVICES | SERVICES | SERVICES SERVICES | SERVICES | SERVICES </p>
										</div>
									</a>
								<?php
								  endwhile;
								  wp_reset_postdata();
								else :
								  echo '<p>No projects found.</p>';
								endif;
							?>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
		$why_work_section = get_field( 'why_work_section');
		if(!empty($why_work_section)) :
	?>
	<section class="why-work-wrap scroll-section" id="why-work">
		<div class="container">
			<div class="why-work-title">
				<h2><?php echo $why_work_section['heading'];?></h2>
			</div>
			<div class="why-work-item-wrap flex">
				<?php
					$why_work_items = $why_work_section['why_work_items'];
					if(!empty($why_work_items)) :
					foreach($why_work_items as $why_work_items):
				?>
				<div class="why-work-item">
					<h5><?php echo $why_work_items['heading'];?></h5>
					<p class="lead-text"><?php echo $why_work_items['paragraph'];?></p>
				</div>
				<?php endforeach; endif; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
		$service_contact_section = get_field( 'service_contact_section');
		if(!empty($service_contact_section)) :
	?>
	<section class="service-contact">
		<div class="container">
			<div class="main-service-contact flex">
				<a href="<?php echo $service_contact_section['service_contact_logo_link']; ?>" class="service-contact-logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/service/BRAND_COLORS_SHAPES.svg" alt="BRAND_COLORS_SHAPES"></a>
				<div class="service-contact-info">
					<h5><?php echo $service_contact_section['heading'];?></h5>
					<a href="<?php echo $service_contact_section['service_contact_link']; ?>"><?php echo $service_contact_section['service_contact_text'];?></a>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

</section>


