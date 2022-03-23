$(document).ready(function() {

  var table = $('#gb_datatable').DataTable({
    //"dom": 'Blfrtip',
    "lengthMenu": [
      [10, 50, 100, 1000, -1],
      [10, 50, 100, 1000, "All"]
    ],
    "initComplete": function() {
      $("#reminders").show();
    }
  });

  $('#gb_notifications').DataTable( {
        "order": [[ 0, "desc" ]]
  });

  //Initialize Select2 Elements
  $('.select2').select2();

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  });
   
  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });

});