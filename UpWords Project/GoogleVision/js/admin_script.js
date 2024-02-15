// on admin page when user submit the login form triger this
$("#login_form").on("submit", function () {

    $flag = true;
 
    // validate email
    var email_expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    var password_expr = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$/;

    var login_email  = $("#login_email").val();
    var login_password = $("#login_password").val();

    if (!email_expr.test(login_email)) {
        $flag = false;
        $('.email_err').text('Please enter valid email.');
    }else{
        $('.email_err').text('');
    }
    
    // validate password 
    if (!password_expr.test(login_password)) {
        $flag = false;
        $('.pass_err').html('Please enter valid password');
        $('.pass_err').html('Contain at least 6 characters contain at least 1 number <br>'
                            +' contain at least 1 lowercase character (a-z)<br>'
                            +' contain at least 1 uppercase character (A-Z)<br>'
                            +' contains only 0-9a-zA-Z');
    }else{
        $('.pass_err').html('');
    }

    return $flag;

});