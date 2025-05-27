// セッションストレージでログイン状態を管理
function isLoggedIn() {
    return sessionStorage.getItem("loggedIn") === "true";
  }
  function setLoggedIn() {
    sessionStorage.setItem("loggedIn", "true");
  }
  
  // 初回ロード時、ログイン済みならフォームもオーバーレイも非表示
  window.addEventListener("DOMContentLoaded", function () {
    if (!isLoggedIn()) {
        document.getElementById("login-form").style.display = "block";
        document.getElementById("overlay").style.display = "block";
    } else {
        // 未ログイン時はオーバーレイとログインフォームを表示
        document.getElementById("overlay").style.display = "none";
        document.getElementById("login-form").style.display = "none";
    }
});
  
  // クリックでフォーム表示（何度でも→ログイン済みなら出さない）
  document.addEventListener("click", function (event) {
    const loginForm = document.getElementById("login-form");
    const overlay = document.getElementById("overlay");
  
    if (!loginForm || !overlay) return; // nullチェック
  
    if (isLoggedIn()) return;
    if (loginForm.contains(event.target) || overlay.contains(event.target)) return;
  
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
  
    // window.wp_ajax_urlが定義されている前提
    console.log(window.wp_ajax_url + '?action=custom_login'); // デバッグ用
  
    fetch(window.wp_ajax_url + '?action=custom_login', {
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
  
