var CustomValidation = {};

(function($){


  CustomValidation = {


    init: function(form_submit, name, email, message, headerAppend) {
      CustomValidation.form_submit = form_submit;
      CustomValidation.name = name;
      CustomValidation.email = email;
      CustomValidation.message = message;
      CustomValidation.headerAppend = headerAppend;

      CustomValidation.fields = {
        'name' : CustomValidation.name,
        'email' : CustomValidation.email,
        'message' : CustomValidation.message
      }

      CustomValidation.fieldsVal = {};

      // Click Handler that runs the function
      CustomValidation.form_submit.click(function () {
        // Validate all the fields and add to CustomValidation.fieldsVal object
        CustomValidation.validate_fields();

        // Return a boolean that tells you the status of All the fields:
        validated = CustomValidation.analyze_validation();

        // pass validated var into a display error function
        CustomValidation.add_global_msg(validated);
        if (validated == true) {
          CustomValidation.send_ajax();
        }

      });
    },
    validate_fields: function() {
      // Go through each of the fields to make sure they are filled out.
      var fields = CustomValidation.fields;

      $.each(fields, function(index, item) {
        // Go through each of the fields and set something that indicates which fields aren't true
        getValue = item.val();

        if (getValue == null || getValue == '' || getValue == false) {
          item.after('<small class="error">Please enter something for the ' + index + ' field.</small>');
          item.addClass('error');
          CustomValidation.fieldsVal[index] = false;
        } else {
          if (index == 'email') {
            isValid = CustomValidation.validate_email();
            if (isValid == false) {
              item.after('<small class="error">Please enter a proper email address.</small>');
              CustomValidation.fieldsVal[index] = false;
            }
            else {
              CustomValidation.fieldsVal[index] = true;
            }
          }
          else {
            CustomValidation.fieldsVal[index] = true;
          }
        }
      });
    },
    analyze_validation: function() {
      var booleanReturn = true;

      $.each(CustomValidation.fieldsVal, function(index, item) {
        if (item == false) {booleanReturn = false; return false;}
        else {booleanReturn = true;}
      });
      return booleanReturn;
    },
    add_global_msg: function(validationBool) {
      // Adds an error msg if something went wrong
      validated = validationBool;
      if (validated == false) {
        CustomValidation.headerAppend.append('<div data-alert class="alert-box alert round"> Something went wrong <a href="#" class="close">&times;</a> </div>');
      }

    },
    validate_email: function() {
      var email = CustomValidation.email.attr("value"),
        name = email.indexOf("@"),
        namespace = email.indexOf(".");

      if (name < 1 || namespace < name + 2 || namespace + 2 >= email.length) {
        return false;
      }
      return true;
    },
    send_ajax: function() {
      var name = CustomValidation.name.val(),
        email = CustomValidation.email.val(),
        mgs = CustomValidation.message.val();

      $.ajax({
        type: "POST",
        url: simple_contact_form_ajax.simple_contact_form_ajaxurl,
        data: {
          action: "simple_contact_form_send",
          name: name,
          email: email,
          mgs: mgs
        },
        success: function () {
          $('.error').hide();
          $('.alert').hide();
          successText = "Thanks for contacting us. We will contact you shortly.";

          CustomValidation.form_submit.parents('form').hide();
          CustomValidation.headerAppend.append('<div data-alert class="alert-box info"> ' + successText + ' <a href="#" class="close">&times;</a> </div>');

        }
      });
    }
  };

  $(function() {
      var form_submit = $("#contact-form-submit"),
        name = $("#contact-form-name"),
        email = $("#contact-form-email"),
        message = $("#contact-form-mgs"),
        headerAppend = $('article header');

      CustomValidation.init(form_submit, name, email, message, headerAppend);
    
  });
}(jQuery));
