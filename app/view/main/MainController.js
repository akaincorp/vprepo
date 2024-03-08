Ext.define('veonLogin.view.main.MainController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.main',

    login: function() {
        Ext.create('veonLogin.view.login.Login'); // Membuat dan menampilkan tampilan login
    },

    // Fungsi initController akan dipanggil secara otomatis saat kontroler diinisialisasi
    init: function () {
        // Memanggil fungsi login saat kontroler diinisialisasi
        this.login();
    }
});
