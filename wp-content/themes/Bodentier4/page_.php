<?php get_header(); ?>
<main role="main">
<?php
while ( have_posts() ) {
the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="entry-header">
</header>
<?php get_template_part('partials/kbs_parallax_header'); ?>

<div class="entry-content">
<?php the_content();
//bornholm_paginated_posts_navigation(); ?>
</div>
</article>
<?php } ?>
Hier PAGE.PHP
</main>
<?php get_sidebar();
get_footer();