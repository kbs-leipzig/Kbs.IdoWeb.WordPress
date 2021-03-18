<?php /* Template Name: CustomPageSingle */ ?>
<?php get_header(); ?>

<main class="page-content">
<header class="entry-header">
<?php //bornholm_the_post_header( 'h1', $post ) ?>
</header>
<div class="entry-content">

<!-- LOOP --- !-->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php the_content(); ?>
<?php endwhile; endif; ?>
<!-- END LOOP --- !-->
</div>

</main>
<?php get_sidebar();
get_footer();