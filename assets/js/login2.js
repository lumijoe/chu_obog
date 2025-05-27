// セッションストレージでログイン状態を管理
function isLoggedIn() {
  return sessionStorage.getItem("loggedIn") === "true";
}
function setLoggedIn() {
  sessionStorage.setItem("loggedIn", "true");
}


// ✕ボタンクリックで非表示にする
document
  .getElementById("close-btn")
  .addEventListener("click", function (event) {
    document.getElementById("login-form").style.display = "none";
    document.getElementById("overlay").style.display = "none";
    event.stopPropagation();
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

document.querySelectorAll('a').forEach(function(link) {
  link.addEventListener('click', function(event) {
      // target="_blank" かつ logtrue クラスが付与されている場合のみスルー（遷移を許可）
      if (link.target === "_blank" && link.classList.contains('logtrue')) return;
      if (link.getAttribute('href').startsWith('#') && link.classList.contains('logtrue')) return;

      // 未ログインの場合、フォームとオーバーレイを表示
      if (!isLoggedIn()) {
          event.preventDefault(); // デフォルトの遷移を防ぐ
          const loginForm = document.getElementById("login-form");
          const overlay = document.getElementById("overlay");

          if (loginForm && overlay) {
              loginForm.style.display = "block"; // フォームを表示
              overlay.style.display = "block"; // オーバーレイを表示
          }
      }
  });
});
