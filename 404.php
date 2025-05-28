<!-- 404.php -->
<?php get_header(); ?>
<div id="404-page">
    <h2>404 Not Found（ページが見つかりませんでした）</h2>
    <p>お探しのページは存在しないか、または移動した可能性があります。</p>
    <a href="<?php echo home_url('/'); ?>" class="btn add-icon next 404top">トップへ戻る</a>
</div>
<?php
get_footer();