<?php

function eventSlider()
{
?>
    <div class="events__content">
        <button class="leftArrow arrow--disabled" aria-label="previous__image">
            <svg width="19" height="34" viewBox="0 0 19 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.387199 17.914L16.6632 33.6083C17.1795 34.1306 18.049 34.1306 18.5924 33.6083C19.1359 33.1121 19.1359 32.2765 18.5924 31.7542L4.59885 18.3057C4.59885 18.3057 4.01587 17.746 4.01587 17.0148C4.01587 16.2836 4.59885 15.7612 4.59885 15.6943L18.5924 2.24578C19.1359 1.7235 19.1359 0.913982 18.5924 0.391708C18.3207 0.130569 17.9675 0 17.6414 0C17.3153 0 16.9349 0.130569 16.6904 0.391708L0.387199 16.0599C-0.129068 16.5561 -0.129068 17.3917 0.387199 17.914Z" fill="#444444" />
            </svg>
        </button>
        <ul class="slider events__slider">

            <?php
            $today = date('Ymd');
            $eventsSliderArgs = array(
                'posts_per_page' => 6,
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'orderby' => 'meta_value',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'event_date',
                        'value' => $today,
                        'compare' => '>=',
                        'type' => 'DATE'
                    )
                )
            );
            $eventsSliderLoop = new WP_Query($eventsSliderArgs);
            if ($eventsSliderLoop->have_posts()) :
                while ($eventsSliderLoop->have_posts()) : $eventsSliderLoop->the_post();
                    $meta_date = get_field('event_date');
                    $eventDate = DateTime::createFromFormat('Ymd', $meta_date);
                    $eventTitleString = strip_tags(get_the_title());
            ?>
                    <li class="event card--grey">
                        <a href="<?php the_permalink(); ?>" aria-label="View this event">
                            <div class="events__image" style="background-image: url('<?php if (has_post_thumbnail()) {
                                                                                            the_post_thumbnail_url();
                                                                                        } else {
                                                                                            echo get_theme_file_uri('/images/service-card.jpg');
                                                                                        }  ?>');">

                            </div>
                        </a>
                        <article class="card">
                            <h3 class="events__header">
                                <a href="<?php the_permalink(); ?>" class="events__title" aria-label="View this event"> <?php if (strlen($eventTitleString) > 27) {
                                                                                                                            echo substr($eventTitleString, 0, 27);
                                                                                                                            echo '...';
                                                                                                                        } else {
                                                                                                                            echo get_the_title();
                                                                                                                        } ?>
                                </a>
                                <span class="events__date"><?php echo $eventDate->format('D, M dS'); ?></span>
                            </h3>
                            <p>
                                <?php echo wp_trim_words(get_the_content(), 30); ?>
                            </p>
                        </article>
                        <a href="<?php the_permalink(); ?>" target="_blank" class="events__link" aria-label="View this event">View details
                            <svg width="19" height="13" viewBox="0 0 19 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.35 6.15L12.35 0.15C12.16 -0.05 11.84 -0.05 11.64 0.15C11.44 0.34 11.44 0.66 11.64 0.86L16.79 6.01H0.5C0.22 6.01 0 6.23 0 6.51C0 6.79 0.22 7.01 0.5 7.01H16.79L11.64 12.16C11.44 12.36 11.44 12.67 11.64 12.87C11.74 12.97 11.87 13.02 11.99 13.02C12.11 13.02 12.25 12.97 12.34 12.87L18.34 6.87C18.53 6.68 18.53 6.36 18.34 6.16L18.35 6.15Z" fill="" />
                            </svg></a>
                    </li>
            <? endwhile;
            endif;
            ?>

        </ul>
        <button class="rightArrow" aria-label="next__image">
            <svg width="19" height="34" viewBox="0 0 19 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.6128 16.086L2.33679 0.391705C1.82052 -0.130568 0.951019 -0.130568 0.40758 0.391705C-0.13586 0.887865 -0.13586 1.7235 0.40758 2.24578L14.4011 15.6943C14.4011 15.6943 14.9841 16.254 14.9841 16.9852C14.9841 17.7164 14.4011 18.2388 14.4011 18.3057L0.40758 31.7542C-0.13586 32.2765 -0.13586 33.086 0.40758 33.6083C0.679299 33.8694 1.03253 34 1.3586 34C1.68466 34 2.06507 33.8694 2.30962 33.6083L18.6128 17.9401C19.1291 17.4439 19.1291 16.6083 18.6128 16.086Z" fill="#444444" />
            </svg>
        </button>
        <div class="dots"></div>
    </div>
    <a href="<?php echo site_url('/events'); ?>" class="events__button btn">View all events</a>
<?
}

function npcc_files()
{
    wp_enqueue_script('npcc_main_js', get_theme_file_uri('/script.js'), NULL, '1.0', true);
    wp_enqueue_style('custom-fonts', 'https://fonts.googleapis.com/css2?family=Marcellus&family=Montserrat:wght@400;600&display=swap', array(), null);
    wp_enqueue_style('npcc_main_styles', get_theme_file_uri('/styles/style.css'));
}
add_action('wp_enqueue_scripts', 'npcc_files');


function npcc_features()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'npcc_features');


function my_editor_content($content, $post)
{

    switch ($post->post_type) {
        case 'service':
            $content = 'We offer two options for worship every Sunday at 10:30 am (CT). Those who wish to worship in person are welcome to join us a few minutes before, and masks are optional if you are vaccinated. We also livestream the service at live.npcovenant.org at the same time, and we would love to have you join us! Childcare is available for those who come in person, following the Word for the Children. And we invite you join us in the parlors for refreshments following the service each week. Come on down and say hi!';
            break;
        case 'event':
            $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vehicula nunc ex, ultrices interdum nunc sollicitudin eu. Nam et auctor elit. Praesent mollis massa id metus vehicula bibendum. Sed feugiat volutpat gravida. Mauris non massa elit. Morbi vehicula maximus est, nec feugiat mauris mattis eu. Duis non purus egestas, luctus massa eu, porttitor mi.';
        default:
            $content = '';
            break;
    }

    return $content;
}
add_filter('default_content', 'my_editor_content', 10, 2);

add_filter('ai1wm_exclude_content_from_export', 'ignoreFiles');
function ignoreFiles($exclude_filters)
{
    $exclude_filters[] = 'themes/npcc-theme/node_modules';
    return $exclude_filters;
}
