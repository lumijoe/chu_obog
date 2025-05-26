login.js?ver=1748266427:52 
 Uncaught (in promise) TypeError: Failed to fetch
    at HTMLFormElement.<anonymous> (login.js?ver=1748266427:52:3)
(anonymous)	@	login.js?ver=1748266427:52

// セッションストレージでログイン状態を管理
function isLoggedIn() {
    return sessionStorage.getItem("loggedIn") === "true";
  }
  function setLoggedIn() {
    sessionStorage.setItem("loggedIn", "true");
  }
  
  // 初回ロード時、ログイン済みならフォームもオーバーレイも非表示
  window.addEventListener("DOMContentLoaded", function () {
    if (isLoggedIn()) {
      document.getElementById("login-form").style.display = "none";
      document.getElementById("overlay").style.display = "none";
    }
  });
  
  // クリックでフォーム表示（何度でも→ログイン済みなら出さない）
  document.addEventListener("click", function (event) {
    const loginForm = document.getElementById("login-form");
    const overlay = document.getElementById("overlay");
  
    if (isLoggedIn()) return; // ログイン済みなら何もしない
    if (loginForm.contains(event.target) || overlay.contains(event.target))
      return;
  
    loginForm.style.display = "block";
    overlay.style.display = "block";
  });
  
  // ✕ボタンクリックで非表示にする
  document
    .getElementById("close-btn")
    .addEventListener("click", function (event) {
      document.getElementById("login-form").style.display = "none";
      document.getElementById("overlay").style.display = "none";
      event.stopPropagation();
    });
  
  // オーバーレイクリックでも閉じるようにする（オプション）
  document.getElementById("overlay").addEventListener("click", function () {
    document.getElementById("login-form").style.display = "none";
    document.getElementById("overlay").style.display = "none";
  });
  
  // ログインフォーム送信時にサーバーで認証
  document.querySelector("#login-form form").addEventListener("submit", function (event) {
    event.preventDefault();
  
    const inputUsername = document.getElementById("username").value;
    const inputPassword = document.getElementById("password").value;
  
    fetch('/wp-admin/admin-ajax.php?action=custom_login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `username=${encodeURIComponent(inputUsername)}&password=${encodeURIComponent(inputPassword)}`
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          setLoggedIn();
          document.getElementById("login-form").style.display = "none";
          document.getElementById("overlay").style.display = "none";
          location.reload(); // 必要ならリロード
        } else {
          alert(data.data || "ログインに失敗しました。");
        }
      });
  });
  
  // すべてのaタグクリック監視、未ログイン時の遷移止め
  document.querySelectorAll('a').forEach(function(link) {
    link.addEventListener('click', function(event) {
      // target=\"_blank\" かつ logtrue クラスが付与されている場合のみスルー（遷移を許可）
      if (link.target === "_blank" && link.classList.contains('logtrue')) return;
  
      if (!isLoggedIn()) {
        event.preventDefault();
      }
    });
  });




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
// login.js の読み込みのみ（.env情報は渡さない）
// ========================
function enqueue_login_script()
{
    wp_enqueue_script(
        'login-js',
        get_template_directory_uri() . '/assets/js/login.js',
        array(),
        filemtime(get_template_directory() . '/assets/js/login.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_login_script');

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

    if ($username === $env_username && $password === $env_password) {
        $_SESSION['loggedIn'] = true;
        wp_send_json_success();
    } else {
        wp_send_json_error('ユーザー名またはパスワードが正しくありません。');
    }
    wp_die();
}