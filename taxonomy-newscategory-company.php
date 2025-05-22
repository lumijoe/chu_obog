<?php get_header(); ?>
<!-- ログインアラート -->
<?php get_template_part('template-parts/login-alert'); ?>

<!-- titleview -->
<section class="l-titleview">
    <img src="<?php echo get_template_directory_uri(); ?>/images/common/img_page_company.png" alt="会社だよりページビュー">
    <div class="l-titleview-ttl">
        <p><?php single_term_title(); ?></p>
    </div>
</section>

<!-- カテゴリタブ -->
<div class="l-category-tab2">
    <a href="<?php echo home_url('/news'); ?>" class="txt-middle">
        <div class="cat-left"></div>
        <p class="cat-center">お知らせ一覧</p>
        <img src="<?php echo get_template_directory_uri(); ?>/images/common/icon_catarrow_blue.svg" alt="" width="12" height="12">
    </a>
    <a href="<?php echo home_url('/newscategory/allevent/'); ?>" class="txt-short">
        <div class="cat-left"></div>
        <p class="cat-center">全体行事</p>
        <img src="<?php echo get_template_directory_uri(); ?>/images/common/icon_catarrow_blue.svg" alt="" width="12" height="12">
    </a>
    <a href="<?php echo home_url('/newscategory/company/'); ?>" class="is-current txt-short">
        <div class="cat-left"></div>
        <p class="cat-center">会社だより</p>
        <img src="<?php echo get_template_directory_uri(); ?>/images/common/icon_catarrow_white.svg" alt="" width="12" height="12">
    </a>
    <a href="<?php echo home_url('/newscategory/obog/'); ?>" class="txt-long">
        <div class="cat-left"></div>
        <p class="cat-center">OBOG会だより</p>
        <img src="<?php echo get_template_directory_uri(); ?>/images/common/icon_catarrow_blue.svg" alt="" width="12" height="12">
    </a>
    <a href="<?php echo home_url('/newscategory/member/'); ?>" class="txt-short">
        <div class="cat-left"></div>
        <p class="cat-center">会員だより</p>
        <img src="<?php echo get_template_directory_uri(); ?>/images/common/icon_catarrow_blue.svg" alt="" width="12" height="12">
    </a>
</div>

<p class="l-page-caption">会社からのお知らせや<br class="d-none display-800">近況等を掲載しています</p>

<!-- サイドバー -->
<div class="l-side-grid">
    <!-- 記事セクション -->
    <section class="l-article">
        <?php
        // タクソノミーに関連する投稿があるかチェック
        if (have_posts()) : ?>
            <ul>
                <hr class="article-top-hr">
                <?php while (have_posts()) : the_post(); ?>
                    <li class="sp-article-wrapper">
                        <div class="sp-article">
                            <!-- ACF投稿日時 -->
                            <date><?php echo get_the_date('Y.m.d'); ?></date>

                            <!-- カテゴリ表示 -->
                            <?php
                            $terms = get_the_terms(get_the_ID(), 'newscategory');
                            if ($terms && !is_wp_error($terms)) :
                                $first_term = $terms[0];
                                $category_output = $first_term->name;
                            else :
                                $category_output = 'カテゴリなし';
                            endif;
                            ?>
                            <!-- span新着タグ -->
                            <?php
                            // 投稿日と現在の日付を取得
                            $post_date = get_the_date('Y-m-d');
                            $post_datetime = new DateTime($post_date);
                            $now = new DateTime();

                            // 投稿が過去の日付かチェック（未来記事を除外）
                            if ($post_datetime <= $now) {
                                $interval = $now->diff($post_datetime)->days;

                                // 7日以内ならNEWを表示
                                if ($interval < 7) :
                            ?>
                                    <span class="tag_new">NEW</span>
                            <?php
                                endif;
                            }
                            ?>
                            <p class="item-category"><?php echo esc_html($category_output); ?></p>
                        </div>
                        <!-- ACFタイトル -->
                        <?php if (get_field('post_title')) : ?>
                            <a href="<?php the_permalink(); ?>"><?php the_field('post_title'); ?></a>
                        <?php endif; ?>
                    </li>
                    <hr>
                <?php endwhile; ?>
            </ul>

            <!-- 投稿のページネーション -->
            <?php the_posts_pagination(); ?>

        <?php else : ?>
            <!-- 投稿がない場合のメッセージ -->
            <p>お知らせはありません。</p>
        <?php endif; ?>
    </section>
    <!-- サイトバー設定 -->
    <section>
        <?php get_sidebar('news'); ?> <!-- sidebar-news.php を読み込む -->
    </section>

</div>

<!-- OBOGの皆さまへ -->
<?php get_template_part('template-parts/obog-banner'); ?>

<?php get_footer(); ?>