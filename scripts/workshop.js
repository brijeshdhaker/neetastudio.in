$(function() {

    $("input,textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var name = $("input#name").val();
            var email = $("input#email").val();
            var phone = $("input#phone").val();
            var courseType = $("input#courseType").val();
            var course = $("select#course").val();
            var message = $("textarea#message").val();
            var firstName = name; // For Success/Failure Message
            var _data = { 
                name: name,
                firstName: firstName,
                phone: phone, 
                email: email, 
                courseType:courseType, 
                course:course, 
                message: message
            };
            // Check for white space in name for Success/Fail message
            if (name.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
            $.ajax({
                url: "/resources/CommonServiceResource.php/common/register?_dc=6tgsfc5",
                type: "POST",
                dataType: 'json',
                contentType : 'application/json',
                data: JSON.stringify(_data),
                cache: false,
                success: function(_response) {
                    //alert(data);
                    //$.parseJSON(_response);
                    var _data = _response['data'];
                    if (window.console) {
                        console.log(_data);
                    }
                    // Success message
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
                    $('#success > .alert-success').append("<strong>" + _response['message'] + "</strong>");
                    $('#success > .alert-success').append('</div>');
                    //clear all fields
                    $('#contactForm').trigger("reset");
                },
                error: function() {
                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
                    $('#success > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    $('#contactForm').trigger("reset");
                }
            });
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


/*When clicking on Full hide fail/success boxes */
$('#name').focus(function() {
    $('#success').html('');
});
