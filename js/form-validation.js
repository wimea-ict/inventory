function validateForms() {
    // Creating a new category.
    $('#create-category-form').validate();

    // Creating a new item.
    $('#create-item-form').validate();

    // Create user form.
    $('#create-user-form').validate({
        rules: {
            password2: {
                required: true,
                equalTo: '#password'
            }
        },
        messages: {
            password2: {
                required: 'Please confirm password',
                equalTo: 'The two passwords do not match'
            }
        }
    });

    // Changing a password.
    $('#change-password-form').validate({
        rules: {
            password2: {
                required: true,
                equalTo: '#password1'
            }
        },
        messages: {
            password2: {
                required: 'Please confirm password',
                equalTo: 'The two passwords do not match'
            }
        }
    });

    // Edit profile form.
    $('#edit-profile-form').validate();

    // Creating a new batch.
    $('#new-batch-form').validate();

    // Returning items.
    $('#return-items-form').validate();

    // Giving out items.
	$('#give-items-out-form').validate();
	
	// Creating a station node.
	$('#create-node-form').validate();
}
