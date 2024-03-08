Ext.define('veonLogin.view.main.Main', {
    extend: 'Ext.panel.Panel',
    xtype: 'app-main',

    requires: [
        'Ext.plugin.Viewport',
        'veonLogin.view.main.MainController',
    ],

    controller: 'main',
    plugins: 'viewport',

   
});