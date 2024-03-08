Ext.define('veonLogin.Application', {
    extend: 'Ext.app.Application',
    name: 'veonLogin',

    views: [
        'veonLogin.view.main.Main',
        'veonLogin.view.login.Login'
    ]
});