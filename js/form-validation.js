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

// Creating a new batch.
$('#new-batch-form').validate();

// Returning items.
$('#return-items-form').validate();

// Giving out items.
$('#give-items-out-form').validate();