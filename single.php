<?php get_header() ?>
	 	    	<article>
	 	    		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	 	    		<div class="post">
		 	    		<div class="title">
		 	    			 <a href="<?php the_permalink('') ?>" title="<?php the_title(); ?><?php setPostViews(get_the_ID()); ?>"><h3><?php the_title('') ?></h3></a>
		 	    		</div>
		 	    		<div class="post-meta">
		 	    			<time class="publish" datetime="<?php the_time() ?>" pubdate="">ۋاقىت: <?php the_time('Y-m-d') ?></time>
		 	    			<span class="author">ئاپتۇر: <?php the_author( ) ?></span>
		 	    			
		 	    			|<span class="category">سەھىپە: <?php the_category(', ') ?></span>
		 	    			
		 	    			|<span class="view">كۆرۈلۈشى: <?php echo getPostViews(get_the_ID()); ?></span>
		 	    			|<span class="comments">باھا:  <?php comments_popup_link(' يوق', '1','%'); ?></span>

		 	    			
		 	    		</div>
		 	    			<p> <?php the_content() ?></p>
						
	 	    		</div>
	 	    		
		 	    			<p><?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?></p>

		 	    		
	 	    		<?php endwhile; endif;?>
	 	    		 <div class="pagenavi"><?php pagenavi();?></div>
				</article>

				<?php get_sidebar() ?>
	
<?php get_footer( ) ?>

