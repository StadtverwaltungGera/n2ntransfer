$(document).ready(function() {

	$('#generictrigger select').change(function() {
		OCP.AppConfig.setValue('generictrigger', $(this).attr('id'), $(this).val());
	});
	$('#generictrigger input').change(function() {
		var value = 'no';
		if (this.checked) {value = 'yes';}
		OCP.AppConfig.setValue('generictrigger', $(this).attr('id'), $(this).val());
	});
});
