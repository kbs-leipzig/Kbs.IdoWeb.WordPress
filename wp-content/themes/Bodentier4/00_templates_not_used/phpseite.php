<?php
/*
Template Name: phpseite.php
*/
?>
<?php get_header(); ?>
 
 
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
 
 
<div class="post page">
  <h2><?php the_title(); ?></h2>
  <?php the_content(); ?>
</div>
 
 
<?php endwhile; ?>
<?php endif; ?>
 
 
<?php echo "Hier kommt mein tolles PHP-Script bzw. der PHP-Code rein!"; ?>
 
 
<?php get_footer(); ?>