{/* <tr>
<th>Action</th>
<th>No</th>
    <th>Date</th>
    <th>Username</th>
    <th>Spare Time</th>
    <th>Office Name</th>
    <th>Approve Order</th>
    <th>Spam Order</th>
    <th>Bank Payment</th>
    <th>Average Check</th>
    <th>Calculation Approval</th>
    <th>Approved Amount</th>
    <th>Combo</th>
    <th>Full Login Time</th>
    <th>Status</th>
    <th>Total Attempts</th>
    <th>Status Since</th>
    <th>Work Warned</th>
</tr> */}


  
  socket.emit('subscribe', 'stat_agent', 'tb_opstatus', 'stat_agent.id_statuse', 'tb_opstatus.id_statuse');
  
  let nb = 1;


  socket.on("update", (data) => {
    const agents = JSON.parse(data);

   const tableData = agents.map(agent => {


   const showpopup = `<button style="border:none;background:transparent;"><i class='fa fa-key' style='color:black;' onclick="openModal(${agent.id_agent})" data-toggle='modal' data-target='#modal-default2'></i></button>`; 

   const number = nb ++;

  return {
      action: showpopup,
      number: number, 
      date: agent.tgl_login,
      username: agent.username_agent,
      spare: agent.spare_time,
      office: agent.office_name,
      approveOrder: agent.approved_order,
      spamOrder: agent.spam_order,
      bank: agent.bank_payment,
      average: agent.average_check,
      callculation: agent.callculation_approval,
      approvedAmount: agent.approved_amount,
      combo: agent.combo,
      fullLogin: agent.day_duration,
      status: agent.statuse,
      totalatt: agent.total_attempth,
      statussince: agent.tgl_login,
      workwarned: 'N/A',
  };
});

    const existingTable = document.getElementById('example1');
    if (existingTable) {
        $(existingTable).DataTable().destroy(); // Menghancurkan instance DataTable yang ada
        existingTable.parentNode.removeChild(existingTable); // Menghapus tabel yang ada
    }

    // Membuat tabel baru dan menginisialisasi DataTables
    const table = document.createElement('table');
    table.id = 'example1';
    table.className = 'table table-hover text-nowrap text-xs';
    table.style = 'width:100%';


    const cardBody = document.getElementById('cardBody'); 
    cardBody.appendChild(table);

    $('#example1').DataTable({
        data: tableData,
        columns: [
            { data: 'action', title: 'Action' },
            { data: 'number', title: 'Number' },
            { data: 'date', title: 'Date' },
            { data: 'username', title: 'Username' },
            { data: 'spare', title: 'Spare Time' },
            { data: 'office', title: 'Office' },
            { data: 'approveOrder', title: 'Approve Order' },
            { data: 'spamOrder', title: 'Spam Order' },
            { data: 'bank', title: 'Bank Payment' },
            { data: 'average', title: 'Average Check' },
            { data: 'callculation', title: 'Calculation Approval' },
            { data: 'approvedAmount', title: 'Approved Amount' },
            { data: 'combo', title: 'Combo' },
            { data: 'fullLogin', title: 'Full Login Time' },
            { data: 'status', title: 'Status' },
            { data: 'totalatt', title: 'Total Attempts' },
            { data: 'statussince', title: 'Status Since' },
            { data: 'workwarned', title: 'Work Warned' }
        ],
        dom: 'Bfrtip', // Menambahkan 'l' untuk menampilkan "Show Entries"
    buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'],
    }).buttons().container().appendTo('#topcontent');
});

$('#example2').DataTable({
  dom: 'Bfrtip', // Menambahkan 'l' untuk menampilkan "Show Entries"
buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'],
}).buttons().container().appendTo('#topcontent2');



  





