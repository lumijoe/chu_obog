<?php

/**
 * ヘッダー
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
</head>

<body <?php body_class(); ?>>
<?php 
if( is_front_page() ) { 
    session_start(); 
    if(!isset($_SESSION['obog_loggedIn']) ) { 
?>
<div id="overlay"></div>
<div id="login-form">
  <button class="close-btn" id="close-btn">✕</button>
  <h2 class="modal-title">会員専用ページ</h2>
  <form class="modal-form">
    <label>ユーザー名<br /><input type="text" id="username" name="username" placeholder="ユーザー名" required /></label><br /><br />
    <label>パスワード<br /><input type="password" id="password" name="password" placeholder="パスワード" required /></label><br /><br />
    <input type="hidden" id="drui" name="drui" value="<?php echo home_url('/');?>" />
    <button type="submit" class="login-submit">
      <div class="submit-left"></div>
      <div>ログインする</div>
      <img src="<?php echo get_template_directory_uri(); ?>/images/common/icon_right_bgblue.svg" alt="">
    </button>
  </form>
</div>
<?php 
    } 
} ?>
    <header id="header" class="header">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <h1><a class="navbar-brand logtrue" href="<?php echo home_url('/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/home/logo.png" alt="" width="199" height="52" style="max-width:100%;"><span class="top-ttl">中外炉OBOGクラブ</span></a></h1>
                <!-- sp only navmenu btn -->
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- sp only -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-lg-none">
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>">中外炉<br>OBOGクラブについて<img src="https://nagahama-p.sakura.ne.jp/obog/wp-content/themes/chu_obog/images/common/icon_right_bgwhite.svg" alt="" data-src="https://nagahama-p.sakura.ne.jp/obog/wp-content/themes/chu_obog/images/common/icon_right_bgwhite.svg" decoding="async" class=" lazyloaded"></a>

                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo get_post_type_archive_link('news'); ?>">お知らせ一覧<img src="https://nagahama-p.sakura.ne.jp/obog/wp-content/themes/chu_obog/images/common/icon_right_bgwhite.svg" alt="" data-src="https://nagahama-p.sakura.ne.jp/obog/wp-content/themes/chu_obog/images/common/icon_right_bgwhite.svg" decoding="async" class=" lazyloaded"></a>

                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo home_url('/newscategory/allevent'); ?>">全体行事<img src="https://nagahama-p.sakura.ne.jp/obog/wp-content/themes/chu_obog/images/common/icon_right_bgwhite.svg" alt="" data-src="https://nagahama-p.sakura.ne.jp/obog/wp-content/themes/chu_obog/images/common/icon_right_bgwhite.svg" decoding="async" class=" lazyloaded"></a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo home_url('/newscategory/company'); ?>">会社だより<img src="https://nagahama-p.sakura.ne.jp/obog/wp-content/themes/chu_obog/images/common/icon_right_bgwhite.svg" alt="" data-src="https://nagahama-p.sakura.ne.jp/obog/wp-content/themes/chu_obog/images/common/icon_right_bgwhite.svg" decoding="async" class=" lazyloaded"></a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo home_url('/newscategory/obog'); ?>">OBOG会だより<img src="https://nagahama-p.sakura.ne.jp/obog/wp-content/themes/chu_obog/images/common/icon_right_bgwhite.svg" alt="" data-src="https://nagahama-p.sakura.ne.jp/obog/wp-content/themes/chu_obog/images/common/icon_right_bgwhite.svg" decoding="async" class=" lazyloaded"></a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo home_url('/newscategory/member'); ?>">会員だより<img src="https://nagahama-p.sakura.ne.jp/obog/wp-content/themes/chu_obog/images/common/icon_right_bgwhite.svg" alt="" data-src="https://nagahama-p.sakura.ne.jp/obog/wp-content/themes/chu_obog/images/common/icon_right_bgwhite.svg" decoding="async" class=" lazyloaded"></a>
                        </li>
                        <hr>
                    </ul>
                    <ul class="d-lg-none nav-only-cta">
                        <li>
                            <a href="<?php echo get_template_directory_uri(); ?>/images/home/chugairo_print.pdf" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/home/icon_mail_white.png " alt="" width="45" height="42" style="max-width:100%;">
                                弔事の<br>ご連絡について
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo home_url('/about#memberpost'); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/home/icon_note_white.png " alt="" width="45" height="42" style="max-width:100%;">
                                ご入稿について<br>（会員限定）
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContentPC">
                    <a href="<?php echo get_template_directory_uri(); ?>/images/home/chugairo_print.pdf" class="btn pc-only-cta" target="_blank">
                       <div class="pc-cta-wrapper">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/home/icon_mail_white.png" alt="" width="45" height="42">
                            <p>弔事の<br>ご連絡について</p></div>
                    </a>
                    <a href="<?php echo home_url('/about#memberpost'); ?>" class="btn pc-only-cta">
                       <div class="pc-cta-wrapper">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/home/icon_note_white.png" alt="" width="45" height="42">
                            <p>ご入稿について<br>（会員限定）</p></div>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <main class="main">