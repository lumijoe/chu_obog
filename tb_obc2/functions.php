<?php

/**
 * custom_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package custom_theme
 */

// ========================
// スタイル設定
// ========================
function custom_theme_enqueue_styles()
{
    wp_enqueue_style(
        'custom-style',
        get_template_directory_uri() . '/assets/sass/style.css',
        array(),
        filemtime(get_template_directory() . '/assets/sass/style.css')
    );
}
add_action('wp_enqueue_scripts', 'custom_theme_enqueue_styles');


// ========================
// スクリプト設定
// ========================
function custom_theme_enqueue_scripts()
{
    if(!is_page('oboglogin')) {
        wp_enqueue_script(
            // アラートテスト
            'home-js',
            get_template_directory_uri() . '/assets/js/home.js',
            array(),
            filemtime(get_template_directory() . '/assets/js/home.js'),
            true // footerでの読み込みtrue
        );
    }
    session_start();
    if ( (is_front_page()  || is_page('oboglogin')) && (!isset($_SESSION['obog_loggedIn'])) ) {
        wp_enqueue_script(
            'login-js',
            get_template_directory_uri() . '/assets/js/login.js',
            array(),
            filemtime(get_template_directory() . '/assets/js/login.js'),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'custom_theme_enqueue_scripts');



// ========================
// 管理画面：ロゴ設定
// ========================
function my_login_logo()
{ ?>
    <style type="text/css">
        #login h1 a,
        .login h1 a {
            background-image: url(<?php echo get_template_directory_uri(); ?>/images/logo.svg);
            margin: 0 !important;
            width: 100%;
        }

        .login h1 a {
            background-size: 100% !important;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');


// ========================
// 管理画面：投稿タイプ
// ========================
function create_post_type_news()
{
    register_post_type(
        'news',
        array(
            'labels' => array(
                'name'          => 'お知らせ',
                'singular_name' => 'お知らせ',
                'all_items'     => 'お知らせ一覧',
            ),
            'public'       => true,
            'has_archive'  => true, // アーカイブページを有効にする
            'menu_position' => 5,
            'menu_icon'    => 'dashicons-edit',
            'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'rewrite'      => array('slug' => 'news'), // URLを '/news/' にする
        )
    );
}
add_action('init', 'create_post_type_news');


// ========================
// 管理画面：投稿一覧にカテゴリ表示
// ========================
function add_custom_columns($columns)
{
    // カテゴリ列を追加
    $columns['category'] = 'カテゴリ'; // 'category' は表示する列のキー、'カテゴリ' は列のタイトル

    return $columns;
}
add_filter('manage_news_posts_columns', 'add_custom_columns');


// ========================
// 管理画面：投稿一覧のカテゴリ列にカテゴリ名を表示
// ========================
function show_custom_column_data($column, $post_id)
{
    if ($column == 'category') {
        // 投稿に関連するカテゴリを取得
        $terms = get_the_terms($post_id, 'newscategory');
        if ($terms && !is_wp_error($terms)) {
            $term_list = array();
            foreach ($terms as $term) {
                $term_list[] = $term->name; // カテゴリ名を取得
            }
            echo implode(', ', $term_list); // カテゴリ名をカンマ区切りで表示
        } else {
            echo 'カテゴリなし'; // カテゴリがない場合
        }
    }
}
add_action('manage_news_posts_custom_column', 'show_custom_column_data', 10, 2);


// ========================
// 管理画面：投稿一覧にカテゴリフィルタを追加
// ========================
function add_category_filter_to_posts()
{
    global $typenow;

    // 'news' カスタム投稿タイプの場合のみフィルタを表示
    if ($typenow == 'news') {
        // カテゴリの選択肢を取得
        $terms = get_terms(array(
            'taxonomy' => 'newscategory',
            'orderby' => 'name',
            'hide_empty' => false, // カテゴリが空でも表示
        ));

        if ($terms) {
            // フィルタのフォームを表示
            echo '<select name="newscategory_filter" id="newscategory_filter">';
            echo '<option value="">カテゴリで絞り込む</option>';
            foreach ($terms as $term) {
                echo '<option value="' . esc_attr($term->term_id) . '" ' . selected($_GET['newscategory_filter'], $term->term_id, false) . '>' . esc_html($term->name) . '</option>';
            }
            echo '</select>';
        }
    }
}
add_action('restrict_manage_posts', 'add_category_filter_to_posts');



// ========================
// 管理画面：投稿一覧のクエリに絞り込み条件を追加
// ========================
function filter_news_by_category($query)
{
    global $pagenow;

    // 'news' カスタム投稿タイプの場合
    if ($pagenow == 'edit.php' && isset($_GET['newscategory_filter']) && $_GET['newscategory_filter'] != '') {
        $query->query_vars['tax_query'] = array(
            array(
                'taxonomy' => 'newscategory',
                'field' => 'id',
                'terms' => $_GET['newscategory_filter'],
                'operator' => 'IN',
            ),
        );
    }
}
add_filter('pre_get_posts', 'filter_news_by_category');



// ========================
// ビジュアルエディタの非表示設定
// ========================
function remove_editor_from_custom_post_type()
{
    remove_post_type_support('news', 'editor'); // 'news' カスタム投稿タイプの名前、その投稿の時は非表示
}
add_action('init', 'remove_editor_from_custom_post_type');
// ビジュアルエディタテキストタブ背景色
function custom_admin_styles()
{
    echo '<style>
        /* テキストタブの背景を黒に変更 */
        .wp-editor-area {
            background-color: #353535 !important;
            color: #fff !important; /* テキスト色を白に変更 */
        }
        .wp-editor-tabs .wp-tab-active {
            background-color: #333 !important; /* アクティブタブの背景色 */
        }
    </style>';
}
add_action('admin_head', 'custom_admin_styles');


// ========================
// .env の読み込み（WordPressルート直下）
// ========================
function load_env()
{
    $env_path = ABSPATH . '.env';
    if (file_exists($env_path)) {
        $lines = file($env_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            list($name, $value) = explode('=', $line, 2);
            $_ENV[trim($name)] = trim($value);
        }
    }
}
add_action('init', 'load_env');

// ========================
// カスタムログイン認証（AJAX）
// ========================
add_action('wp_ajax_nopriv_custom_login', 'custom_login_handler');
function custom_login_handler() {
    session_start();
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // .envから値を取得
    $env_username = $_ENV['CROBC_USERNAME'] ?? '';
    $env_password = $_ENV['CROBC_PASSWORD'] ?? '';

    if ($username === $env_username && wp_check_password($password, $env_password)) {
        $_SESSION['obog_loggedIn'] = true;        
        wp_send_json_success();
        die;
    } else {
        wp_send_json_error('ユーザー名またはパスワードが正しくありません。');
    }
    wp_die();
}

add_action('wp_head', function() {
    echo '<script>window.wp_ajax_url = "' . admin_url('admin-ajax.php') . '";</script>';
});

function obog_redirects() {
    if(!is_front_page() && !is_page('oboglogin')) {
        session_start();
        global $wp;        
        $drui = home_url(add_query_arg(array($_GET), $wp->request));
        $drui = str_replace('?','_druiq_',$drui);
        if(!isset($_SESSION['obog_loggedIn'])) {   
            wp_redirect(home_url('/obog/oboglogin?drui=' . $drui));
            exit();
        }
    }
}
add_action( 'template_redirect', 'obog_redirects' );
