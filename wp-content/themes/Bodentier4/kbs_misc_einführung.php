<?php /* Template Name: kbs_misc_einfuehrung */ ?>
<?php get_header(); ?>

<main class="page-content">
<header class="entry-header">
</header>
<div class="page-content">
		<!-- RD Parallax-->
		<?php get_template_part('partials/kbs_parallax_header'); ?>

	<!-- CONTENT -->    		
    <section class="text-md-left section-80 section-md-110">
        <div class="shell">
            <div class="range">
                <div class="cell-md-11">
					<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
					<?php endif; ?>

                    <!-- Terms-list-->
                    <!-- dl class="list-terms">
                        < dt class="h4">Einführung</dt>
                        <dd>
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. 
							irmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.   This is important; we hope you will take time to read it carefully.
                            Remember, you can find controls to manage your information and protect your privacy and
                            security. We’ve tried
                            to keep it as simple as possible.
                        </dd>
                    </dl -->
                </div>
            </div>
        </div>
    </section> 
</div>
</main>
<?php get_footer(); ?>