<!-- this is for pages -->

<?php

get_header();

while (have_posts()) {
    the_post();
    $parentId = wp_get_post_parent_id(get_the_ID());
?>
    <main>
        <!----------- HEADER ------------>
        <header class="section header--inner" style="
          background-image: linear-gradient(
              90deg,
              #000000 0%,
              rgba(0, 0, 0, 0) 92.6%
            ),
            url(<?php if (has_post_thumbnail()) {
                    echo get_the_post_thumbnail_url();
                } else {
                    echo get_theme_file_uri('/images/spotlight.jpg');
                }
                ?>);
        ">
            <div class="header--inner__content">
                <h2 class="header--inner__headline">
                    <?php the_title(); ?>
                </h2>
                <p class="header--inner__details">
                </p>
            </div>
        </header>

        <!----------- MAIN ------------>
        <section class="main--inner">
            <div class="main--inner__content">
                <?php the_content(); ?>
            </div>
        </section>
    </main>

<?
}

get_footer();

?>