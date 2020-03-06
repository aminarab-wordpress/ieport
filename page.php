<?php get_header(); ?>
<div id="main-content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>
			<div class="entry">
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => __( 'Pages: ', 'ieport_d' ), __( 'next_or_number', 'ieport_d' ) => __( 'number', 'ieport_d' ))); ?>
			</div>
			<?php edit_post_link(__( 'Edit this entry.', 'ieport_d' ), '<p>', '</p>'); ?>
		</div>
		<?php // comments_template(); ?>
	<?php endwhile; endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>