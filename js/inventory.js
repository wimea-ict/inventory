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