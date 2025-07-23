$(function() {

    $("input,textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var action = $("input#action").val();
            var name = $("input#name").val();
            var email = $("input#email").val();
            var phone = $("input#phone").val();
            var message = $("textarea#message").val();
                        
            var _data = { 
                name: name, 
                phone: phone, 
                email: email, 
                message:message,
                action: action
            };
            
            // Check for white space in name for Success/Fail message
            if (name.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
                _data['firstName'] = firstName;
            }else{
                _data['firstName'] = name;
            }
            
            //
            switch (action) {
                case 'connect-us':
                  submit_url = "/controllers/contactus?_dc=6t45fc5&_src=site";
                  form_name  = "#contactForm";
                  _data['firstName'] = firstName;
                  var session_type = $("select#session_type").val();
                  _data['session_type'] = session_type;
                  break;
                case 'collaborate':
                  submit_url = "/controllers/subcribe-services?_dc=6t47fc5&_src=site";
                  form_name  = "#collaborateForm";
                  var service_type = $("select#service_type").val();
                  _data['service_type'] = service_type;
                  break;
                case 'newsletter':
                  submit_url = "/controllers/subcribe-services?_dc=6t47fc5&_src=site";
                  form_name  = "#subcribeForm";
                  interest_type = $("select#interest_type").val();
                  _data['interest_type'] = interest_type;
                  break;                  
                case 'photosession':
                  submit_url = "/controllers/photo-session?_dc=6t48fc5&_src=site";
                  form_name  = "#photoSessionForm";
                  break;
                // ... more case statements
                default:
                  submit_url = "/controllers/contactus?_dc=6t45fc5&_src=site";
                  form_name  = "#contactForm";
            }
            
            //
            if (window.console) {
                console.log(_data);
            }
            //
            $.ajax({
                url: submit_url,
                type: "POST",
                dataType: 'json',
                contentType : 'application/json',
                data: JSON.stringify(_data),
                cache: false,
                success: function(_response) {
                    
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
                    $(form_name).trigger("reset");
                },
                error: function() {
                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
                    $('#success > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    $(form_name).trigger("reset");
                }
            });
        },
        filter: function() {
            return $(this).is(":visible");
        }
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
