$(function () {
  var dt_ajax_table = $('.datatables-ajax');

  if (dt_ajax_table.length) {
    var dt_ajax = dt_ajax_table.DataTable({
      processing: true,
      ajax: 'public/json/main_menu.php',
      dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      autoWidth: true, // Enable auto width calculation
      responsive: true, // Makes the table responsive for different screen sizes
      columns: [
        { data: 0, title: 'Trans No' },
        { data: 1, title: 'Name' },
        { data: 2, title: 'Status' },
        {
          data: null,
          title: 'Actions',
          orderable: false,
          searchable: false,
          render: function (data, type, row, meta) {
            return `
              <button class="btn btn-primary" onclick="editRecord('${row[0]}')">Edit</button>
              <button class="btn btn-danger" onclick="deleteRecord('${row[0]}')">Delete</button>
            `;
          }
        }
      ],
      columnDefs: [
        // { targets: '_all', className: 'text-center' },
        {
          targets: 2,
          render: function (data) {
            return data === '1'
              ? '<span class="badge bg-label-success me-1">Complete</span>'
              : '<span class="badge bg-label-danger me-1">Pending</span>';
          }
        }
      ]
    });
  }
});

// Example JavaScript functions for the buttons
function editRecord(transNo) {
  alert('Edit transaction: ' + transNo);
  // Add your edit logic here
}

function deleteRecord(transNo) {
  alert('Delete transaction: ' + transNo);
  // Add your delete logic here
}
