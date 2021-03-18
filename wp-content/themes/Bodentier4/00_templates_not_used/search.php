<?php
/*
Template Name: search.php
*/
?>
<?php get_header(); ?>


<?php //echo "Hier kommt mein tolles PHP-Script bzw. der PHP-Code rein!"; ?>
<?php if (have_posts()) : ?>
    <p class="info">Deine Suchergebnisse f&uuml;r '<strong><?php echo $s ?></strong>'</p>
    <br/>
       <?php while (have_posts()) : the_post(); //The Loop ?>
	   <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
<?php the_excerpt(); // Vorschautext oder the_content(); ?>
<?php endwhile; ?>

    <?php endif; ?>
	
	
 
 
<?php get_footer(); ?>