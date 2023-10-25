// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable-users').DataTable({
    dom: 'Bfrtip',
        buttons: [
            {
              extend:'csv',
              title:'users',
              exportOptions: {
                columns: [ 0, 1 ]
              },
              text: '<i class="far fa-file-excel"></i>',
              titleAttr: 'Excel'
            }
        ],
        ordering: false
  });

  $('#dataTable-products').DataTable({
    dom: 'Bfrtip',
        buttons: [
            {
              extend:'csv',
              title:'products',
              exportOptions: {
                columns: [ 0, 1, 2, 3]
              },
              text: '<i class="far fa-file-excel"></i>',
              titleAttr: 'Excel'
            }
        ],
        ordering: false
  });

  $('#dataTable-categories').DataTable({
    dom: 'Bfrtip',
        buttons: [
            {
              extend:'csv',
              title:'categories',
              exportOptions: {
                columns: [ 0, 1 ]
              },  
              text: '<i class="far fa-file-excel"></i>',
              titleAttr: 'Excel',
              
            }
        ],
        ordering: false
  });

 $('.buttons-csv').addClass('btn btn-primary');
});
