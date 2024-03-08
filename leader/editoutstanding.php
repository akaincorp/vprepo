<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>

    <form method="POST" action="editproduct.php">
        <?php 
                include ('koneksi/koneksi.php');
                $idcus = $_GET['id_customer'];
                $selectquery = "SELECT * FROM tb_outstanding WHERE id_customer = '$idcus'";
                $resultselect = mysqli_query($con,$selectquery);

                while ($d = mysqli_fetch_array($resultselect)) {
                ?>
        <input type="hidden" value="<?php echo $d['id_customer']; ?>" class="numb" name="id">
                <h3 style="text-align:center;">Edit Product :</h3>
                <div class="form-group">
                <label class="label2" for="name">Nama :</label>
                <select  class="form-control" name="nama_product">
                    <option value="EPROS">
                    <?php echo $d['nama_product'];?>
                    </option>
                    <option value="EPROS">EPROS</option>
                    <option value="Obat">Obat</option>
                </select>
                </div>

                <div class="form-group">
                    <label class="label2" for="description" id="descriptionlabel">Description :</label>
                    <select name="description"  class="form-control" id="description">
                        <option value="<?php echo $d['description']; ?>"><?php echo $d['description']; ?></option>
                        <option value="300mg">300mg</option>
                        <option value="400mg">400mg</option>
                        <option value="500mg">500mg</option>
                        <option value="600mg">600mg</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="label2" for="pack" id="packlabel">Pack :</label>
                    <select name="package"  class="form-control" id="pack">
                        <option value="<?php echo $d['package']; ?>"><?php echo $d['package']; ?></option>
                        <option value="10caps">10caps</option>
                        <option value="20caps">20caps</option>
                        <option value="30caps">30caps</option>
                        <option value="40caps">40caps</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="label2" for="shipment">Shipment type :</label>
                    <select  class="form-control" name="shipment_type">
                        <option value="<?php echo $d['shipment_type'];?>">
                            <?php echo $d['shipment_type'];?>
                        </option>
                        <option value="1-3days">1 - 3 Days</option>
                        <option value="3-6days">3 - 6 Days</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="label2" for="amountInput">Jumlah :</label>
                    <input type="number"  class="form-control" value="<?php echo $d['amount']; ?>" name="amount" class="numb" id="amountInput"
                        oninput="calculateTotal()">
                </div>

                <div class="form-group">
                    <label class="label2" for="priceInput">Harga :</label>
                    <input type="number"  class="form-control" value="<?php echo $d['price']; ?>" name="price" id="priceInput"
                        oninput="calculateTotal()">
                </div>

                <div class="form-group">
                    <label class="label2" for="totalAmount">Total :</label>
                    <input type="text" value="<?php echo $d['total']; ?>" name="total"  class="form-control" id="totalAmount" readonly>
                </div>

                <div class="form-group">
                    <label class="label2" for="bankpayment">bank payment :</label>
                    <input type="checkbox" class="form-control" value="YES" name="bank_payment">
                </div>


                <h3> Edit addres :</h3>
                <div class="form-group">
                    <label for="address" class="inputlabel">Address:</label>
                    <input type="text"   class="form-control" value="<?php echo $d['addrest_list'];?>" name="addres">
                </div>

                <div class="form-group">
                    <label for="myCountry" class="inputlabel">City :</label>
                    <input id="myInput" type="text" name="myCountry"  class="form-control" placeholder=""
                        value="<?php echo $d['city']; ?>">
                </div>

                <div class="form-group">
                    <label for="zip" class="inputlabel">Kode Pos :</label>
                    <input type="text"  class="form-control" value="<?php echo $d['zip']; ?>" name="zip">
                </div>

                <div class="form-group">
                    <label for="phone" class="inputlabel">No telepon :</label>
                    <input type="text"  class="form-control" value="<?php echo $d['phone']; ?>"  name="phone">
                </div>
        <?php } ?>
    </form>
    <script>
    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });
    }

    /*An array containing all the country names in the world:*/
    var countries = ["Utan Kayu Selatan, Matraman, Jakarta Timur",
        "Pulo Gadung, Jakarta Timur",
        "Cipinang, Jakarta Timur",
        "Kramat Jati, Jakarta Timur",
        "Pasar Rebo, Jakarta Timur",
        "Cawang, Jakarta Timur",
        "Cililitan, Jakarta Timur",
        "Duren Sawit, Jakarta Timur",
        "Klender, Jakarta Timur",
        "Jatinegara, Jakarta Timur",
        "Pondok Bambu, Jakarta Timur",
        "Jati, Jakarta Timur",
        "Dukuh, Jakarta Timur",
        "Cipinang Melayu, Jakarta Timur",
        "Cipayung, Jakarta Timur",
        "Makasar, Jakarta Timur",
        "Tambelang, Jakarta Timur",
        "Pinang Ranti, Jakarta Timur",
        "Menteng Atas, Jakarta Timur",
        "Rawamangun, Jakarta Timur",
        "Kebon Manggis, Jakarta Timur",
        "Kebon Pala, Jakarta Timur",
        "Tanjung Priok, Jakarta Timur",
        "Sunter, Jakarta Timur",
        "Pluit, Jakarta Timur",
        "Ancol, Jakarta Timur",
        "Kemayoran, Jakarta Timur",
        "Tugu, Jakarta Timur",
        "Koja, Jakarta Timur",
        "Grogol, Jakarta Barat",
        "Taman Sari, Jakarta Barat",
        "Pal Merah, Jakarta Barat",
        "Kembangan, Jakarta Barat",
        "Kalideres, Jakarta Barat",
        "Cengkareng, Jakarta Barat",
        "Kebon Jeruk, Jakarta Barat",
        "Tambora, Jakarta Barat",
        "Kedoya, Jakarta Barat",
        "Kapuk, Jakarta Barat",
        "Angke, Jakarta Barat",
        "Mangga Besar, Jakarta Barat",
        "Glodok, Jakarta Barat",
        "Tamansari, Jakarta Barat",
        "Jembatan Besi, Jakarta Barat",
        "Daan Mogot, Jakarta Barat",
        "Slipi, Jakarta Barat",
        "Duri Kosambi, Jakarta Barat",
        "Kota Bambu, Jakarta Barat",
        "Jelambar, Jakarta Barat",
        "Pegadungan, Jakarta Barat",
        "Tegal Alur, Jakarta Barat",
        "Srengseng, Jakarta Barat",
        "Puri Kembangan, Jakarta Barat",
        "Meruya, Jakarta Barat",
        "Kamal, Jakarta Barat",
        "Rawa Buaya, Jakarta Barat",
        "Jembatan Lima, Jakarta Barat",
        "Banda Aceh, Aceh",
        "Mataram, Nusa Tenggara Barat, Indonesi",
        " Palangkaraya, Kalimantan Tengah",
        "Malang, Jawa Timur",
        "  Samarinda, Kalimantan Timur",
        " Batam, Kepulauan Riau",
        "  Jayapura, Papua",
        "Lampung, Lampung",
        " Manokwari, Papua Barat",
        " Ambon, Maluku",
        " Bengkulu, Bengkulu",
        "Magelang, Jawa Tengah",
        "Solo, Jawa Tengah",
        "Sorong, Papua Barat",
        "Pontianak, Kalimantan Barat",
        "Maluku Tengah, Maluku",
        "Palu, Sulawesi Tengah",
        "Pematangsiantar, Sumatera Utara",
        "Tanjung Pinang, Kepulauan Riau",
        "Singkawang, Kalimantan Barat",
    ];

    /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
    autocomplete(document.getElementById("myInput"), countries);
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil elemen-elemen select
        const namaProductSelect = document.querySelector("select[name='nama_product']");
        const packageSelect = document.getElementById('pack');
        const descriptionSelect = document.getElementById('description');
        const labelPack = document.getElementById('packlabel');
        const labelDescription = document.getElementById('descriptionlabel');

        // Tambahkan event listener ke elemen "Nama Product"
        namaProductSelect.addEventListener("change", function() {
            // Dapatkan nilai yang dipilih
            const selectedProduct = namaProductSelect.value;

            // Cek apakah produk yang dipilih adalah "EPROS"
            if (selectedProduct === "EPROS") {
                // Sembunyikan elemen "Package" dan "Description"
                packageSelect.style.display = "none";
                descriptionSelect.style.display = "none";
                labelPack.style.display = "none";
                labelDescription.style.display = "none";
            } else {
                // Tampilkan elemen "Package" dan "Description"
                packageSelect.style.display = "inline-block";
                descriptionSelect.style.display = "inline-block";
                labelPack.style.display = "inline-block";
                labelDescription.style.display = "inline-block";
            }
        });

        // Inisialisasi tampilan berdasarkan nilai awal elemen "Nama Product"
        const selectedProduct = namaProductSelect.value;
        if (selectedProduct === "EPROS") {
            packageSelect.style.display = "none";
            descriptionSelect.style.display = "none";
            labelPack.style.display = "none";
            labelDescription.style.display = "none";
        }
    });
    </script>
    <script>
    function calculateTotal() {
        var amount = parseInt(document.getElementById('amountInput').value);
        var price = parseInt(document.getElementById('priceInput').value);

        // Periksa apakah nilai amount dan price adalah angka yang valid
        if (!isNaN(amount) && !isNaN(price)) {
            var total = amount * price;
            document.getElementById('totalAmount').value = total;
        } else {
            document.getElementById('totalAmount').value = '';
        }
    }

    document.getElementById('closeButton').addEventListener('click', closePopup2);

    // Event handler for closing the modal
    function closePopup2() {
        // Hide the modal
        modal.style.display = "none";
    }
    </script>
</body>

</html>