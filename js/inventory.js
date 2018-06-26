var baseUrl = "http://localhost/inventory/";
var loadingIndicator = "<div class='row loading'>" +
                            "<div class='col-lg-12'>" +
                                "<img src='" + baseUrl + "images/ajax-loader.gif'>" +
                                "<span>&nbsp;Loading...</span>" +
                            "</div>" +
                        "</div>";

// Define and call the init function.
function init() {
    $('#data-table').DataTable({
        responsive: true
    });

    $('.date-picker').datepicker({
        dateFormat: "yy-mm-dd"
    });

    validateForms();
};

init();

// Adding more times to a transaction.
$('body').on('click', '#more-items', function(event) {
    event.preventDefault();
    
    $('#item').clone().appendTo($('#items')).css({marginTop: '5px'});
    $('#quantity').clone().val('').appendTo($('#quantities')).css({marginTop: '5px'});
});

// Tabbed navigation.
function updateSideBarNav() {
    // Clear active state from previous link item.
    $('ul.nav a.active').removeClass('active');

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
}

$('.tabbed-nav li a').click(function(event) {
    event.preventDefault();

    var $this = $(this);

    // Remove focus from this link.
    $this.trigger('blur');

    // Show loading indicator.
    $('#content').fadeOut(400, function() {
        $(this).replaceWith($(loadingIndicator));

        var url = $this.attr('href');
        $.get(url, function(data) {
            var result = $.parseJSON(data);

            // Update browser tab title and location.
            document.title = result.title + ' | WIMEA-ICT Inventory Management System';
            window.history.pushState({"result": result}, "", url);

            // Move the active class to the li parent for this link.
            $this.parents('div.row').find('.active').removeClass('active');
            $this.parents('li').addClass('active');

            updateSideBarNav();

            // Show the new content.
            var html = $.parseHTML(result.html);
            $('div.loading').fadeOut(100, function() {
                $(this).replaceWith($(html)).slideDown(600);

                // Re-initialize.
                init();
            });

            // Update tab action button.
            if (result.button) {
                $('#tab-action-button').attr('href', result.button.link).text(result.button.title);
            }
        });
    });
});

// Back/forward button navigation.
window.onpopstate = function(event) {
    var $this = null;
    $('.tabbed-nav li a').each(function(index) {
        if ($(this).attr('href') == window.location) {
            // Store reference for later use.
            $this = $(this);

            // Move the active class to the li parent for this link.
            $this.parents('div.row').find('.active').removeClass('active');
            $this.parents('li').addClass('active');

            updateSideBarNav();
        }
    });

    if (event.state) {
        var result = event.state.result;
        this.document.title = result.title;

        var html = $.parseHTML(result.html);
        $('#content').fadeOut(100, function() {
            $(this).replaceWith($(html)).slideDown(600);

            // Re-initialize.
            init();
        });

        // Update tab action button.
        if (result.button) {
            $('#tab-action-button').attr('href', result.button.link).text(result.button.title);
        }
    }
    else {
        if ($this != null) {
            $this.trigger('click');
        }
    }
}