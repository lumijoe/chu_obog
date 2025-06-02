<?php
/**
 * OBOGログインヘッダー
 */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="description" content="中外炉工業株式会社の退職者コミュニティーです">
    <title>中外炉工業OBOGクラブ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">

    <!-- OGP Meta　Tags -->
    <meta property="og:title" content="中外炉工業OBOGクラブ">
    <meta property="og:description" content="中外炉工業株式会社を退職されたOBOGの皆さまのためのコミュニティークラブです。所定の基準を満たす中外炉OBOGの皆さまなら、だれでも入会できるメンバーズクラブです。">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/images/ogp.png">
    <meta property="og:url" content="<?php echo home_url('/'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="中外炉工業OBOGクラブ">
    <?php wp_head(); ?>
    <style>
        #overlay, #login-form { display: block; }
        #overlay {  pointer-events: none; }
    </style>
</head>
<body <?php body_class(); ?>>
<?php 
$drui = home_url('/');
if( isset($_GET['drui']) && $_GET['drui'] != '') {
    $drui = $_GET['drui'];
    $drui = str_replace('_druiq_', '?', $drui);
    if( strpos($drui, home_url('/')) != 0 ){
        wp_redirect(home_url('/'));
        exit();
    }
}
?>
<div id="overlay"></div>
<div id="login-form">
  <button class="close-btn" id="close-btn">✕</button>
  <h2 class="modal-title">会員専用ページ</h2>
  <form class="modal-form">
    <label>ユーザー名<br /><input type="text" id="username" name="username" placeholder="ユーザー名" required /></label><br /><br />
    <label>パスワード<br /><input type="password" id="password" name="password" placeholder="パスワード" required /></label><br /><br />
    <input type="hidden" id="drui" name="drui" value="<?php echo $drui;?>" />
    <p><?php echo $cur_url;?></p>
    <button type="submit" class="login-submit">
      <div class="submit-left"></div>
      <div>ログインする</div>
      <img src="<?php echo get_template_directory_uri(); ?>/images/common/icon_right_bgblue.svg" alt="">
    </button>
  </form>
</div>