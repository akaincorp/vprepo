var country = Ext.create('Ext.data.Store', {
    fields: ['name', 'value'],
    data : [
        {"name":"Indonesia", "value":"Indonesia"},
        {"name":"Singapore", "value":"Singapore"},
    ]
});


Ext.define('veonLogin.view.login.Login', {
	extend: 'Ext.window.Window',
	xtype: 'login',

	requires: ['veonLogin.view.login.LoginController'],

	controller: 'login',
	

	title: 'Veon CRM',
    padding:'3px',
    autoShow: true,
	closable: false,

	items: {
		xtype: 'form',
		reference: 'loginform',
		defaults:{
			padding: '3px',
			margin: '3px',
		},
		items: [
			{
				xtype: 'combobox',
				store: country,
				name: 'country',
				reference: 'country',
				fieldLabel: 'Country :',
				allowBlank: false,
				queryMode: 'local', 
				displayField: 'name', 
				valueField: 'value', 
			},
			{
				xtype: 'textfield',
				name: 'username',
				reference: 'username',
				fieldLabel: 'Username :',
				allowBlank: false
			},
			{
				xtype: 'textfield',
				name: 'password',
				inputType: 'password',
				reference: 'password',
				fieldLabel: 'Password :',
				allowBlank: false
			}
		],
		buttons: [
			{
				text: 'Login',
				formBind: true,
				listeners: {
					click: 'onLoginClick'
				}
			}
		]
	}
});
