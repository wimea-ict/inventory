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

    var url = $this.attr('href');
    $.get(url, function(data) {
        var html = $.parseHTML(data);

        // Move the active class to the li parent for this link.
        $row.find('.active').removeClass('active');
        $this.parents('li').addClass('active');

        // Show the new content.
        $row.next('div.row').replaceWith($(html));

        // Activate data tables.
        $('#data-table').DataTable({
            responsive: true
        });
    });
});