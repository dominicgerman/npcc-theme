<!-- this is for single event pages -->

<?php

get_header();

if (have_posts()) :

    while (have_posts()) : the_post();
        $subheading = get_field('subheading');
        $meta_date = get_field('event_date');
        $eventDate = DateTime::createFromFormat('Ymd', $meta_date);
        $eventTime = get_field('event_time');
        $eventLocation = get_field('event_location');
        $rsvpLink = get_field('rsvp_link');
        $slider = get_field('events_slider');

?>
        <main>
            <!----------- HEADER ------------>
            <header class="section header--inner" style="
          background-image: linear-gradient(
              90deg,
              rgba(0, 0, 0, 0.8),
              rgba(0, 0, 0, 0.2)
            ), url('<?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail_url();
                    } else {
                        echo get_theme_file_uri('/images/spotlight.jpg');
                    }
                    ?>');
        ">
                <div class="header--inner__content">
                    <h2 class="header--inner__headline">
                        <?php the_title(); ?>
                    </h2>
                    <p class="header--inner__details">
                        <?php echo $subheading ?>
                    </p>
                </div>
            </header>

            <!----------- MAIN ------------>
            <section class="main--event">
                <div class="main--event__content">
                    <?php the_content(); ?>
                </div>
                <aside class="main--event__event-box">
                    <div class="event-date">
                        <h5>Date</h5>
                        <span><?php echo $eventDate->format('D, M dS'); ?></span>
                    </div>
                    <? if ($eventTime) {
                    ?>
                        <div class="event-time">
                            <h5>Time</h5>
                            <span><?php echo $eventTime; ?></span>
                        </div>
                    <?  }
                    ?>
                    <? if ($eventLocation) {
                    ?>
                        <div class="event-location">
                            <h5>Location</h5>
                            <?php echo $eventLocation ?>
                        </div>
                    <?  }
                    ?>
                    <a href="<?php echo $rsvpLink ?>" class="btn main--event__button">RSVP Now</a>
                </aside>
            </section>
            <section class="section events">
                <?php if ($slider) {
                ?>
                    <h1 class="moreEvents--heading">More Events</h1>
                <? eventSlider();
                } ?>
            </section>
        </main>

<?
    endwhile;
endif;

get_footer();

?>