<?php get_header() ?>
	 	    	<article>
	 	    		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	 	    		<div class="post">
		 	    		<div class="title">
		 	    			 <a href="<?php the_permalink('') ?>" title="<?php the_title(); ?><?php setPostViews(get_the_ID()); ?>"><h3><?php the_title('') ?></h3></a>
		 	    		</div>
		 	    		<div class="post-meta">
		 	    			<time class="publish" datetime="<?php the_time() ?>" pubdate="">ۋاقىت: <?php the_time('H:m:s') ?></time>
		 	    			<span class="author">ئاپتۇر: <?php the_author( ) ?></span>
		 	    			
		 	    			<span class="category">سەھىپە: <?php the_category(', ') ?></span>		 	    			
		 	    			<span class="view">كۆرۈلۈشى: <?php echo getPostViews(get_the_ID()); ?></span>
		 	    			<span class="comments">باھا:  <?php comments_popup_link(' يوق', '1','%'); ?></span>
		 	    		</div>
		 	    		<div class="thumbnail">
							<?php if ( has_post_thumbnail() ) { ?> 
							<a href="<?php the_permalink() ?>"><img src="<?php post_thumbnail_src(635,278); ?>" width="635" height="278" alt="<?php the_title(); ?>" class="entry-image" /></a>
				
							<?php } ?>

						</div>
						<p><?php echo wp_trim_words( get_the_content(), 80 ); ?></p>
						
						
	 	    		</div>
	 	    		
	 	    		<?php endwhile; endif;?>
	 	    		 <div class="pagenavi"><?php pagenavi();?></div>
				</article>

				<?php get_sidebar() ?>
	  
<?php get_footer( ) ?>

