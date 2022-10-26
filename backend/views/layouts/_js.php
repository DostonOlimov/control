<script type="text/javascript">
	$(function(){
		$('.inn').mask('000000000');
		$('.date').mask('0000-00-00');
		$('.dateFilter').mask('00.00.0000');
		$('.profile-phone').mask('+998 (00) 000-00-00');
		$('.select2').select2();

		yii.confirm = function (message, okCallback, cancelCallback) {
			swal({
				title: '',
				text: message,
				type: 'warning',
				showCancelButton: true,
				closeOnConfirm: true,
				allowOutsideClick: true
			}, okCallback);
		};
	});
</script>