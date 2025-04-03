<!-- カスタム投稿の一覧 -->
<?php get_header(); ?>
<h1>ニュース一覧</h1>

<?php if (have_posts()) : ?>
    <ul>
        <?php while (have_posts()) : the_post(); ?>
            <li>
                <!-- ACFタイトル -->
                <a href="<?php the_permalink(); ?>">テスト投稿：<?php the_field('post_title'); ?></a>
                <!-- ACF投稿日時 -->
                <p><?php echo get_the_date('Y年m月d日'); ?></p>
                <!-- カテゴリ表示 -->
                <p class="post-category">
                <?php
                // 投稿のカテゴリを表示
                    $categories = get_the_category(); // 投稿のカテゴリを取得
                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                            echo '<span class="category-name">' . esc_html($category->name) . '</span>';
                        }
                    }
                    ?>
                </p>
                <!-- ACF本文 -->
                <p><?php the_field('post_text'); ?></p>
                <!-- 画像 -->
                <img src="<?php the_field('post_image'); ?>" 
                    alt="ニュース画像" 
                    width="300" 
                    data-src="<?php the_field('post_image'); ?>" 
                    decoding="async" 
                    class="lazyloaded">                               
            </li>
        <?php endwhile; ?>
    </ul>

    <?php the_posts_pagination(); ?>

<?php else : ?>
    <p>ニュースがありません。</p>
<?php endif; ?>


<?php get_footer(); ?>
