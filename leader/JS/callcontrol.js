 socket.emit('callcontrol', 'cdr');
 




  socket.on("update", (data) => {
    var agents = JSON.parse(data);
    sortedAgents = agents;
  
    const currentDate = new Date();
    const currentDay = currentDate.getDate(); // Mengambil hari dari tanggal saat ini
  
    agentsToday = agents.filter(agent => {
      const agentDate = new Date(agent.calldate);
      return agentDate.getDate() === currentDay && agentDate.getMonth() === currentDate.getMonth() && agentDate.getFullYear() === currentDate.getFullYear();
    });

    let nomor = 1;

    const tableData = agentsToday.map(agent => {

    var oriPath = `${agent.recpath}/`;
    var modPath = oriPath.replace('/home/','/');
    var finalLink = `https://api.oncall.id/${modPath}${agent.recfile}`;
    var audio;

    if (finalLink === "https://api.oncall.id/null/null") {
      audio = "No Record";
      }  else {
        audio = `<audio style='width:265px;height:40px;' controls=true src='${finalLink}'></audio>`;
      }

      let number = nomor ++; 
 
  return {
       checkbox: `<input type="checkbox" class="checkboxtabel" name="uniqueid[]" value="${agent.uniqueid}">`,
       no: number, 
       uniqueid: agent.uniqueid,
       calldate: agent.calldate,
       src: agent.src,
       dst: agent.dst,
       disposition: agent.disposition,
       start: agent.start,
       answer: agent.answer,
       end: agent.end,
       duration: agent.duration,
       recording: audio,
       agent: ''
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
         'No',
         'Unique Id',
         'Call Date',
         'Src',
         'Dst',
         'Status Call',
         'Start',
         'Answer',
         'End',
         'Duration',
         'Recording',
         'Agent'
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
             { data: 'no', title: 'No' },
             { data: 'uniqueid', title: 'Unique Id' },
             { data: 'calldate', title: 'Call Date' },
             { data: 'src', title: 'Src' },
             { data: 'dst', title: 'Dst' },
             { data: 'disposition', title: 'Status Call' },
             { data: 'start', title: 'Start' },
             { data: 'answer', title: 'Answer' },
             { data: 'end', title: 'End' },
             { data: 'duration', title: 'Duration' },
             { data: 'recording', title: 'Recording' },
             { data: 'agent', title: 'Agent' }
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
     order: [[3, 'desc']]
     }).buttons().container().appendTo('#topcontent');
 });

 let sortedAgents;

 function sortByDate() {
  const selectedDate = document.getElementById('datePicker').value;

  function removeTimeFromDate(dateString) {
    const dateParts = dateString.split("T");
    return dateParts[0];
  }

  var filterData = sortedAgents.filter((agent) => {
    var normalDate = removeTimeFromDate(agent.calldate);

    return normalDate === selectedDate;
  });

  updateTable(filterData);
}

function updateTable(data) {
  const existingTable = document.getElementById('example1');
  if (existingTable) {
      $(existingTable).DataTable().destroy(); // Menghancurkan instance DataTable yang ada
      existingTable.parentNode.removeChild(existingTable); // Menghapus tabel yang ada
  }

  let nomor = 1;

  const tableData = data.map(agent => {

  var oriPath = `${agent.recpath}/`;
  var modPath = oriPath.replace('/home/','/');
  var finalLink = `https://api.oncall.id/${modPath}${agent.recfile}`;
  var audio;

  if (finalLink === "https://api.oncall.id/null/null") {
    audio = "No Record";
    }  else {
      audio = `<audio style='width:265px;height:40px;' controls=true src='${finalLink}'></audio>`;
    }

    let number = nomor ++; 

return {
     checkbox: `<input type="checkbox" class="checkboxtabel" name="uniqueid[]" value="${agent.uniqueid}">`,
     no: number, 
     uniqueid: agent.uniqueid,
     calldate: agent.calldate,
     src: agent.src,
     dst: agent.dst,
     disposition: agent.disposition,
     start: agent.start,
     answer: agent.answer,
     end: agent.end,
     duration: agent.duration,
     recording: audio,
     agent: ''
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


   // Membuat tabel baru dan menginisialisasi DataTables
   const tables = document.createElement('table');
   tables.id = 'example1';
   tables.className = 'table table-bordered table-striped text-xs';
   tables.style = 'width:100%';

   const thead = tables.createTHead();
   const headerRow = thead.insertRow();

   headerRow.appendChild(checkboxHeader); // Kolom untuk checkbox "Select All"

   const columnTitles = [
       'No',
       'Unique Id',
       'Call Date',
       'Src',
       'Dst',
       'Status Call',
       'Start',
       'Answer',
       'End',
       'Duration',
       'Recording',
       'Agent'
   ];

   columnTitles.forEach(title => {
       const th = document.createElement('th');
       th.textContent = title;
       headerRow.appendChild(th);
   });

   const cardBody = document.getElementById('cardBody'); 
   cardBody.appendChild(tables);

   $('#example1').DataTable({
       data: tableData,
       columns: [
           { data: 'checkbox' },
           { data: 'no', title: 'No' },
           { data: 'uniqueid', title: 'Unique Id' },
           { data: 'calldate', title: 'Call Date' },
           { data: 'src', title: 'Src' },
           { data: 'dst', title: 'Dst' },
           { data: 'disposition', title: 'Status Call' },
           { data: 'start', title: 'Start' },
           { data: 'answer', title: 'Answer' },
           { data: 'end', title: 'End' },
           { data: 'duration', title: 'Duration' },
           { data: 'recording', title: 'Recording' },
           { data: 'agent', title: 'Agent' }
       ],
       buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
    ],
    lengthMenu: [
        [10, 25, 50, 100],
        [10, 25, 50, 100]
    ],
    pageLength: 10
    }).buttons().container().appendTo('#topcontent');
  }







  
        
        
        
        
        