jQuery(document).ready(function() {
    jQuery("#n2ntransfer input, #n2ntransfer button#checkAll").change(function() {
		var cur=jQuery(this).attr('aria-data-current');
		var level=jQuery(this).attr('aria-data-level');
		var checked=this.checked;
		setCheckboxes(cur, level, checked);
	});
	jQuery("#n2ntransfer button#checkAll").click(function() {
		var checked=jQuery("#n2ntransfer button#checkAll").attr('aria-data-checked');
		if(checked==0) {checked=1;} else {checked=0;}
		setCheckboxes(-1, -1, checked);
		jQuery("#n2ntransfer button#checkAll").attr('aria-data-checked', checked);
	});
	
	function setCheckboxes(cur, level, checked) {
		jQuery("#n2ntransfer input").each(function() {
			if(cur > jQuery(this).attr('aria-data-current')) {return true;}		//continue
			if(level >= jQuery(this).attr('aria-data-level') && cur!=jQuery(this).attr('aria-data-current')) {return false;}	//break
			if (checked) {
				this.checked=true;
			} else {
				this.checked=false;
			}
			
		});
	}
});