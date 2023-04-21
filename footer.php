<?
$footerPost = get_post(199);
$footerContent = $footerPost->post_content;
$todaysYear = date('Y');
?>
<!----------- FOOTER ------------>
<footer class="footer">
    <div class="footer__content">
        <div class="footer__logo">
            <img src=<?php echo get_theme_file_uri('/images/footer-logo.png') ?> alt="logo" />
        </div>
        <?php echo $footerContent; ?>
        <div class="footer__socials">
            <a href="https://www.facebook.com/npcovenant" target="_blank">
                <img src=<?php echo get_theme_file_uri('/images/facebook.png') ?> alt="facebook" />
            </a>
            <a href="https://www.instagram.com/npcc_chicago/" target="_blank">
                <img src=<?php echo get_theme_file_uri('/images/instagram.png') ?> alt="instagram" />
            </a>
            <a href="https://vimeo.com/npcovenant" target="_blank">
                <img src=<?php echo get_theme_file_uri('/images/vimeo.png') ?> alt="vimeo" />
            </a>
        </div>
    </div>
    <div class="footer__info">
        <span class="address"> 5250 N Christiana Ave, Chicago, IL 60625 </span>
        <span class="copyright">
            &copy; <?php echo $todaysYear; ?> North Park Covenant Church
        </span>
    </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>