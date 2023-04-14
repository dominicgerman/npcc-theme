<?php

get_header();

?>

<main>
    <!----------- HEADER ------------>
    <header class="section header--inner" style="
          background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.9) 20%, rgba(0, 0, 0, 0.4) 92.6%),
            url(<?php echo get_theme_file_uri('/images/archive.jpg'); ?>);
        ">
        <div class="header--inner__content">
            <h2 class="header--inner__headline">All Events</h2>
            <p class="header--inner__details">

            </p>
        </div>
    </header>

    <!----------- EVENTS LIST ------------>
    <section class="section list">
        <div class="list__content">
            <ul>
                <?php
                $today = date('Ymd');
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'posts_per_page' => 10,
                    'post_type' => 'event',
                    'meta_key' => 'event_date',
                    'orderby' => 'meta_value',
                    'order' => 'ASC',
                    'paged' => $paged,
                    'meta_query' => array(
                        array(
                            'key' => 'event_date',
                            'value' => $today,
                            'compare' => '>=',
                            'type' => 'DATE'
                        )
                    )
                );
                $loop = new WP_Query($args);
                if ($loop->have_posts()) :

                    while ($loop->have_posts()) : $loop->the_post();
                        $meta_date = get_field('event_date');
                        $eventDate = DateTime::createFromFormat('Ymd', $meta_date);
                        $eventColor = get_field('liturgical_color');
                        $bulletinLink = get_field('bulletin');
                        $lectionaryTexts = get_field('lectionary_texts');
                        $vimeoLink = get_field('vimeo_link');
                        $eventContent = get_the_content();
                ?>
                        <li>
                            <div class="list__image-box" style="background-image: url('<?php
                                                                                        if (has_post_thumbnail()) {
                                                                                            the_post_thumbnail_url();
                                                                                        } else {
                                                                                            echo get_theme_file_uri('/images/spotlight.jpg');
                                                                                        }
                                                                                        ?>');">
                                <a href="<?php the_permalink(); ?>">
                                </a>
                            </div>
                            <article>
                                <h4>
                                    <a href="<?php the_permalink(); ?>" class="list__title"><?php the_title(); ?></a>
                                    <span class="list__date"><?php echo $eventDate->format('D, M dS'); ?></span>
                                </h4>
                                <p class="list__description">
                                    <?php
                                    echo wp_trim_words($eventContent, 40);
                                    ?>
                                </p>
                                <div class="list__links">
                                </div>
                            </article>
                        </li>
                        <hr />
                <?php
                    endwhile;
                endif;
                ?>
            </ul>
        </div>
        <div class="list__page-numbers">
            <?php
            $big = 999999999;
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $loop->max_num_pages,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;'
            ));
            ?>
        </div>
        <?php wp_reset_postdata(); ?>
    </section>
</main>

<?php get_footer(); ?>