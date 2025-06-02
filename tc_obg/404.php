<!-- 404.php -->
<?php get_header(); ?>
<div class="wrapper-404">
    <div id="page-404">
        <h2>404</h2>
        <h3>PAGE NOT FOUND</h3>
        <p>お探しのページが見つかりませんでした<br>トップページまたはメニューより再度お探しください</p>
    </div>
    <a href="<?php echo home_url('/'); ?>" class="btn add-icon next btn-mb-wide btn-mt-wide">トップへ戻る</a>
</div>
<?php
get_footer();