<!-- login-attention.php -->
<?php
if (!is_user_logged_in()) {
    // ログインしていない場合は、以降のHTMLを出力しない
    ?>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("overlay").style.display = "block";
        document.getElementById("login-form").style.display = "block";
      });
    </script>
    <?php
    return; // 以降のaboutページのHTMLは出力しない
}
?>
<script src="loginattention.js"></script>
