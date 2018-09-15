function SubmitFormData() {
	var name = $("#form_name").val();
	var company = $("#form_company").val();
	var phone = $("#form_phone").val();
	var email = $("#form_email").val();
	var message = $("#form_message").val();
	$.post("contact.php", { name: name, company: company, phone: phone, email: email, message: message },
	   function(data) {
		 $('#submit-result').show();
		 $('#contact-form')[0].reset();
	   });
}

