$(function() {

    $("input,textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            //
            var formData = Object.fromEntries($form.serializeArray().map((t) => [t.name, t.value]));
            // get values from FORM
            //var action = $("input#action").val();
            //var name = $("input#name").val();
            //var email = $("input#email").val();
            //var phone = $("input#phone").val();
            //var message = $("textarea#message").val();
            //
            switch (formData['action']) {
                case 'connect-us':
                  submit_url = "/controllers/contactus?_dc=6t45fc5&_src=site";
                  break;
                case 'collaborate':
                  submit_url = "/controllers/subcribe-services?_dc=6t47fc5&_src=site";
                  break;
                case 'newsletter':
                  submit_url = "/controllers/subcribe-services?_dc=6t47fc5&_src=site";
                  //interest_type = $("select#interest_type").val();
                  //_data['interest_type'] = interest_type;
                  break;                  
                case 'booksession':
                    submit_url = "/controllers/book-session?_dc=6t48fc5&_src=site";
                  break;
                default:
                  submit_url = "/controllers/contactus?_dc=6t45fc5&_src=site";
            }
            if (!formData['first_name']) {
                if (formData['name'].indexOf(' ') >= 0) {
                    
                    const nameParts = formData['name'].split(' ').filter(Boolean);
                    const firstName = nameParts[0];
                    const lastName = nameParts.slice(1).join(' ');
                    formData['first_name'] = formData['name'].split(' ').slice(0, -1).join(' ');
                    formData['last_name'] = formData['name'].split(' ').slice(1).join(' ');
                }
            }
            //
            if (window.console) {
                console.log(formData);
            }
            //
            $.ajax({
                url: submit_url,
                type: "POST",
                dataType: 'json',
                contentType : 'application/json',
                data: JSON.stringify(formData),
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
                    $form.trigger("reset");
                },
                error: function() {
                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
                    $('#success > .alert-danger').append("<strong>Sorry, it seems there are issue at server. Please try again later !");
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    $form.trigger("reset");
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
