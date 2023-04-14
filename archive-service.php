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
            <h2 class="header--inner__headline">Sunday Worship Archives</h2>
            <p class="header--inner__details">
                Below are links to the full videos of past worship services along with the bulletin and lectionary Bible passages for each week.
            </p>
        </div>
    </header>

    <!----------- SERVICES LIST ------------>
    <section class="section list">
        <div class="list__content">
            <ul>

                <?php
                $inc = 1;
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'posts_per_page' => 10,
                    'post_type' => 'service',
                    'meta_key' => 'service_date',
                    'orderby' => 'meta_value',
                    'order' => 'DES',
                    'paged' => $paged
                );
                $loop = new WP_Query($args);
                if ($loop->have_posts()) :

                    while ($loop->have_posts()) : $loop->the_post();
                        $meta_date = get_field('service_date');
                        $serviceDate = DateTime::createFromFormat('Ymd', $meta_date);
                        $serviceColor = get_field('liturgical_color');
                        $bulletinLink = get_field('bulletin');
                        $lectionaryTexts = get_field('lectionary_texts');
                        $vimeoLink = get_field('vimeo_link');
                        $serviceImage = get_field('service_image');

                        if ($inc == 1) {
                        } else {

                ?>
                            <li>
                                <div class="list__image-box" style="background-image: url('<?php
                                                                                            if (has_post_thumbnail()) {
                                                                                                the_post_thumbnail_url();
                                                                                            } else {
                                                                                                echo get_theme_file_uri('/images/spotlight.jpg');
                                                                                            }
                                                                                            ?>');">
                                    <a href="<?php echo $vimeoLink; ?>">
                                    </a>
                                </div>
                                <article>
                                    <h4>
                                        <a href="<?php echo $vimeoLink ?>" target="_blank" class="list__title <?php echo $serviceColor ?>"><?php the_title(); ?></a>
                                        <span class="list__date"><?php echo $serviceDate->format('D, M jS'); ?></span>
                                    </h4>
                                    <p class="list__description">
                                        <?php if (has_excerpt()) {
                                            echo wp_trim_words(get_the_excerpt(), 40);
                                        } else {
                                            echo wp_trim_words(get_the_content(), 40);
                                        }  ?>
                                    </p>
                                    <div class="list__links">
                                        <a href="<?php echo $lectionaryTexts ?>" target="_blank" class="">View Lectionary Text</a>
                                        |
                                        <a href="<?php echo $bulletinLink ?>" target="_blank" class="">View the Bulletin</a>
                                    </div>
                                </article>
                            </li>
                            <hr />
                <?php
                        }
                        $inc++; // increment counter
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