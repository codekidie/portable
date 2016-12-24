function checkPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();

    if (password != confirmPassword)
    {
            $.notify({
				message: "Passwords do not match!"
			});	
            $('.submit-settings').hide();

    }else{
        $.notify({
			message: "Passwords match!"
		});	

        $('.submit-settings').show();
    }     

}

$(document).ready(function () {
   $("#txtConfirmPassword").keyup(checkPasswordMatch);
});

