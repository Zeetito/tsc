$(document).ready(function(){

 // Hide Session Messages after 5 Seconds

    // Find the popMessage element using jQuery
    var popMessageElement = $('.PopMessage');

    // Hide the popMessage element after 5 seconds (5000 milliseconds)
    setTimeout(function() {
        popMessageElement.slideUp(500);
    }, 5000);

 // Data Tables
 $('.datatable_print').DataTable( {
    dom:'Bfrtip',
    buttons: [
        // 'copy', 'pdf','print','excel',
        'print','excel',
    ]

} );

$('.datatable').DataTable( {

} );

});