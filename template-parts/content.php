<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package    learnarmor
 * @version    1.0.0
**/

?>

<article id="post-<?php the_ID(); ?>"  <?php post_class('col-sm-12'); ?>>
	<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<div class="entry-meta">
			<?php learnarmor_posted_on(); ?>
			<?php if ( comments_open() ) : ?>
			<span class="comments-link">'
			<?php comments_popup_link( esc_html__( 'Leave a comment', 'learnarmor' ), esc_html__( '1 Comment', 'learnarmor' ), esc_html__( '% Comments', 'learnarmor' ) ); ?>
			</span>
			<?php endif; ?>
			</div><!-- .entry-meta -->
				
	</header><!-- .entry-header -->

	<?php if ( has_post_format( 'audio' )) : ?>
		<img class ="img-responsive" src="<?php echo get_template_directory_uri() . '/' . 'template-parts/images/audio-post-image.jpg'?>" />
		<div class="entry-content">
	<?php else: ?>
		<div class="entry-content">
	<?php endif ?>
	
		<?php if ( has_post_thumbnail()) { ?>
			<div class="post-thumbnail">
		<?php 	the_post_thumbnail() ; 
			echo "</div>";
		 } ?>
		<?php
		the_excerpt( 110, sprintf(/* translators: %s: Name of current post. */
			wp_kses( __( '[...] %s ', 'learnarmor' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'learnarmor' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		
		<?php
		/*
		 * Uncomment  learnarmor_entry_footer to enable Catagory and Tag Links for the Blog Post Page
		 *
		 */
		//learnarmor_entry_footer();
		?>
		<hr>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
