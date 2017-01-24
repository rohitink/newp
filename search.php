<?php
/**
 * The template for displaying search results pages.
 *
 * @package newp
 */

get_header(); ?>

	<section id="primary" class="<?php do_action('newp_primary-width') ?> content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header title-font">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'newp' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				  */
				do_action('newp_blog_layout'); 
				?>

			<?php endwhile; ?>

			<?php newp_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
