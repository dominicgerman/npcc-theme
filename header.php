<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>

</head>

<body>
    <?php $parentId = wp_get_post_parent_id(get_the_ID()); ?>

    <!----------- NAV ------------>
    <nav class="nav">
        <div class="nav__content">
            <a href="<?php echo site_url('/'); ?>">
                <div class=" nav__logo">
                    <img src=<?php echo get_theme_file_uri('/images/header-logo.png') ?> alt="logo" />
                    <h1>North Park Covenant Church</h1>
                </div>
            </a>
            <svg class="toggle__open" width="42" height="16" viewBox="0 0 42 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="42" height="2" fill="#444444" />
                <rect y="7" width="42" height="2" fill="#444444" />
                <rect y="14" width="42" height="2" fill="#444444" />
            </svg>
            <input class="toggle__checkbox" type="checkbox" autocomplete="off" />
            <svg class="toggle__close" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.443848" y="30.1421" width="42" height="2" transform="rotate(-45 0.443848 30.1421)" fill="white" />
                <rect x="1.85791" y="0.443604" width="42" height="2" transform="rotate(45 1.85791 0.443604)" fill="white" />
            </svg>
            <div class="nav__overlay"></div>
            <ul class="nav__list" id="nav__list">
                <li class="nav__link">
                    <a class="nav__link--text <? if (is_page('our-beliefs') or is_page('our-story') or is_page('our-building') or is_page('leadership')) echo 'nav__link--active' ?>" href="<?php echo site_url('/our-beliefs'); ?>">About
                    </a>
                    <input class="chevron__checkbox" type="checkbox">
                    <svg class="chevron__down" width="19" height="11" viewBox="0 0 19 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.0108 10.7758L18.7811 1.35288C19.073 1.05399 19.073 0.55059 18.7811 0.235967C18.5038 -0.0786557 18.0369 -0.0786557 17.745 0.235967L10.2296 8.33751C10.2296 8.33751 9.91686 8.67502 9.50825 8.67502C9.09965 8.67502 8.80775 8.33751 8.77035 8.33751L1.25499 0.235967C0.963135 -0.0786557 0.510756 -0.0786557 0.218897 0.235967C0.0729675 0.393279 0 0.597783 0 0.786556C0 0.97533 0.0729675 1.19557 0.218897 1.33715L8.97465 10.7758C9.25192 11.0747 9.71889 11.0747 10.0108 10.7758Z" fill="white" />
                    </svg>
                    </input>
                    <ul class="nav__submenu">
                        <li>
                            <a href="<?php echo site_url('/our-beliefs'); ?>">Our Beliefs</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/our-story'); ?>">Our Story</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/our-building'); ?>">Our Building</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/leadership'); ?>">Leadership</a>
                        </li>
                    </ul>
                </li>
                <li class="nav__link">
                    <a class="nav__link--text <? if (is_page('worship') or get_post_type() == 'service') echo 'nav__link--active' ?>" href="<?php echo site_url('/services'); ?>">Worship
                    </a>
                    <input class="chevron__checkbox" type="checkbox" />
                    <svg class="chevron__down" width="19" height="11" viewBox="0 0 19 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.0108 10.7758L18.7811 1.35288C19.073 1.05399 19.073 0.55059 18.7811 0.235967C18.5038 -0.0786557 18.0369 -0.0786557 17.745 0.235967L10.2296 8.33751C10.2296 8.33751 9.91686 8.67502 9.50825 8.67502C9.09965 8.67502 8.80775 8.33751 8.77035 8.33751L1.25499 0.235967C0.963135 -0.0786557 0.510756 -0.0786557 0.218897 0.235967C0.0729675 0.393279 0 0.597783 0 0.786556C0 0.97533 0.0729675 1.19557 0.218897 1.33715L8.97465 10.7758C9.25192 11.0747 9.71889 11.0747 10.0108 10.7758Z" fill="white" />
                    </svg>
                    <ul class="nav__submenu">
                        <li>
                            <a href="https://live.npcovenant.org/" target="_blank">Livestream</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/plan-your-visit'); ?>">Plan Your Visit</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/services'); ?>">Worship Archive</a>
                        </li>
                    </ul>
                </li>
                <li class="nav__link">

                    <a class="nav__link--text <? if (is_page('ministries')) echo 'nav__link--active' ?>" href="<?php echo site_url('/ministries'); ?>">Ministries
                    </a>
                    <input class="chevron__checkbox" type="checkbox" />
                    <svg class="chevron__down" width="19" height="11" viewBox="0 0 19 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.0108 10.7758L18.7811 1.35288C19.073 1.05399 19.073 0.55059 18.7811 0.235967C18.5038 -0.0786557 18.0369 -0.0786557 17.745 0.235967L10.2296 8.33751C10.2296 8.33751 9.91686 8.67502 9.50825 8.67502C9.09965 8.67502 8.80775 8.33751 8.77035 8.33751L1.25499 0.235967C0.963135 -0.0786557 0.510756 -0.0786557 0.218897 0.235967C0.0729675 0.393279 0 0.597783 0 0.786556C0 0.97533 0.0729675 1.19557 0.218897 1.33715L8.97465 10.7758C9.25192 11.0747 9.71889 11.0747 10.0108 10.7758Z" fill="white" />
                    </svg>
                    <ul class="nav__submenu">
                        <li>
                            <a href="<?php echo site_url('/ministries/sunday-school'); ?>">Sunday School</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/ministries/youth'); ?>">Youth</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/ministries/adult-formation'); ?>">Adult Formation</a>
                        </li>
                    </ul>
                </li>
                <li class="nav__link">

                    <a class="nav__link--text  <? if (is_page('get-involved') or get_post_type() == 'event') echo 'nav__link--active' ?>" href="<?php echo site_url('/get-involved'); ?>">Community
                    </a>
                    <input class="chevron__checkbox" type="checkbox" />
                    <svg class="chevron__down" width="19" height="11" viewBox="0 0 19 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.0108 10.7758L18.7811 1.35288C19.073 1.05399 19.073 0.55059 18.7811 0.235967C18.5038 -0.0786557 18.0369 -0.0786557 17.745 0.235967L10.2296 8.33751C10.2296 8.33751 9.91686 8.67502 9.50825 8.67502C9.09965 8.67502 8.80775 8.33751 8.77035 8.33751L1.25499 0.235967C0.963135 -0.0786557 0.510756 -0.0786557 0.218897 0.235967C0.0729675 0.393279 0 0.597783 0 0.786556C0 0.97533 0.0729675 1.19557 0.218897 1.33715L8.97465 10.7758C9.25192 11.0747 9.71889 11.0747 10.0108 10.7758Z" fill="white" />
                    </svg>
                    <ul class="nav__submenu">
                        <li>
                            <a href="<?php echo site_url('/events'); ?>">Events</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/get-involved'); ?>">Get Involved</a>
                        </li>
                    </ul>
                </li>
                <li class="nav__link">
                    <a class="nav__link--text <? if (is_page('preschool')) echo 'nav__link--active' ?>" href="<?php echo site_url('/preschool'); ?>">Preschool</a>
                </li>
                <li class="nav__link give-btn">
                    <a class="nav__link--text btn btn--nav" href=" https://secure.accessacs.com/access/memberlogin.aspx?sn=1048">Give</a>
                </li>
            </ul>
        </div>
    </nav>