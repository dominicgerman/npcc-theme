<?php get_header(); ?>

<!----------- HEADER ------------>
<?
$heroPost = get_post(185);
$heroContent = $heroPost->post_content;
?>
<header class="header" style="background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.9) 20%, rgba(0, 0, 0, 0.4) 92.6%), url(<?php echo get_the_post_thumbnail_url(185) ?>);">
    <div class="header__banner">
        <span> Join us each Sunday at 10:30AM.</span>
        <a href="https://goo.gl/maps/XbZMVHKcLek7UEoR9" target="_blank">Get directions</a>
    </div>
    <div class="header__content">
        <div class="header__main">
            <? echo $heroContent ?>
        </div>
    </div>
</header>

<!----------- SERVICES ------------>
<section class="section services">
    <div class="services__content">
        <ul class="slider services__slider">

            <?php
            $homepageServices = new WP_Query(array(
                'posts_per_page' => 5,
                'post_type' => 'service',
                'meta_key' => 'service_date',
                'orderby' => 'meta_value',
                'order' => 'DES',
            ));

            while ($homepageServices->have_posts()) {
                $homepageServices->the_post();
                $meta_date = get_field('service_date');
                $serviceDate = DateTime::createFromFormat('Ymd', $meta_date);
                $serviceColor = get_field('liturgical_color');
                $bulletinLink = get_field('bulletin');
                $lectionaryTexts = get_field('lectionary_texts');
                $vimeoLink = get_field('vimeo_link');


                if ($homepageServices->current_post === 0) {
            ?>
                    <li class="card--<?php echo $serviceColor ?>">

                        <div style="background-image: url('<?php echo get_theme_file_uri('/images/service-card.jpg') ?>');" class="current-service-img" alt="bible">
                            <a href="https://live.npcovenant.org">
                            </a>
                        </div>
                        <article class="card">
                            <h4>
                                <span class="services__date"><?php echo $serviceDate->format('D, M jS'); ?></span>
                                <a href="https://live.npcovenant.org" target="_blank" class="services__title"><?php the_title() ?></a>
                            </h4>
                            <p>
                                <?php if (has_excerpt()) {
                                    echo wp_trim_words(get_the_excerpt(), 28);
                                } else {
                                    echo wp_trim_words(get_the_content(), 28);
                                }  ?>
                            </p>
                            <a href="https://live.npcovenant.org/" target="_blank" class="services__link">View the livestream
                                <svg width="19" height="13" viewBox="0 0 19 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.35 6.15L12.35 0.15C12.16 -0.05 11.84 -0.05 11.64 0.15C11.44 0.34 11.44 0.66 11.64 0.86L16.79 6.01H0.5C0.22 6.01 0 6.23 0 6.51C0 6.79 0.22 7.01 0.5 7.01H16.79L11.64 12.16C11.44 12.36 11.44 12.67 11.64 12.87C11.74 12.97 11.87 13.02 11.99 13.02C12.11 13.02 12.25 12.97 12.34 12.87L18.34 6.87C18.53 6.68 18.53 6.36 18.34 6.16L18.35 6.15Z" fill="" />
                                </svg></a>
                        </article>
                    </li>
                <?php      } else {
                ?>

                    <li class="card--<?php echo $serviceColor ?>">
                        <article class="card">
                            <h4>
                                <span class="services__date"><?php echo $serviceDate->format('D, M jS'); ?></span>
                                <a href="<?php echo $vimeoLink ?>" target="_blank" class="services__title"><?php the_title(); ?></a>
                            </h4>
                            <p>
                                <?php if (has_excerpt()) {
                                    echo wp_trim_words(get_the_excerpt(), 28);
                                } else {
                                    echo wp_trim_words(get_the_content(), 28);
                                }  ?>
                            </p>
                            <a href="<?php echo $vimeoLink ?>" target="_blank" class="services__link">View recording
                                <svg width="19" height="13" viewBox="0 0 19 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.35 6.15L12.35 0.15C12.16 -0.05 11.84 -0.05 11.64 0.15C11.44 0.34 11.44 0.66 11.64 0.86L16.79 6.01H0.5C0.22 6.01 0 6.23 0 6.51C0 6.79 0.22 7.01 0.5 7.01H16.79L11.64 12.16C11.44 12.36 11.44 12.67 11.64 12.87C11.74 12.97 11.87 13.02 11.99 13.02C12.11 13.02 12.25 12.97 12.34 12.87L18.34 6.87C18.53 6.68 18.53 6.36 18.34 6.16L18.35 6.15Z" fill="" />
                                </svg></a>
                        </article>
                    </li>
            <?php
                }
            }
            ?>
            <li>
                <div> <a href="<?php echo get_post_type_archive_link('service'); ?>">
                        Sunday worship archvies
                        <svg width="19" height="13" viewBox="0 0 19 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.35 6.15L12.35 0.15C12.16 -0.05 11.84 -0.05 11.64 0.15C11.44 0.34 11.44 0.66 11.64 0.86L16.79 6.01H0.5C0.22 6.01 0 6.23 0 6.51C0 6.79 0.22 7.01 0.5 7.01H16.79L11.64 12.16C11.44 12.36 11.44 12.67 11.64 12.87C11.74 12.97 11.87 13.02 11.99 13.02C12.11 13.02 12.25 12.97 12.34 12.87L18.34 6.87C18.53 6.68 18.53 6.36 18.34 6.16L18.35 6.15Z" fill="#444444;
                        " />
                        </svg>
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <div>
    </div>
</section>

<!----------- SPOTLIGHT ------------>
<?
$spotlightPost = get_post(180);
$postContent = $spotlightPost->post_content;
?>
<section class="section spotlight" style="background-image: linear-gradient(
    180deg,
    rgba(0, 0, 0, 0.7),
    rgba(0, 0, 0, 0.7)
),
url(<?php
    if (get_the_post_thumbnail(180)) {
        echo get_the_post_thumbnail_url(180);
    } else {
        echo get_theme_file_uri('/images/spotlight.jpg');
    }
    ?>);">
    <div class="spotlight__banner">
        <?php echo $postContent ?>
    </div>
</section>
<?
?>

<!----------- EVENTS ------------>
<section class="section events">
    <? eventSlider(); ?>
</section>


<!----------- INFO ------------>
<?
$infoPost = get_post(249);
$infoContent = $infoPost->post_content;
?>
<section class="info">
    <div class="info__content">
        <div class="info__list">
            <?php echo $infoContent ?>
        </div>
    </div>
</section>
</main>

<?php



get_footer();
