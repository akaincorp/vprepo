Ext.define('veonLogin.view.login.LoginController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.login',

    onLoginClick: function() {
        var usernameField = this.lookupReference('username');
        var passwordField = this.lookupReference('password');

        var username = usernameField.getValue();
        var password = passwordField.getValue();

        // Mengirimkan permintaan HTTP POST menggunakan Ajax
        Ext.Ajax.request({
            url: 'app/view/login/database.php',
            method: 'POST',
            params: {
                username: username,
                password: password
            },
            success: function(response) {
                var responseData = Ext.decode(response.responseText);
               
                if (responseData.message.indexOf('Agent') !== -1) {
                    Ext.Msg.alert('Success', responseData.message, function(btn) {
                        if (btn === 'ok') {
                            var redirectUrl = 'dashboard.php';
                            window.location.href = redirectUrl;
                        }
                    });
                
                    setTimeout(function() {
                        var redirectUrl = 'dashboard.php';
                        window.location.href = redirectUrl;
                    }, 5000); 

        
                } else  if (responseData.message.indexOf('finance') !== -1) {
                    Ext.Msg.alert('Success', responseData.message, function(btn) {
                        if (btn === 'ok') {
                            var redirectUrl = 'finance/dashboard.php';
                            window.location.href = redirectUrl;
                        }
                    });
                
                    setTimeout(function() {
                        var redirectUrl = 'finance/dashboard.php';
                        window.location.href = redirectUrl;
                    }, 5000); 
                } else  if (responseData.message.indexOf('Leader') !== -1) {
                    Ext.Msg.alert('Success', responseData.message, function(btn) {
                        if (btn === 'ok') {
                            var redirectUrl = 'leader/dashboard.php';
                            window.location.href = redirectUrl;
                        }
                    });
                
                    setTimeout(function() {
                        var redirectUrl = 'leader/dashboard.php';
                        window.location.href = redirectUrl;
                    }, 5000); 

                }  else {
                    Ext.Msg.alert('Error', responseData.message);
                }
            },
            failure: function() {
                Ext.Msg.alert('Error', 'Terjadi kesalahan saat mengirim permintaan ke server.');
            }
        });
    }
});
