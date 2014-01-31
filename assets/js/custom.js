;(function($) {
$(document).ready(function() {
		
	$.validator.addMethod(
			"alpha",
			function(value, element) {
				return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
			},
			"Only Characters Allowed."
	);
		
	$.validator.addMethod(
			"alphaspecial",
			function(value, element,params) {
				return this.optional(element) || value == value.match(/^[-a-zA-Z_ ]+$/);
			},
			"Only letters & Dash/Space/underscore Allowed."
	);
			
	$.validator.addMethod(
			"alphanumeric",
			function(value, element,params) {
				return this.optional(element) || value == value.match(/^[a-z0-9A-Z]+$/);
			},
			"Only letters and Numbers Allowed."
	);
	
	$.validator.addMethod(
			"alphanumericwithdash",
			function(value, element,params) {
				return this.optional(element) || value == value.match(/^[a-z0-9A-Z-]+$/);
			},
			"Only letters, Numbers & Dash Allowed."
	);
	
	$.validator.addMethod(
			"alphanumericspecial",
			function(value, element) {
				return this.optional(element) || value == value.match(/^[-a-zA-Z0-9,._ /]+$/);
			}, 
			"Only letters, Numbers & Dash/Space/underscore/Slash Allowed."
	);

	$.validator.addMethod(
			"numeric",
			function(value, element,params) {
				return this.optional(element) || value == value.match(/^[0-9]+$/);
			}, 
			"Only Numbers Allowed."
	);

	$.validator.addMethod(
			"numericspecial",
			function(value, element) {
				return this.optional(element) || value == value.match(/^[-0-9.+ ]+$/);
			}, 
			"Only Numbers & Plus/Minus/Period/Space Allowed."
	);
            
        $.validator.addMethod(
			"decimalnumeric",
			function(value, element) {
				return this.optional(element) || value == value.match(/^\d*\.?\d*$/);
			}, 
			"Only Decimal Numbers Allowed."
	);
})
})(jQuery);


function messageBox() {
	$("#messageBox").dialog({				
		modal: true,
		closeOnEscape: true,
		resizable: true,
		title: 'Message',
		minHeight: 100
	});
}

