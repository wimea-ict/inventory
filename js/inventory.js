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

$('.tabbed-nav li a').click(function(event) {
    event.preventDefault();

    var $this = $(this);

    // If we are currently on this tab, then we are done.
    if ($this.parent('li').hasClass('active')) {
        return;
    }

    var $parentRow = $this.parents('div.row');
    var $nextRow = $parentRow.next('div.row');

    // Show loading indicator.
    $nextRow.fadeOut(400, function() {
        $(this).replaceWith($(loadingIndicator));

        var url = $this.attr('href');
        $.get(url, function(data) {
            var result = $.parseJSON(data);
            var html = $.parseHTML(result.html);

            // Move the active class to the li parent for this link.
            $parentRow.find('.active').removeClass('active');
            $this.parents('li').addClass('active');

            // Show the new content.
            $parentRow.next('div.loading').fadeOut(100, function() {
                $(this).replaceWith($(html)).slideDown(600);

                // Re-initialize.
                init();
            });

            // Show tab action button if any.
            if (result.button) {
                $('#tab-action-button').attr('href', result.button.link).text(result.button.title);
            }
        });
    });
});