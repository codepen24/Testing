<?php get_header();?>						
	<div class="holder">
		<div class="wptheme-container">
			<div class="container">
				<div class="row">
					<div class="<?php if (is_active_sidebar( 'sidebar-1' )) { ?>col-sm-12<?php } else { ?>col-sm-12<?php } ?>">
						<?php if( have_posts() ) { the_post(); ?>
							<div id="post-<?php the_ID();?>" <?php post_class(); ?>>
								<h1 class="entry-title"><?php the_title(); ?></h1>
								<?php if ( has_post_thumbnail() ) { ?>
<div class="row">
								<div class="wptheme-image">

									<div class="col-sm-4">
										<?php the_post_thumbnail('full',array('class'=>'img-responsive'));?>
									</div>
									<div class="col-sm-8">
										<h2>Position : <?php the_field('team_position');?></h2>
										<h2>Location : <?php the_field('team_location');?></h2>
									</div>
</div>
								</div>
								<?php } ?>
<div class="row">
								<div class="wptheme-content">
									<?php wpautop(the_content());?>
								</div>
</div>
								<div class="clearfix"></div>
							</div>
						<?php } ?>
						<?php wp_reset_postdata(); ?>
					</div>
					<?php if (is_active_sidebar( 'sidebar-1' )) { ?>
					 <div class="col-sm-4" style="display:none;">
						 <?php get_sidebar(); ?>    
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();?>