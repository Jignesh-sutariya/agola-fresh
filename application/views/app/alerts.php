<?php if (!empty($_SESSION['alert'])) { ?>
<script type="text/javascript" charset="utf-8">
	const transitionLength = 700;

	let toastContain = document.createElement('div');
	toastContain.classList.add('toastContain');
	document.body.appendChild(toastContain);

	function toast(str, time, addClass = 'default') {
	if (!time || time === 'default') {
	  time = 2000;
	}
	let toastEl = document.createElement('div');
	toastEl.classList.add('toast', addClass);
	toastEl.innerText = str;
	toastContain.prepend(toastEl);
	setTimeout(() => toastEl.classList.add('open'));
	setTimeout(
	  () => toastEl.classList.remove('open'),
	  time
	);
	setTimeout(
	  () => toastContain.removeChild(toastEl),
	  time + transitionLength
	);
	}

	"<?php foreach ($_SESSION['alert'] as $key => $v): ?>";
		toast("<?= $v ?>", 'default', 'critical');
	"<?php endforeach ?>";
</script>
<?php } ?>