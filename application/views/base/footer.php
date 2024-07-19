</body>
<link rel="stylesheet" href="<?php echo PATH_URL_STYLE . 'footer.css' ?>">
<footer>
    <a href="?url=home/view">
        <?php echo '<image id="img-footer" src="' . PATH_URL_IMG_HOME . 'footer.jpeg"' . '" alt="' . '"/ >'; ?>
    </a>
    <div class="site__footer">
        <div class="inner">
            <div class="site__footer-copyright">
                <p>
                    © Copyright 2024 &nbsp;-&nbsp; 3H Fashion </p>
            </div>
            <div class="site__footer-copyright">
                Hotline: 093.000.909
            </div>
            <div class="site__footer-social-links">
                <a href="https://twitter.com/" class="sc-twitter" target="_blank">
                    <img src="<?php echo PATH_URL_IMG . 'logo/twitter.png' ?>" title="Twitter">
                </a>
                <a href="https://www.facebook.com/" class="sc-facebook" target="_blank">
                    <img src="<?php echo PATH_URL_IMG . 'logo/facebook.png' ?>" title="Facebook">
                    <a href="https://www.instagram.com/" class="sc-instagram" target="_blank">
                        <img src="<?php echo PATH_URL_IMG . 'logo/instagram.png' ?>" title="Instagram">

                    </a>

            </div>
        </div>
    </div>
</footer>

</html>

<style>
    #img-footer {
        max-width: 100%;
        margin-top: 50px;
        
    }

    #img-footer:hover {
        cursor: pointer;
    }
</style>