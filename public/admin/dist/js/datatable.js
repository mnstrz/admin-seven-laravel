$(function () {
    $(".data-table1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('.data-table2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });