// ✕ボタンクリックで非表示にする
document
  .getElementById("close-btn")
  .addEventListener("click", function (event) {
    document.getElementById("login-form").style.display = "none";
    document.getElementById("overlay").style.display = "none";
    event.stopPropagation();
    if(location.href != 'https://nagahama-p.sakura.ne.jp/obog/'){
    	location.replace('https://nagahama-p.sakura.ne.jp/obog/');
    }
  });

// ログインフォーム送信時にサーバーで認証
document.querySelector("#login-form form").addEventListener("submit", function (event) {
  event.preventDefault();

  const inputUsername = document.getElementById("username").value;
  const inputPassword = document.getElementById("password").value;

  fetch(window.wp_ajax_url + '?action=custom_login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `username=${encodeURIComponent(inputUsername)}&password=${encodeURIComponent(inputPassword)}`
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {        
		location.replace(document.getElementById("drui").value); 
      } else {
        alert(data.data || "ログインに失敗しました。");
      }
    });
});

document.querySelectorAll('a').forEach(function(link) {
  link.addEventListener('click', function(event) {
      if (link.classList.contains('logtrue')) return;

      // 未ログインの場合、フォームとオーバーレイを表示      
      event.preventDefault(); // デフォルトの遷移を防ぐ
      const loginForm = document.getElementById("login-form");
      const overlay = document.getElementById("overlay");
      $('#drui').val(link.getAttribute('href'));

      if (loginForm && overlay) {
          loginForm.style.display = "block"; // フォームを表示
          overlay.style.display = "block"; // オーバーレイを表示
      }
  });
});
