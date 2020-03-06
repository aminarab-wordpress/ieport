<!-- ArchivePageTemplate-->
<!-- Name -->
<!-- ${Name} -->
<!-- customFieldNames -->
<!--${customFieldNames}-->
<!-- shortCodes -->
<!-- ${shortCodes}-->
<!-- dynamicSideBars -->
<!-- ${dynamicSideBars}-->
<!-- themeOptions -->
<!-- ${themeOptions} -->
<h1>${Name}</h1>
<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="page-header">
				<h1><?php wp_title(''); ?></h1>
			</div>
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
	 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				<?php /* If this is a category archive */ if (is_category()) { ?>
					<h2>__( 'Archive for the ', 'hms_d' )&#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
				<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<h2>__( 'Posts Tagged ', 'hms_d' )&#8216;<?php single_tag_title(); ?>&#8217;</h2>
				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<h2>__( 'Archive for ', 'hms_d' )<?php the_time('F jS, Y'); ?></h2>
				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<h2>__( 'Archive for ', 'hms_d' )<?php the_time('F, Y'); ?></h2>
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<h2>__( 'Archive for ', 'hms_d' )<?php the_time('Y'); ?></h2>
				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<h2>__( 'Author Archive', 'hms_d' )</h2>
				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<h2>__( 'Blog Archives', 'hms_d' )</h2>
				<?php } ?>
	 			<article <?php post_class() ?>>
					<h2 id="post-<?php the_ID(); ?>">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<p>
						<em> By <?php the_author(); ?> on <?php echo the_time('l, F jS, Y');?> in <?php the_category( ', ' ); ?>.
	              			<a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
						</em>
					</p>            
	            	<?php the_excerpt(); ?>
	            	<hr>
				</article>
				<?php endwhile; ?>	
			<?php else : ?>
	 			<div class="page-header">
					<h1>Oh no!</h1>
				</div>
				<p>__( 'Nothing found', 'hms_d' )</p>
			<?php endif; ?>
    	</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>