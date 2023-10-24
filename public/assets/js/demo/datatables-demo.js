// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable-users').DataTable({
    dom: 'Bfrtip',
        buttons: [
            {
              extend:'csv',
              exportOptions: {
                columns: [ 0, 1 ]
              }
            }
        ]
  });

  $('#dataTable-products').DataTable({
    dom: 'Bfrtip',
        buttons: [
            {
              extend:'csv',
              exportOptions: {
                columns: [ 0, 1, 2, 3]
              }
            }
        ]
  });

  $('#dataTable-categories').DataTable({
    dom: 'Bfrtip',
        buttons: [
            {
              extend:'csv',
              exportOptions: {
                columns: [ 0, 1 ]
              }
            }
        ]
  });
 $('.buttons-csv').addClass('btn btn-primary');
});
