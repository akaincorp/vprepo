// ----------------------------------------------------------------------------------------------------------------------------//
// ----------------------------------------------------------------------------------------------------------------------------//

socket.on("connect_error", (error) => {
    const loadingDiv = document.getElementById("loading");
    if (loadingDiv) {
      loadingDiv.style.display = "block"; // Tampilkan pesan Loading
    }
  });
  
  socket.on("connect", () => {
    const loadingDiv = document.getElementById("loading");
    if (loadingDiv) {
      loadingDiv.style.display = "none"; // Sembunyikan pesan Loading saat koneksi berhasil
    }
  });


  var dashForm = document.getElementById('withdata');
  var productForm = document.getElementById('withdataproduct');
  var handlingForm = document.getElementById('withdatahandling');
  var overviewForm = document.getElementById('withdataoverview');
  var callControl = document.getElementById('divCallControl');
  var scriptCont = document.getElementById('scriptContainer');
  var btnStat = document.getElementById('btnStatus');
  var btnDash = document.getElementById('btnDashboardactive');
  var btnProd = document.getElementById('btnProduct');
  var btnOver = document.getElementById('btnOverview');
  var btnHand = document.getElementById('btnHandling');
  var btnSubmit = document.getElementById('submitForm');

  var idAgent = document.getElementById('idAgent');
  var idAgents = idAgent.value;
  
    function displayProduct() {
      dashForm.style.display = 'none';
      callControl.style.display = 'none';
      handlingForm.style.display = 'none';
      overviewForm.style.display = 'none';
      btnSubmit.style.display = 'none';
      btnDash.setAttribute('id','btnDashboard');
      btnProd.setAttribute('id','btnProductactive');
      btnHand.setAttribute('id','btnHandling');
      btnOver.setAttribute('id', 'btnOverview');
      scriptCont.style.display = 'block';
      productForm.style.display = 'block';
      btnStat.style.right = '50px';
      btnStat.style.display = 'flex';
    };
  
    function displayDashboard() {
      productForm.style.display = 'none';
      handlingForm.style.display = 'none';
      scriptCont.style.display = 'block';
      dashForm.style.display = 'block';
      btnSubmit.style.display = 'block';
      callControl.style.display = 'block';
      btnDash.setAttribute('id','btnDashboardactive');
      btnProd.setAttribute('id','btnProduct');
      btnHand.setAttribute('id','btnHandling');
      btnOver.setAttribute('id', 'btnOverview');
      btnStat.style.right = '50px';
      overviewForm.style.display = 'none';
      btnStat.style.display = 'flex';
    };

    function displayHandling() {
        dashForm.style.display = 'none';
        callControl.style.display = 'none';
        productForm.style.display = 'none';
        btnDash.setAttribute('id','btnDashboard');
        btnProd.setAttribute('id','btnProduct');
        btnHand.setAttribute('id','btnHandlingactive');
        btnOver.setAttribute('id', 'btnOverview');
        scriptCont.style.display = 'none';
        btnStat.style.display = 'none';
        overviewForm.style.display = 'none';
        handlingForm.style.display = 'block';
    };

    function displayOverview() {
        dashForm.style.display = 'none';
        callControl.style.display = 'none';
        btnDash.setAttribute('id','btnDashboard');
        btnProd.setAttribute('id','btnProduct');
        btnHand.setAttribute('id','btnHandling');
        btnOver.setAttribute('id', 'btnOverviewactive');
        productForm.style.display = 'none';
        scriptCont.style.display = 'none';
        btnStat.style.display = 'none';
        handlingForm.style.display = 'none';
        overviewForm.style.display = 'block';
    };
  
  socket.emit('subscribejoinklausa', 'tb_customer', 'tb_agent', 'tb_callback', 'tb_notconnect', 'tb_disclaimer', 'tb_spam', 'tb_customer.id_agent', 'tb_agent.id_agent', 'tb_customer.id_status', 'tb_callback.id_status','tb_customer.id_statusc', 'tb_notconnect.id_statusc', 'tb_customer.id_statusb', 'tb_disclaimer.id_statusb', 'tb_customer.id_statusd', 'tb_spam.id_statusd', idAgents );
  
  socket.on("update", (data) => {
      const agents = JSON.parse(data);
      console.log(agents);
      displayAgentList(agents);
  });
  
  
  function displayAgentList(agents) {
    const withData = document.getElementById('withdata');
    const withDataProduct = document.getElementById('withdataproduct');
    const withDataOver = document.getElementById('withdataoverview');
    const withdatahandling = document.getElementById('withdatahandling');
    const withDataScript = document.getElementById('scriptContainer');
    const withDataStatus = document.getElementById('btnStatus');
    const withDataMenu = document.getElementById('btnMenu');
    const callControl = document.getElementById('divCallControl');
    const noData = document.getElementById('nodata');

    if (agents.length === 0) {
        withData.style.display = 'none';
        withDataProduct.style.display = 'none';
        withDataOver.style.display = 'none';
        withdatahandling.style.display = 'none';
        callControl.style.display = 'none';
        withDataScript.style.display = 'none';
        withDataStatus.style.display = 'none';
        withDataMenu.style.display = 'none';
        noData.style.display = 'block';
        sessionStorage.removeItem("audioPlayed");
        sessionStorage.removeItem("hasRefreshed");

        var xhr = new XMLHttpRequest();
    xhr.open('GET', 'updatestat.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('updateStatContent').innerHTML = xhr.responseText;
        }
    };
    xhr.send();

    } else {
        var audioPlayed = sessionStorage.getItem("audioPlayed");
        var hasRefreshed = sessionStorage.getItem("hasRefreshed");
        if (!hasRefreshed) {
            sessionStorage.setItem("hasRefreshed", "true");
            location.reload();
        } else if (!audioPlayed) {
            sessionStorage.setItem("audioPlayed", "true");
            var audio = new Audio("MP3/eventually-590.mp3");
            audio.play();
        }
        noData.style.display = 'none';
    };

    var orderTime = document.getElementById('ordertime');
    var idCustomer = document.getElementById('idcustomer');
    var idCustomerStatus = document.getElementById('idcustomerstatus');
    var firstName = document.getElementById("firstname");
    var lastName = document.getElementById('lastname'); 
    var phone = document.getElementById('phone'); 
    var nomorTeleponInput = document.getElementById("nomorTelepon");
    var country = document.getElementById('country'); 
    var timeZone = document.getElementById('timezone'); 
    var address = document.getElementById('address'); 
    var state = document.getElementById('state'); 
    var city = document.getElementById('city'); 
    var zip = document.getElementById('zip'); 
    var email = document.getElementById('email');
    var age = document.getElementById('age');
    var height = document.getElementById('height');
    var chronicDisease = document.getElementById('chronic');
    var phoneToCall = document.getElementById('txtPhoneNumber');
  
    agents.forEach((agent) => {
      orderTime.innerHTML = `Order time : <br> ${agent.order_date}`;
      idCustomer.value = agent.id_customer;
      idCustomerStatus.value = agent.id_customer;
      firstName.value = agent.first_name;
      lastName.value = agent.last_name;
      phone.value = agent.phone;
      nomorTeleponInput.value = "*".repeat(agent.phone.length);
      country.value = agent.country || 'Indonesia';
      timeZone.innerText = agent.timezone || 'Asia/Jakarta';
      address.value = agent.addrest_list; 
      state.innerText = agent.state;
      city.innerText = agent.city;
      zip.value = agent.zip;
      email.value = agent.email;
      age.value = agent.age;
      height.value = agent.height;
      chronicDisease.value = agent.Chronic_disease;
      phoneToCall.value = agent.phone;
    });

    const table = document.querySelector(".tb1product"); // Ambil elemen tabel HTML
    const tbody = table.querySelector("tbody"); // Ambil elemen <tbody> dari tabel
  
    // Kosongkan <tbody> sebelum menambahkan data baru
    tbody.innerHTML = "";
  
    agents.forEach((agent) => {
        const note = document.getElementById('idcusnote');
        note.value = `${agent.id_customer}`;
        
        const totals = document.getElementById('totals');
        totals.innerHTML = `Total : ${agent.total}`;

      const row = tbody.insertRow();

      // Tampilkan elemen checkbox dalam sel aksi
      const orderIdCell = row.insertCell(0);
      orderIdCell.innerHTML = `${agent.order_id}`;
        
        // Tampilkan semua data dalam baris yang sesuai
        const productCell = row.insertCell(1);
        productCell.innerHTML = `${agent.nama_product}`;
        
        const descriptionCell = row.insertCell(2);
        descriptionCell.innerHTML = `${agent.description}`;
        
        const packCell = row.insertCell(3);
        packCell.innerHTML = `${agent.package}`;
        
        const shipmentCell = row.insertCell(4);
        shipmentCell.innerHTML = `${agent.shipment_type}`;
       
        const amountCell = row.insertCell(5);
        amountCell.innerHTML = `${agent.amount}`;
        
        const priceCell = row.insertCell(6);
        priceCell.innerHTML = `${agent.price}`;
  
        
    });

  
  }

// ----------------------------------------------------------------------------------------------------------------------------//</script>

function submitForm() {
    document.getElementById("sortForm").submit();
}

// ----------------------------------------------------------------------------------------------------------------------------//

    document.getElementById("option1").innerHTML = "Spam";
    document.getElementById("option2").innerHTML = "Disclaimer";
    document.getElementById("option3").innerHTML = "Callback";
    document.getElementById("option4").innerHTML = "Not Connect";

// ----------------------------------------------------------------------------------------------------------------------------//

document.addEventListener("DOMContentLoaded", function() {
    // Ambil elemen-elemen select
    const statusSelect1 = document.getElementById("statusSelect1");
    const statusSelect2 = document.getElementById("statusSelect2");
    const statusSelect3 = document.getElementById("statusSelect3");
    const statusSelect4 = document.getElementById("statusSelect4");
    const popup = document.getElementById("popupstatus");
    const closePopup = document.getElementById("closePopupstatus");
    const popupMessage = document.getElementById("popupMessage");
    const setStatus = document.getElementById("setStatus");


    const popup1 = document.getElementById("popupstatus1");
    const closePopup1 = document.getElementById("closePopupstatus1");
    const popupMessage1 = document.getElementById("popupMessage1");
    const setStatus1 = document.getElementById("setStatus1");


    const popup2 = document.getElementById("popupstatus2");
    const closePopup2 = document.getElementById("closePopupstatus2");
    const popupMessage2 = document.getElementById("popupMessage2");
    const setStatus2 = document.getElementById("setStatus2");


    const popup3 = document.getElementById("popupstatus3");
    const closePopup3 = document.getElementById("closePopupstatus3");
    const popupMessage3 = document.getElementById("popupMessage3");
    const setStatus3 = document.getElementById("setStatus3");


    // Tambahkan event listener untuk masing-masing elemen select
    statusSelect1.addEventListener("change", function() {
        const selectedOption = statusSelect1.options[statusSelect1.selectedIndex]
            .value;
        if (selectedOption !== "") {
            popupMessage.textContent = `Status: ${selectedOption}`;
            setStatus.value = `${selectedOption}`;
            popup.style.display = "block";
        }
    });

    statusSelect2.addEventListener("change", function() {
        const selectedOption = statusSelect2.options[statusSelect2.selectedIndex]
            .value;
        if (selectedOption !== "") {
            popupMessage1.textContent = `Status: ${selectedOption}`;
            setStatus1.value = `${selectedOption}`;
            popup1.style.display = "block";
        }
    });

    statusSelect3.addEventListener("change", function() {
        const selectedOption = statusSelect3.options[statusSelect3.selectedIndex]
            .value;
        if (selectedOption !== "") {
            popupMessage2.textContent = `Status: ${selectedOption}`;
            setStatus2.value = `${selectedOption}`;
            popup2.style.display = "block";
        }
    });

    statusSelect4.addEventListener("change", function() {
        const selectedOption = statusSelect4.options[statusSelect4.selectedIndex]
            .value;
        if (selectedOption !== "") {
            popupMessage3.textContent = `Status: ${selectedOption}`;
            setStatus3.value = `${selectedOption}`;
            popup3.style.display = "block";
        }
    });
    closePopup.addEventListener("click", function() {
        popup.style.display = "none";
    });

    closePopup1.addEventListener("click", function() {
        popup1.style.display = "none";
    });

    closePopup2.addEventListener("click", function() {
        popup2.style.display = "none";
    });

    closePopup3.addEventListener("click", function() {
        popup3.style.display = "none";
    });
});

// ----------------------------------------------------------------------------------------------------------------------------//

let inputDate = document.getElementById("date");
let inputDate1 = document.getElementById("date1");
let inputDate2 = document.getElementById("date2");
let inputDate3 = document.getElementById("date3");
let waktu = new Date();
let year = waktu.getFullYear();
let month = String(waktu.getMonth() + 1).padStart(2, '0');
let day = String(waktu.getDate()).padStart(2, '0');
let hours = String(waktu.getHours()).padStart(2, '0');
let minutes = String(waktu.getMinutes()).padStart(2, '0');
let seconds = String(waktu.getSeconds()).padStart(2, '0');

inputDate.value = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
inputDate1.value = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
inputDate2.value = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
inputDate3.value = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

// ----------------------------------------------------------------------------------------------------------------------------//

    var cityOptions = {
        "Aceh": ["Banda Aceh", "Langsa", "Lhokseumawe", "Sabang", "Subulussalam", " Aceh Barat",
            " Aceh Barat Daya", " Aceh Barat", " Aceh Besar", " Aceh Jaya",
            " Aceh Selatan", " Aceh Singkil", " Aceh Tamiang",
            " Aceh Tengah", " Aceh Tenggara", " Aceh Timur", " Aceh Utara",
            " Bener Meriah", " Bireun", " Gayo Lues", " Nagan Raya",
            " Pidie", " Pidie Jaya", " Simeulue"
        ],

        "Bali": ["Denpasar", "Kuta", "Ubud", " Badung", " Bangli", " Buleleng",
            " Gianyar", " Jembrana", " Karangasem", " Klungkung",
            " Tabanan"
        ],

        "Bangka Belitung": ["Pangkal Pinang", " Bangka", " Bangka barat",
            " Bangka Tengah", " Bangka Selatan",
            " Belitung", " Belitung Timur"
        ],

        "Banten": ["Cilegon", "Serang", "Tangerang Selatan", "Tangerang", " Pandeglang",
            " Tangerang"
        ],

        "Bengkulu": ["Bengkulu"],
        "Daerah Istimewa Yogyakarta": ["Yogyakarta"],
        "Gorontalo": ["Gorontalo"],
        "Jakarta": ["Jakarta Barat", "Jakarta Selatan", "Jakarta Timur","Jakarta Pusat","Jakarta Utara"],
        "Jawa Barat": ["	Banjar", "Tasikmalaya", "Sukabumi", "Depok", "Cirebon", "cimahi", "Bogor", "Bekasi",
            "Bandung"
        ],
        "Jawa Tengah": ["	Salatiga", "Semarang", "Surakarta", "Tegal"],
        
        "Jawa Timur": ["	Batu", "Blitar", "Kediri", "Madiun", "Malang","Madura", "Mojokerto", "Pasuruan", "Probolinggo",
            "Surabaya"
        ],
        "Jambi": ["Batanghari", "Bungo", "Kerinci", "Merangin", "Muaro Jambi", "Sarolangun", "Tanjung Jabung Barat", "Tanjung Jabung Timur",
            "Tebo","Jambi","Sungai Penuh"],
        
        "Sumatera Barat": ["Agam", "Dhamasraya", "Kepulauan Mentawai", "Lima Puluh Kota", "Padang Pariaman", "Pasaman", "Pasaman Barat", "Pesisir Selatan",
            "Sijunjung","Solok","Solok Selatan","Tanah Datar","Bukit Tinggi","Padang","Padang Panjang","Pariaman","Payakumbuh","Sawahlunto","Solok"],

        "Sumatera Selatan": ["Banyuasin", "Empat Lawang", "Lahat", "Muara Enim", "Musi Banyuasin", "Musi Rawas", "Musi Rawas Utara", "Ogan Ilir",
            "Ogan Komering Ilir","Ogan Komering Ulu","Ogan Komering Ulu Selatan","Ogan Komering Ulu Timur","Penukal Abab Lematang Ilir","Lubuk Linggau","Pagaralam","Palembang","Prabumulih"],
       
        "Sumatera Utara": ["Asahan", "Batu Bara", "Dairi", "Deli Serdang", "Humbang Hasundutan", "Karo", "Labuhanbatu", "Labuhanbatu Selatan",
            "Labuhanbatu Utara","Langkat","Mandailing Natal","Nias","NIas Barat","Nias Selatan","Nias Utara","Padang Lawas","Padang Lawas Utara","Pakpak Bharat","Samosir","Serdang Begadai","Simalungun","Tapanuli Selatan","Tapanuli Temgah","Tapanuli Utara","Toba","Binjai","Gunungsitioli","Medan","Padangsidimpuan","Pematangsiantar","Sibolga","Tanjungbalai","Tebing Tinggi"],

        "Lampung": [" Lampung Selatan", "	 Lampung Tengah", " Lampung Timur", " Lampung Utara", "	 Mesuji", "	 Pesawaran", " Pesisir Barat", " Pringsewu", "	 Tanggamus", " Tulang Bawang", " Tulang Bawang Barat", " Way Kanan", "Bandar Lampung", "Metro"],
        "Nusa Tenggara Barat": ["Bima", "Dompu", "Lombok Barat", "Lombok Tengah", "Lombok Timur", "Lombok Utara", "Sumbawa", "Sumbawa Barat", "Bima", "Mataram"],
        "Nusa Tenggara Timur": ["Alor", "Belu", "Ende", "Flores Timur", "Kupang", "Lembata", "Malaka", "Manggarai", "Manggarai Barat", "Manggarai Timur", "Nageko", "Ngada", "Ndao", "Sabu Raijua","Sikka","Sumba Barat","Sumba Bara Daya","Sumba Tengah","Sumba Timur","Timor Tengah Selatan","Timor Tengah Utara","Kupang"],
        "Sulawesi Barat": [" Majene", " Mamasa", " Mamuju", " Mamuju Tengah", " Pasangkayu", "	 Polewali Mandar"],
        "Sulawesi Tengah": [" Banggai", "	 Banggai Kepulauan", "	 Banggai Laut", "	 Buol", "	 Donggala", "	 Morowali", "	 Morowali Utara", "	 Parigi Moutong", " Poso", "	 Sigi", "	 Tojo Una-Una", "	 Tolitoli"
         , "Palu"],
        "Sulawesi Utara": [" Bolaang Mongondow", " Bolaang Mongondow Selatan", "	 Bolaang Mongondow Timur", "	 Bolaang Mongondow Utara", " Kepulauan Sangihe", " Kepulauan Siau Tagulandang Biaro", "	 Kepulauan Talaud", "	 Kepulauan Talaud", " Minahasa Selatan", "	 Minahasa Tenggara", " Minahasa Utara", "Bitung", "Kotamobagu", "Manado", "Tomohon"],
        "Sulawesi Tenggara": [" Bombana", " Buton", "	 Buton Selatan", " Buton Tengah", " Buton Utara", " Kolaka", " Kolaka Timur", " Kolaka Utara", "	 Konawe", "	 Konawe Kepulauan", " Konawe Selatan", "	 Konawe Utara", "	 Muna", " Muna Barat", "	 Wakatobi", "Baubau", "Kendari"],
        "Sulawesi Selatan": ["	 Bantaeng", "	 Barru", " Bone", "	 Bulukumba", "	 Enrekang", " Gowa", "	 Jeneponto", " Kepulauan Selayar", "	 Luwu", "	 Luwu Timur", "	 Luwu Utara", " Maros", " Pangkajene dan Kepulauan", " Pinrang", "	 Sidenreng Rappang", "	 Sinjai", "	 Soppeng", " Takalar", "	 Tana Toraja", "	 Toraja Utara", " Wajo", "Makassar", "Palopo", "Parepare"],
        "Kalimantan Barat": [
            " Mempawah",
            " Kubu Raya",
            " Landak",
            " Sanggau",
            " Ketapang",
            " Sintang",
            " Kapuas Hulu",
            " Sekadau",
            " Melawi",
            " Sambas",
            " Bengkayang",
            " Landak",
            " Sanggau",
            "Pontianak",
            "Singkawang"
        ],
        "Kalimantan Timur":  [
            "Balikpapan",
            "Bontang",
            "Samarinda",
            " Berau",
            " Kutai Barat",
            " Kutai Kartanegara",
            " Kutai Timur",
            " Mahakam Ulu",
            " Paser",
            " Penajam Paser Utara",
            " Tana Tidung"
        ],
        "Kalimantan Selatan": [
            " Balangan",
            " Banjar",
            " Barito Kuala",
            " Hulu Sungai Selatan",
            " Hulu Sungai Tengah",
            " Hulu Sungai Utara",
            " Kotabaru",
            " Tabalong",
            " Tanah Bumbu",
            " Tanah Laut",
            " Tapin",
            "Banjarmasin",
            "Banjar Baru",
        ],
        "Kalimantan Tengah": [
            " Barito Selatan",
            " Barito Timur",
            " Barito Utara",
            " Gunung Mas",
            " Kapuas",
            " Katingan",
            " Kotawaringin Barat",
            " Kotawaringin Timur",
            " Lamandau",
            " Murung Raya",
            " Pulang Pisau",
            " Seruyan",
            " Sukamara",
            " Seruyan",
            " Sukamara",
            " Lamandau",
            "Palangka Raya",
        ],
        "Kalimantan Utara": [
            " Bulungan",
            " Malinau",
            " Nunukan",
            " Tana Tidung",
            "Tarakan",
        ],

        "Kepulauan Riau": [
            "Bintan",
            "Karimun",
            "Kepulauan Anambas",
            "Lingga",
            "Natuna",
            "Batam",
            "Tanjungpinang",
        ],
        "Riau": [
            "Bengkalis",
            "Indragiri Hilir",
            "Indragiri Hulu",
            "Kampar",
            "Kepulauan Meranti",
            "Kuantan Singingi",
            "Pelalawan",
            "Rokan Hilir",
            "Rokan Hulu",
            "Siak",
            "Dumai",
            "Pekanbaru",
        ],



        // Tambahkan kota-kota lain sesuai dengan state yang sesuai
    };

    var stateSelect = document.getElementById("stateSelect");
    var citySelect = document.getElementById("citySelect");

    // Tambahkan event listener pada select "State"
    stateSelect.addEventListener("change", function() {
        var selectedState = stateSelect.value;
        // Kosongkan select "City"
        citySelect.innerHTML = "";

        if (selectedState !== "") {
            // Tambahkan pilihan kota berdasarkan state yang dipilih
            var cities = cityOptions[selectedState];
            cities.forEach(function(city) {
                var option = document.createElement("option");
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        }
    });

    // ----------------------------------------------------------------------------------------------------------------------------//

    function makeElementScrollable(element) {
        let startY;
        let startX;
        let scrollLeft;
        let scrollTop;
        let isDown;

        element.addEventListener('mousedown', e => mouseIsDown(e));
        element.addEventListener('mouseup', e => mouseUp(e));
        element.addEventListener('mouseleave', e => mouseLeave(e));
        element.addEventListener('mousemove', e => mouseMove(e));

        function mouseIsDown(e) {
            isDown = true;
            startY = e.pageY - element.offsetTop;
            startX = e.pageX - element.offsetLeft;
            scrollLeft = element.scrollLeft;
            scrollTop = element.scrollTop;
        }

        function mouseUp(e) {
            isDown = false;
        }

        function mouseLeave(e) {
            isDown = false;
        }

        function mouseMove(e) {
            if (isDown) {
                e.preventDefault();
                // Move vertically
                const y = e.pageY - element.offsetTop;
                const walkY = y - startY;
                element.scrollTop = scrollTop - walkY;

                // Move horizontally
                const x = e.pageX - element.offsetLeft;
                const walkX = x - startX;
                element.scrollLeft = scrollLeft - walkX;
            }
        }
    }

    makeElementScrollable(document.getElementById('eprosscript'));
    makeElementScrollable(document.getElementById('obatscript'));


// ----------------------------------------------------------------------------------------------------------------------------//

    const scriptButton = document.getElementById('buttonscript');
    const scriptDropdown = document.getElementById('dropscript');
    const scriptEpros = document.getElementById('eprosscript');
    const scriptObat = document.getElementById('obatscript');

    let isDropdownVisible = false;

    scriptButton.addEventListener("click", function() {
        if (isDropdownVisible) {
            // Jika dropdown terlihat, sembunyikan dropdown
            scriptDropdown.style.display = 'none';
            scriptButton.style.width = '229px';
        } else {
            // Jika dropdown tidak terlihat, tampilkan dropdown
            scriptDropdown.style.display = 'flex';
            scriptObat.style.display = "none";
        scriptEpros.style.display = "none";
        }
        isDropdownVisible = !isDropdownVisible; // Toggle status tampilan dropdown
        setButtonWidth();
    });

    function setButtonWidth() {
    if (scriptEpros.style.display === 'block') {
        scriptButton.style.width = scriptEpros.offsetWidth + "px";
    }  else if (scriptObat.style.display === 'block') {
        scriptButton.style.width = scriptObat.offsetWidth + "px";
    }
}

    function eprosScript() {
        scriptDropdown.style.display = "none";
        scriptObat.style.display = "none";
        scriptEpros.style.display = "block";
        isDropdownVisible = false;
        setButtonWidth();
    }

    function obatScript() {
        // Sembunyikan dropdown dan tampilkan elemen lain
        scriptDropdown.style.display = "none";
        scriptEpros.style.display = "none";
        scriptObat.style.display = "block";
        isDropdownVisible = false; // Setel status tampilan dropdown ke false
        setButtonWidth();
    }

    let resizeObserver = new ResizeObserver(setButtonWidth);
    resizeObserver.observe(scriptEpros);
   
    let resizeObservers = new ResizeObserver(setButtonWidth);
    resizeObservers.observe(scriptObat);

// ----------------------------------------------------------------------------------------------------------------------------//


   


// ----------------------------------------------------------------------------------------------------------------------------//

