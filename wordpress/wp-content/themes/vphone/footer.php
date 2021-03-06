<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vphone
 */

?>

</div><!-- #content -->

<?php if(!is_page_template('page-templates/fronpage.php')) { ?>


	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			© 2016 vphone
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php } ?>

<?php wp_footer(); ?>

</body>
</html>
