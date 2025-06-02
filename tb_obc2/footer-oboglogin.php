<?php
/**
 * OBOGログインフッター
 */
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php wp_footer(); ?>
<script>
$(document).ready(function() {
//$(window).on('load', function () {
	var obogLoginUrl = window.location.href;
	if (obogLoginUrl.indexOf("?drui=") > 0) {
		$('#drui').val( $('#drui').val() + window.location.hash );
		obogLoginUrl = obogLoginUrl.substring(0, obogLoginUrl.indexOf("?drui="));
		window.history.replaceState({}, document.title, obogLoginUrl);
	}
});
</script>
</body>
</html>