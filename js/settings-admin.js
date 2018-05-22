$(document).ready(function() {

	$('#n2ntransfer select').change(function() {
		OCP.AppConfig.setValue('n2ntransfer', $(this).attr('id'), $(this).val());
	});
	$('#n2ntransfer input').change(function() {
		var value = 'no';
		if (this.checked) {value = 'yes';}
		OCP.AppConfig.setValue('n2ntransfer', $(this).attr('id'), $(this).val());
	});
});
