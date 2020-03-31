<?php get_header();  ?>
	<div class="holder">
		<div class="wptheme-container">	
			<div class="container">
				<div class="row">	
				 
						<?php if( have_posts() ) {	
						while( have_posts()) { the_post(); ?>		
						<div id="post-<?php the_ID();?>" <?php post_class(); ?>>
							<h1 class="entry-title"><?php The_title(); ?></h1>		
								<?php if ( has_post_thumbnail() ) { ?>		
							<div class="wptheme-image">		
								<?php the_post_thumbnail('full',array('class'=>'img-responsive'));?>
							</div>		
							<?php } ?>		
							<div class="wptheme-content">		
								<?php the_content(); ?>
							</div>		
							<div class="clearfix"></div>
								
							<br />		
							<hr />		
						</div>		
						<?php } ?>
						<?php } ?>	
						<?php wp_reset_postdata(); ?>	
						
					<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>	
						
						
					<?php } ?>		
				</div>	
			</div>	
		</div>
	</div>
<?php get_footer();?>