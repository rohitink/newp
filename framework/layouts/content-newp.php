<?php
/**
 * @package Newp
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 col-sm-4 newp'); ?>>
	<div class="newp-wrapper">	
		<div class="featured-thumb">
			<?php if (has_post_thumbnail()) : ?>	
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_post_thumbnail('newp-pop-thumb'); ?></a>
			<?php endif; ?>
		</div><!--.featured-thumb-->

		<div class="out-thumb">
			<header class="entry-header">
				<h2 class="entry-title title-font"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<span class="entry-excerpt"><?php the_excerpt(); ?></span>
			</header><!-- .entry-header -->
		</div><!--.out-thumb-->		
	</div>	
		
</article><!-- #post-## -->