var baseUrl = "http://localhost/inventory/";
var loadingIndicator = "<div class='row loading'>" +
                            "<div class='col-lg-12'>" +
                                "<img src='" + baseUrl + "images/ajax-loader.gif'>" +
                                "<span>&nbsp;Loading...</span>" +
                            "</div>" +
                        "</div>";

$('#more-items').click(function(event) {
    event.preventDefault();
    
    $('#item').clone().appendTo($('#items')).css({marginTop: '5px'});
    $('#quantity').clone().val('').appendTo($('#quantities')).css({marginTop: '5px'});
});

$('#data-table').DataTable({
    responsive: true
});

$('.date-picker').datepicker({
    dateFormat: "yy-mm-dd"
});

$('.tabbed-nav li a').click(function(event) {
    event.preventDefault();

    var $this = $(this);
    var $row = $this.parents('div.row');
    var $nextRow = $row.next('div.row');

    // Show loading indicator.
    $nextRow.fadeOut(400, function() {
        $(this).replaceWith($(loadingIndicator));

        var url = $this.attr('href');
        $.get(url, function(data) {
            var html = $.parseHTML(data);

            // Move the active class to the li parent for this link.
            $row.find('.active').removeClass('active');
            $this.parents('li').addClass('active');

            // Show the new content.
            $row.next('div.loading').fadeOut(100, function() {
                $(this).replaceWith($(html)).slideDown(1000);

                // Activate data tables.
                $('#data-table').DataTable({
                    responsive: true
                });
            });
        });
    });
});