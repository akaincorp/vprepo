{/* <tr>
<th><input type="checkbox" id="checkboxall"></th>
<th>Order Date/Number</th>
<th>Processing To Agent</th>
<th>Name</th>
<th>Phone</th>
<th>Status</th>
<th>Comment</th>
<th>Products</th>
<th>Delivery Comment</th>
<th>Group Price</th>
</tr> */}


socket.emit('subscribejoin', 'tb_queue', 'tb_procces', 'tb_callback', 'tb_notconnect', 'tb_disclaimer', 'tb_spam','tb_agent', 'tb_queue.id_statusf', 'tb_procces.id_statusf', 'tb_queue.id_status', 'tb_callback.id_status','tb_queue.id_statusc', 'tb_notconnect.id_statusc', 'tb_queue.id_statusb', 'tb_disclaimer.id_statusb', 'tb_queue.id_statusd', 'tb_spam.id_statusd','tb_queue.id_agent','tb_agent.id_agent' );

socket.on("update", (data) => {
  const agents = JSON.parse(data);

 const tableData = agents.map(agent => {

const showpopup = `<b data-toggle='modal' data-target='#modal-xl' style="cursor:pointer;" onclick="openModal(${agent.order_id})">${agent.order_id}</b><br>${agent.order_date}`; 

const agentHandlingDiv = document.createElement('div');
agentHandlingDiv.textContent = agent.username;
agentHandlingDiv.innerHTML += '<br>';
const datecom = document.createElement('p')
datecom.textContent = agent.date_comment;
agentHandlingDiv.appendChild(datecom);

const fullName = `${agent.first_name} ${agent.last_name}`;

const statusText = (agent.status ? `${agent.status}` : '') + `${agent.statusb}${agent.statusc}${agent.statusd}${agent.statusf}`;


return {
    checkbox: `<input type="checkbox" class="checkboxtabel" name="hapus[]" value="${agent.id_customer}">`,
    order_date: showpopup, // Mengambil HTML dari cellContainer
    id_agent: agentHandlingDiv.innerHTML,
    name: fullName,
    phone: agent.phone,
    status: statusText,
    comment: agent.operator_comment,
    product: agent.nama_product,
    delivery: agent.delivery_comment,
    group: agent.promo,
};
});

  const checkboxAll = document.createElement('input');
  checkboxAll.setAttribute('type', 'checkbox');
  checkboxAll.id = 'checkboxall';
  checkboxAll.onclick = function() {
      var checkboxes = document.querySelectorAll('.checkboxtabel');
      checkboxes.forEach(function(checkbox) {
          checkbox.checked = checkboxAll.checked;
      });
  };



  const checkboxHeader = document.createElement('th');
  checkboxHeader.appendChild(checkboxAll);

  const existingTable = document.getElementById('example1');
  if (existingTable) {
      $(existingTable).DataTable().destroy(); // Menghancurkan instance DataTable yang ada
      existingTable.parentNode.removeChild(existingTable); // Menghapus tabel yang ada
  }

  // Membuat tabel baru dan menginisialisasi DataTables
  const table = document.createElement('table');
  table.id = 'example1';
  table.className = 'table table-bordered table-striped text-xs';
  table.style = 'width:100%';

  const thead = table.createTHead();
  const headerRow = thead.insertRow();

  headerRow.appendChild(checkboxHeader); // Kolom untuk checkbox "Select All"

  const columnTitles = [
      'Order Date/Number',
      'Agent Handling',
      'Name',
      'Phone',
      'Status',
      'Comment',
      'Products',
      'Delivery Comment',
      'Group Price'
  ];

  columnTitles.forEach(title => {
      const th = document.createElement('th');
      th.textContent = title;
      headerRow.appendChild(th);
  });

  const cardBody = document.getElementById('cardBody'); 
  cardBody.appendChild(table);

  $('#example1').DataTable({
      data: tableData,
      columns: [
          { data: 'checkbox' },
          { data: 'order_date', title: 'Order Date/Number' },
          { data: 'id_agent', title: 'Agent Handling' },
          { data: 'name', title: 'Name' },
          { data: 'phone', title: 'Phone' },
          { data: 'status', title: 'Status' },
          { data: 'comment', title: 'Comment' },
          { data: 'product', title: 'Products' },
          { data: 'delivery', title: 'Delivery Comment' },
          { data: 'group', title: 'Group Price' }
      ],
      dom: 'lBfrtip', // Menambahkan 'l' untuk menampilkan "Show Entries"
  buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
  ],
  lengthMenu: [
      [10, 25, 50, 100],
      [10, 25, 50, 100]
  ],
  pageLength: 10
  });
});




