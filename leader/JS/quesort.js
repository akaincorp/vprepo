socket.emit('subscribejointhree', 'customerque', 'tb_procces', 'tb_quetype',  'customerque.id_statusf', 'tb_procces.id_statusf', 'customerque.id_statusg', 'tb_quetype.id_statusg' );
  
socket.on("update", (data) => {
  const agents = JSON.parse(data);

  let nb = 1;

 const tableData = agents.map(agent => {

  let number = nb ++;

return {
    checkbox: `<input type="checkbox" class="checkboxtabel" name="hapus[]" value="${agent.id_customer}">`,
    lastOperator: agent.last_operator, 
    number: number,
    attempth: agent.attempt,
    phone: agent.phone,
    name: agent.first_name,
    orderId: agent.order_id,
    orderDate: agent.order_date,
    orderStatus: agent.statusf,
    pauseStatus: agent.onpause,
    product: agent.product_name,
    queueType: agent.statusg,
    affid: agent.attempt,
    groups: agent.promo
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
      'Last Operator',
      'NB',
      'Attempt',
      'Phone Number',
      'Name',
      'Order Number',
      'Order Date',
      'Order Status',
      'Pause Status',
      'Product',
      'Queue Type',
      'AffID',
      'Groups'
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
          { data: 'lastOperator', title: 'Last Operator' },
          { data: 'number', title: 'NB' },
          { data: 'attempth', title: 'Attempt' },
          { data: 'phone', title: 'Phone' },
          { data: 'name', title: 'Name' },
          { data: 'orderId', title: 'Order Number' },
          { data: 'orderDate', title: 'Order Date' },
          { data: 'orderStatus', title: 'Order Status' },
          { data: 'pauseStatus', title: 'Pause Status' },
          { data: 'product', title: 'Product' },
          { data: 'queueType', title: 'Queue Type' },
          { data: 'affid', title: 'Aff ID' },
          { data: 'groups', title: 'Groups' }
      ],
      dom: 'lBfrtip', // Menambahkan 'l' untuk menampilkan "Show Entries"
  buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
  ],
  lengthMenu: [
      [10, 25, 50, 100],
      [10, 25, 50, 100]
  ],
  pageLength: 10,
  order: [[7, 'desc']] // Sorting
  }).buttons().container().appendTo('#topcontent');;
});
  

  
  //------------------------------------------------------------------------------------------//
  
  
  const toggleButton = document.getElementById("customSwitch3");

    let scriptEnabledQuesort = false;

    // Fungsi untuk mengambil status skrip dari server
    function checkScriptStatus() {
      fetch("https://autosort.veonz.com/script-statusQuesort")
        .then(response => response.text())
        .then(data => {
          
          if (data.includes("enabled")) {
            setSliderEnabled();
          } else {
            setSliderDisabled();
          }
        });
    }

    // Fungsi untuk mengatur slider ke status "Enabled"
    function setSliderEnabled() {
      scriptEnabledQuesort = true;
      toggleButton.checked = true;
    }

    // Fungsi untuk mengatur slider ke status "Disabled"
    function setSliderDisabled() {
      scriptEnabledQuesort = false;
      toggleButton.checked = false;
    }

    // Fungsi untuk mengaktifkan/menonaktifkan skrip di server
    function toggleScript() {
      scriptEnabledQuesort = !scriptEnabledQuesort;

      // Mengubah tampilan tombol
      if (scriptEnabledQuesort) {
        setSliderEnabled();
      } else {
        setSliderDisabled();
      }

      // Kirim permintaan ke server
      fetch("https://autosort.veonz.com/toggle-scriptQuesort")
        .then(response => response.text())
        .then(data => {
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

      Toast.fire({
        icon: 'success',
        title: data
      })
  });

        });
    }

    // Mengambil status skrip saat halaman dimuat
    checkScriptStatus();

    
 //------------------------------------------------------------------------------------------//

    // Fungsi untuk membuka modal
    function openModalQueue() {
        document.getElementById("myModalQueue").style.display = "block";
    }

    // Fungsi untuk menutup modal
    function closeModalQueue() {
        document.getElementById("myModalQueue").style.display = "none";
    }

 //------------------------------------------------------------------------------------------//



  
  