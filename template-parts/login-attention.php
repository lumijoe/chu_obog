<!-- login-attention.php -->
<?php if (!is_user_logged_in()) { ?>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("overlay").style.display = "block";
        document.getElementById("login-form").style.display = "block";
      });
    </script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/login-shadow.js"></script>
    <?php
    return; 
} ?>


