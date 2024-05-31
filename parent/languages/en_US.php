<?php

$messages = [
	'display' => [
		'all'
	],
	'location' => [
		'flag' => 'us',
		'name' => 'English',
	],
	'dropdown' => [
		'toggle' => 'Toggle Theme',
		'profile' => 'My Profile',
		'logout' => 'Logout',
	],
	'theme' => [
		'light' => 'Light',
		'dark' => 'Dark',
		'mode' => [
			'dark' => 'Dark Mode',
			'light' => 'Light Mode',
		],
	],
	'404' => [
		'title' => 'Oops… You just found an error page',
		'subtitle' => 'We are sorry but the page you are looking for was not found.',
		'button' => 'Back to page',
	],
	'erase' => [
		'secure' => [
			'type' => 'question',
			'title' => 'You\'re sure?',
			'subtitle' => 'There will be no way to recover.',
			'button' => 'Erase',
		],
	],
	'clone' => [
		'secure' => [
			'type' => 'question',
			'title' => 'Sure to do this?',
			'subtitle' => 'You just create and paste the configuration of this.',
			'button' => 'Ok',
		],
	],
	'edit' => [
		'complete' => [
			'type' => 'success',
			'title' => 'All changes saved!',
			'subtitle' => '',
		],
	],
	'auth' => [
		'header' => [
			'name' => 'Authetication',
			'icon' => 'login',
		], 
		'content' => [
			'community' => [
				'name' => 'Community',
				'link' => 'https://discord.gg/FWMK2XQhpa',
			],
			'new' => [
				'logo' => 'https://devlicense.devbybit.com/parent/img/devbybit-logos.png',
				'title' => 'Welcome to {site:name}! 👋',
				'button' => 'Login with Discord',
			],
			'old' => [
				'remember' => 'Keep me logged in on this device.',
				'placeholder' => 'Your password',
				'close' => 'Sign out of this account.',
			],
		],
	],
	'product' => [
		'header' => [
			'name' => 'Products',
			'icon' => 'box-seam',
		], 
		'alert' => [
			'erase' => [
				'type' => 'success',
				'title' => 'Product deleted successfully!',
				'subtitle' => 'The product has been deleted, Successfully. There is no way to recover.',
			],
		],
		'content' => [
			'title' => 'Overview',
			'subtitle' => 'Product',
			'table' => [
				'icon' => 'Icon',
				'name' => 'Name',
				'description' => 'Description',
				'price' => 'Price',
				'version' => 'Version',
				'since' => 'Since',
				'actions' => 'Actions',
				'no_results' => '<h5>No results found.</h5>',
				'buttons' => [
					'add_to_cart' => [
						'text' => '<i class="fa fa-cart-plus"></i>',
						'tooltip' => 'Add to Cart',
					],
					'overview' => [
						'text' => '<i class="fa fa-chart-simple"></i>',
						'tooltip' => 'Overview',
					],
					'settings' => [
						'icon' => '<i class="fa fa-gear"></i>',
						'clone' => '<i class="fa-regular fa-clone"></i> Clone',
						'edit' => '<i class="fa-regular fa-pen-to-square"></i> Edit',
						'erase' => '<i class="fa fa-eraser"></i> Erase',
						'update' => '<i class="fa fa-file-arrow-down"></i> Update',
					],
				],
			],
			'overview' => [
				'title' => '{product:name}',
				'subtitle' => 'Product',
				'card' => [
					'keys' => [
						'icon' => '<i class="fa fa-key"></i>',
						'text' => '<b>Keys</b>',
					],
					'profits' => [
						'icon' => '<i class="fa fa-coins"></i>',
						'text' => '<b>Profits</b>',
						'tooltip' => 'This is calculated by the existing keys and the price of the product.',
					],
					'actions' => [
						'icon' => '<i class="fa fa-coins"></i>',
						'files' => [
							'icon' => '<i class="fa fa-file"></i>',
							'title' => 'Download Files',
							'subtitle' => '{product:count:files}',
						],
						'keys' => [
							'icon' => '<i class="fa fa-key"></i>',
							'title' => 'License Keys',
							'subtitle' => '{product:count:keys}',
						],
						'group' => [
							'icon' => '<i class="fa fa-layer-group"></i>',
							'title' => 'Give Groups',
							'subtitle' => '{product:count:group}',
						],
					],
				],
			],
			'updates' => [
				'title' => 'Updates',
				'form' => [
					'title' => 'Update product',
					'new_version' => [
						'label' => 'New version number:',
						'placeholder' => '1.1',
					],
					'new_content' => 'New content:',
					'new_title' => 'Update title:',
					'new_message' => 'Update message:',
				],
				'card' => [
					'version' => 'Version',
					'initial_released' => 'Initial Released',
					'buttons' => [
						'edit' => '<i class="fa fa-file-pen"></i> Edit',
						'erase' => '<i class="fa fa-eraser"></i> Erase',
					],
				],
			],
			'create' => [
				'edit_title' => 'Edit',
				'title' => 'Create',
				'subtitle' => 'Product',
				'buttons' => [
					'ref' => 'Create <i class="fa fa-plus"></i>',
					'back' => '<i class="fa fa-chevron-left"></i> Back',
					'create' => 'Create <i class="fa fa-plus"></i>',
					'save' => 'Save <i class="fa fa-check"></i>',
					'cancel' => '<i class="fa fa-ban"></i> <b>Cancel</b>',
					'update' => '<i class="fa fa-file-arrow-up"></i> <b>Update</b>',
				],
				'form' => [
					'id_name' => [
						'label' => 'ID Name',
						'placeholder' => 'This is required for verificate on the request.',
						'tooltip' => 'This will be used in case you want or need this product for your key. You have to put the name of your software which will send the code name.',
					],
					'name' => [
						'label' => 'Name',
						'placeholder' => 'Name for the product',
						'tooltip' => 'This name will be used for the Blackout Software view. It is almost optional but necessary to define it.',
					],
					'price' => [
						'label' => 'Price',
						'placeholder' => '5.50',
					],
					'version' => [
						'label' => 'Version',
						'placeholder' => '1.0',
					],
					'tebex_product' => [
						'label' => 'Tebex Product ID',
						'placeholder' => '6119444',
						'tooltip' => 'It is necessary to enter only the product ID, in case you place the sale.',
					],
					'description' => [
						'label' => 'Description',
						'placeholder' => 'Product description',
						'tooltip' => 'The description is optional. This can be used to give a biography type to the product.',
					],
					'icon' => [
						'label' => 'Icon',
						'placeholder' => 'Place URL of image.',
						'tooltip' => 'You can leave it blank to use an icon with the product name text.',
					],
					'actions' => [
						'label' => 'Actions',
						'tooltip' => 'These actions only apply if the user purchased on the site.',
						'file_download' => [
							'button' => 'File Download',
							'title' => 'Upload your Files',
							'new_file' => 'Upload new file',
							'header' => 'Files',
						],
						'license_key' => [
							'button' => 'License Key',
							'title' => 'Configure the Licenses',
							'new_keys' => 'New keys',
						],
						'group' => [
							'button' => 'Group',
							'title' => 'Select groups for Give',
						],
					],
				],
			],
			'alert' => [
				'create_product' => [
					'type' => 'success',
					'title' => 'Complete execution!',
					'subtitle' => 'Your product has been created successfully! You will be redirected.',
				],
				'edited_product' => [
					'type' => 'success',
					'title' => 'Complete execution!',
					'subtitle' => 'Your product has been edited successfully! You will be redirected.',
				],
				'cloned_product' => [
					'type' => 'success',
					'title' => 'Complete execution!',
					'subtitle' => 'Your product has been cloned successfully! You will be redirected.',
				],
				'updated_product' => [
					'type' => 'success',
					'title' => 'Update created!',
					'subtitle' => 'The update has been uploaded successfully!',
				],
				'does_not_exist' => [
					'type' => 'error',
					'title' => 'Ohhh',
					'subtitle' => 'This product does not exist!',
				],
				'files' => [
					'upload' => [
						'error' => [
							'type' => 'error',
							'title' => 'Error to upload the file.',
							'subtitle' => '',
						],
						'extension' => [
							'type' => 'error',
							'title' => 'Extension not allowed.',
							'subtitle' => 'rar, zip, png, gif, pdf, doc, docx, txt',
						],
					],
					'erase' => [
						'type' => 'error',
						'title' => 'Error to erase the file.',
						'subtitle' => '',
					],
				],
			],
		],
	],
	
	'license' => [
		'header' => [
			'name' => 'Manage License',
			'icon' => 'key',
		], 
		'alert' => [
			'erase' => [
				'type' => 'success',
				'title' => 'License deleted successfully!',
				'subtitle' => 'There is no way to recover.',
			],
		],
		'content' => [
			'title' => 'Overview',
			'subtitle' => 'Manage License',
			'table' => [
				'client' => 'Client',
				'key' => 'Key',
				'product' => 'Product',
				'expire' => 'Expire',
				'status' => [
					'name' => 'Status',
					'active' => 'Active',
					'inactive' => 'Inactive',
				],
				'since' => 'Since',
				'actions' => 'Actions',
				'no_results' => '<h5>You have no items in your basket.</h5>',
				'buttons' => [
					'copy_key' => [
						'text' => '<i class="fa-regular fa-copy"></i>',
						'tooltip' => 'Copy Key!',
					],
					'overview' => [
						'text' => '<i class="fa fa-chart-simple"></i>',
						'tooltip' => 'Overview!',
					],
					'settings' => [
						'text' => '<i class="fa fa-gear"></i>',
						'clone' => '<i class="fa-regular fa-clone"></i> Clone',
						'edit' => '<i class="fa-regular fa-pen-to-square"></i> Edit',
						'erase' => '<i class="fa fa-eraser"></i> Erase',
						'refresh' => '<i class="fa fa-rotate-right"></i> Refresh Key',
						'reset_ips' => '<i class="fa fa-rotate"></i> Reset IP Caps',
						'reset_logs' => '<i class="fa fa-scroll"></i> Reset Logs',
					],
					'gift' => [
						'text' => '<i class="fa fa-gift"></i>',
						'tooltip' => 'Redeem gift!',
					],
				],
			],
			'buttons' => [
				'create' => 'Create <i class="fa fa-plus"></i>',
				'redeem' => 'Redeem <i class="fa fa-gift"></i>',
				'edit' => '<i class="fa-regular fa-pen-to-square"></i> Edit',
				'back' => '<i class="fa fa-circle-left"></i> Back',
				'save' => '<i class="fa fa-check"></i> Save',
				'download' => '<i class="ti ti-cloud-download"></i> Download',
			],
			'card' => [
				'request' => '<b>Requests</b>',
				'keys' => '<b>Licenses</b>',
				'keys_on' => '<b>Keys On</b>',
				'keys_off' => '<b>Keys Off</b>',
			],
			'redeem' => [
				'header' => '<i class="text-primary fa fa-gift"></i> Redeem codes',
				'placeholder' => 'DEVBY-BBBBB-CCCCC-DDDDD',
				'button' => 'Redeem <i class="fa fa-gift"></i>',
			],
			
			'overview' => [
				'title' => 'Overview',
				'subtitle' => 'Key #{license:id}',
				'card' => [
					'key' => [
						'title' => 'License Key',
						'subtitle' => '{license:key}',
					],
					'created_at' => [
						'title' => 'Created At',
						'subtitle' => '{license:date}',
					],
					'expire' => [
						'title' => 'Expiration',
						'subtitle' => '{license:expire}',
					],
					'product' => [
						'title' => 'Product',
						'subtitle' => '{license:product}',
					],
					'status' => [
						'title' => 'Status',
						'subtitle' => '{license:status}',
					],
					'custom_addons' => [
						'title' => 'Custom Addons',
						'subtitle' => '{license:quant:custom_addons}',
					],
				],
				'ip_history' => [
					'title' => 'IP History',
					'counter' => '{license:ips}/{license:ipsmax}',
					'button' => 'Reset',
				],
			],
			'create' => [
				'title' => 'Create',
				'subtitle' => 'License',
				'already_exists' => [
					'title' => '<i class="text-warning fa fa-warning"></i> The key already exists',
					'subtitle' => 'If you want to modify it, just change the necessary data and click save. And if you want to cancel this option, simply generate a new key. <br>Exactly click on the icon: <i class="text-danger fa fa-arrows-rotate"></i> <br>And this method will automatically be canceled. If you want to do it again, enter a key that exists and this sign will appear again.',
				],
				'form' => [
					'client' => [
						'label' => 'Client',
						'placeholder' => 'User sync id',
						'tooltip' => 'Type 2 letters or numbers and the list will appear.',
					],
					'key' => [
						'label' => 'Key',
						'placeholder' => 'XXXXX-XXXXX-XXXXX-XXXXX',
						'tooltip' => [
							'copy' => 'Copy the key.',
							'refresh' => 'Regenerate the key.',
							'config' => 'Set key initials.',
						],
					],
					'product' => [
						'label' => 'Product',
						'placeholder' => 'Product name',
						'tooltip' => 'The name you enter must be completely the same as the name of the product in case you enable the product requirement.',
					],
					'ip_cap' => [
						'label' => 'IP Cap',
						'placeholder' => '5',
						'tooltip' => 'License overuse limiter, Limiting up to * ips in the license.',
					],
					'expiration' => [
						'label' => 'Expiration',
						'placeholder' => '',
						'type' => [
							'seconds' => 'Seconds',
							'minutes' => 'Minutes',
							'hours' => 'Hours',
							'days' => 'Days',
							'months' => 'Months',
							'years' => 'Years',
							'never' => 'Never',
							'expired' => 'Expired',
						],
					],
					'reason' => [
						'label' => 'Reason',
						'placeholder' => '',
						'tooltip' => 'Enter a reason or simply leave it blank.',
					],
					'custom_addons' => [
						'label' => 'Custom Addons',
						'button' => '<i class="fa fa-plus" style="margin-right: 7px;"></i> Custom Addons',
					],
					'addons' => [
						'label' => 'Addons',
						'bound' => [
							'text' => 'Only accept the type of product placed.',
							'tooltip' => 'If you try to use the license with another product, This action will not accept that request.',
						],
						'ip_log' => [
							'text' => 'Obtain and save the IP\'s that use this license.',
						],
						'logs' => [
							'text' => 'Save any type of logs.',
							'tooltip' => 'IP log does not count in this option.',
						],
						'delete_ips' => [
							'text' => 'Delete the IPs used every so often after making another request.',
							'tooltip' => 'It will delete all the IPs used and that an exact time has passed since their last use.',
						],
						'limit' => [
							'text' => 'Set frozen status if the license has 100 requests in 1 hour.',
							'tooltip' => 'When the license has more than 100 requests in less than 1 hour, freeze it for 1 day. This could help you maintain very high security. It is recommended if the requests are not made by the server.',
						],
						'product_verify' => [
							'text' => 'The product has to be in the products category.',
							'tooltip' => 'If you activate this, if the product is not found in the product category, it will automatically deny the requests. Unless it exists. With this you will also get the latest version of the product in case you want to make an update message.',
						],
						'require_version' => [
							'text' => 'The version of the request must be the same as that of the mandatory product.',
							'tooltip' => 'If you want to make the key require that the version of the request be the same as the current version of the product, you can enable this option.',
						],
						'expire_erase' => [
							'text' => 'Delete the key if it is expired.',
						],
						'admit_clone' => [
							'text' => 'Allow cloning this configuration.',
						],
						'send_discord' => [
							'text' => 'Send message to the client\'s private message on discord.',
							'tooltip' => 'For this function, the bot token, secret key and client id must be configured. By activating this function, it may take 1-5 seconds for creation.',
						],
						'send_webhook' => [
							'text' => 'Send a message to the discord webhook, When creating the license.',
							'tooltip' => 'It is necessary to have configured the webhook url for this function to work.',
						],
					],
					'key_config' => [
						'title' => '<i class="text-primary fa fa-key"></i> Key Configuration',
						'key_digits' => 'Key Digits:',
						'quant_of_separator' => 'Quant of Separators:',
						'separator_digit' => 'Separator Digit:',
						'qodps' => 'Quantity of Digits per separator:',
						'example' => 'Example:',
						'buttons' => [
							'generate' => '<i class="fa fa-arrows-rotate"></i> Generate Example',
							'save' => '<i class="fa fa-check"></i> Save Draft',
						],
					],
				],
			],
		],
	],
	
	'dashboard' => [
		'header' => [
			'name' => 'Dashboard',
			'icon' => 'chart-bar',
		], 
		'content' => [
			'title' => 'Overview',
			'subtitle' => 'Dashboard',
		],
	],
	
	'group' => [
		'header' => [
			'name' => 'Manage Group',
			'icon' => 'tags',
		], 
		'content' => [
			'title' => 'Overview',
			'subtitle' => 'Manage Group',
			'new' => 'New Groups',
			'buttons' => [
				'save' => '<i class="fa fa-check"></i> Save',
				'create' => 'Create <i class="fa fa-plus"></i>',
				'cancel' => '<i class="fa fa-xmark"></i> Cancel',
				'edit' => '<i class="fa-regular fa-pen-to-square"></i> Edit',
				'back' => '<i class="fa fa-chevron-left"></i> Back',
			],
			'overview' => [
				'title' => 'Group',
				'subtitle' => '{group:name}',
				'permissions' => [
					'tab' => 'Permissions List',
					'title' => 'Permissions',
				],
				'users' => [
					'tab' => 'Users List',
					'title' => 'Users',
				],
			],
			'edit' => [
				'name' => [
					'label' => 'Name:',
					'placeholder' => 'New name for the group',
				],
				'color' => [
					'label' => 'Color:',
					'title' => 'Choose new color',
				],
				'default' => 'Set as default group. This includes that all those who have the previous group will be transferred to this one.',
			],
		],
	],
	
	
	'code' => [
		'header' => [
			'name' => 'Manage Code',
			'icon' => 'lock-code',
		], 
		'content' => [
			'title' => 'Overview',
			'subtitle' => 'Manage Code',
			'table' => [
				'type' => 'Type',
				'code' => 'Code',
				'status' => [
					'column' => 'Status',
					'used' => 'Used',
					'canceled' => 'Canceled',
					'pending' => 'Pending',
				],
				'used_by' => 'Used by',
				'since' => 'Since',
				'actions' => 'Actions',
				'no_results' => '<h5>You have no items in your basket.</h5>',
				'buttons' => [
					'overview' => [
						'text' => '<i class="fa fa-chart-simple"></i>',
						'tooltip' => 'Overview',
					],
					'edit' => [
						'text' => '<i class="fa fa-pen-to-square"></i>',
						'tooltip' => 'Edit',
					],
					'erase' => [
						'text' => '<i class="fa fa-eraser"></i>',
						'tooltip' => 'Erase',
					],
				],
			],
			'buttons' => [
				'create' => 'Create <i class="fa fa-plus"></i>',
				'license' => '<i class="fa fa-key"></i> License',
				'addons' => '<i class="fa fa-plus-minus"></i> Addons',
				'request' => '<i class="fa fa-code-pull-request"></i> Request',
				'back' => '<i class="fa fa-circle-left"></i> Back',
			],
			'overview' => [
				'title' => 'Overview',
				'subtitle' => 'Code #{code:id}',
				'card' => [
					'code' => 'Code:',
					'type' => 'Type:',
					'used_by' => 'Used By:',
					'status' => 'Status:',
				],
				'buttons' => [
					'refresh' => 'Refresh Code',
					'reset' => 'Reset Use',
				],
			],
			'create' => [
				'license' => [
					'title' => 'Create Code',
					'subtitle' => 'License',
				],
				'addons' => [
					'title' => 'Create Code',
					'subtitle' => 'Addons for License',
					'code' => [
						'label' => 'Code',
						'placeholder' => 'XXXXX-XXXXX-XXXXX-XXXXX',
						'tooltip' => [
							'1' => 'Copy Code',
							'2' => 'Regenerate the code',
						],
					],
					'note' => '<b class="text-warning">NOTE:</b> <br>This addon operation is to add custom addons when claiming the code to the license chosen by the user. Addons added here will be automatically implemented to the license.',
				],
				'request' => [
					'title' => 'Create Code',
					'subtitle' => 'Request',
					'low_lvl' => [
						'title' => 'The level of requests is too low.',
						'subtitle' => 'It is necessary to configure the request level to the required level to enable this function.',
						'click_here' => 'Documentation',
					],
					'level' => [
						'card' => [
							'type' => [
								'title' => 'Type',
								'subtitle' => '{code:type}',
							],
						],
						'note' => '<b class="text-warning">NOTE:</b> Without keys it will simply accept all the licenses that try to enter with the code. If you want to avoid this, Simply. Add keys and it will only accept the licenses found in the code.',
						'information' => [
							'title' => 'You can use this security format in several ways.',
							'subtitle' => 'You can make it secure by putting it inside your code or you can hand it off for the user to put in the settings.',
						],
					],
					'custom_addons' => [
						'label' => 'Limited to [Write the key]',
						'button' => 'Specific licenses (optional)',
					],
				],
			],
			'status' => [
				'active' => 'Active',
				'canceled' => 'Canceled',
				'pending' => 'Pending',
			],
		],
	],
	
	'user' => [
		'header' => [
			'name' => 'User',
			'icon' => 'user-hexagon',
		], 
		'content' => [
			'title' => 'Overview',
			'subtitle' => 'Manage User',
			'table' => [
				'username' => 'User',
				'email' => 'Email',
				'token' => 'Token',
				'keys' => 'Keys',
				'group' => 'Primary Group',
				'since' => 'Since',
				'actions' => 'Actions',
				'no_results' => '<h5>You have no items in your basket.</h5>',
				'buttons' => [
					'overview' => 'Overview!',
					'groups' => 'Groups',
					'edit' => 'Edit',
					'erase' => 'erase',
				],
				'ip_history' => [
					'country' => 'Country',
					'ip' => 'IP',
					'since' => 'Since',
				],
			],
			'buttons' => [
				'edit' => '<i class="fa-regular fa-pen-to-square"></i> Edit',
				'back' => '<i class="fa fa-circle-left"></i> Back',
			],
			'discord' => [
				'on_server' => 'The user is a member of your discord guild!',
				'not_on_server' => 'The user is not a member of your discord guild.',
			],
			'card' => [
				'member_since' => 'Member Since',
				'sync_id' => [
					'label' => 'Sync ID',
					'tooltip' => 'Create license for this user.',
				],
				'devices' => [
					'label' => 'Logged in Devices',
					'tooltip' => 'Log out of all devices',
				],
				'request' => [
					'label' => 'Requests',
					'tooltip' => 'Clear all Requests',
				],
				'keys' => 'License Keys',
				'groups' => 'Groups',
				'claims' => 'Claims',
				'ip_history' => 'IP History',
			],
			'modal' => 'Select Groups',
		],
		'edit' => [
			'title' => 'Edit Account',
			'subtitle' => '{user:name}',
			'buttons' => [
				'save' => '<i class="fa fa-check"></i> Save',
			],
			'username' => 'New Username:',
			'update_password' => 'New Password:',
			'change_email' => 'New Email:',
			'alert' => [
				'title' => 'Completed!',
				'subtitle' => 'The user has been modified correctly!',
			],
		],
	],
	
	'settings' => [
		'header' => [
			'name' => 'My Profile',
			'icon' => 'settings',
		], 
		'content' => [
			'status' => [
				'online' => 'Online',
				'offline' => 'Offline',
			],
			'buttons' => [
				'logout' => 'Logout',
			],
			'card' => [
				'language' => 'Language',
				'theme' => [
					'title' => 'Theme',
					'light' => 'Light',
					'dark' => 'Dark',
					'auto' => 'Sync with computer',
				],
				'information' => [
					'title' => 'Secret Information',
					'secret' => [
						'label' => 'Secret Key',
						'tooltip' => [
							'copy' => 'Copy Secret Key',
							'refresh' => 'Regenerate Secret Key',
						],
						'placeholder' => 'Secret Key',
					],
					'token' => [
						'label' => 'Token',
						'tooltip' => 'Copy Token',
						'placeholder' => 'Token Key',
					],
					'note' => '<b class="text-danger">NOTE:</b> Never share the secret key. Just put it in our services software.',
				],
				'update_password' => [
					'title' => 'Update Password',
					'button' => 'Change',
					'current' => [
						'label' => 'Current Password',
						'placeholder' => '',
					],
					'new' => [
						'label' => 'New Password',
						'placeholder' => '',
					],
					'confirm' => [
						'label' => 'Confirm Password',
						'placeholder' => '',
					],
					'note' => '<b class="text-danger">NOTE:</b> Never share the secret key. Just put it in our services software.',
				],
				'change_email' => [
					'title' => 'Update E-Mail',
					'button' => 'Confirm',
					'new' => [
						'label' => 'New E-Mail',
						'placeholder' => '',
					],
					'confirm' => [
						'label' => 'Confirm Code',
						'placeholder' => '',
					],
					'note' => '<b class="text-danger">NOTE:</b> Once sent, check your email box, as well as your spam box.',
				],
			],
		],
	],
	
	'download' => [
		'header' => [
			'name' => 'Downloads',
			'icon' => 'cloud-download',
		], 
		'content' => [
			'title' => 'Overview',
			'subtitle' => 'Manage Downloads',
			'buttons' => [
				'download' => 'Download',
			],
			'table' => [
				'id' => '#',
				'user' => 'User',
				'file' => 'File',
				'code' => 'Code',
				'since' => 'Since',
			],
		],
	],

	'basket' => [
		'header' => [
			'name' => 'Basket',
			'icon' => 'basket',
		],
		'content' => [
			'title' => 'Overview',
			'subtitle' => 'My Basket',
			'button' => 'Go to Pay',
			'remove' => 'Remove from Cart',
			'auth' => [
				'description' => 'We must validate your discord account with tebex in order to begin the purchase.',
				'button' => 'Auth me',
			],
			'payments' => [
				'title' => 'Payment Completed',
				'subtitle' => 'Thanks for your Puchasing!',
				'list' => 'Items puchased:',
				'note' => 'All your items to download can be found in \'downloads\' or your keys in \'licenses\'',
			],
		],
	],
	
	'session' => [
		'expire' => '<h4><i class="text-warning fa fa-warning"></i> Your session has expired. Please start again.</h4>',
		'alert' => [
			'type' => 'error',
			'title' => 'Session expired',
			'subtitle' => 'Your session has expired. Please start again.',
		],
	],
	'error' => [
		'without_permission' => [
			'type' => 'error',
			'title' => 'Without Permissions.',
			'subtitle' => 'You not have permission for execute this action.',
		],
		'empty' => [
			'type' => 'error',
			'title' => 'Ohh, there are problems!',
			'subtitle' => 'Problems occurred. Try again!',
		],
		'tebex_empty' => [
			'type' => 'error',
			'title' => 'Tebex product ID',
			'subtitle' => 'The product id is necessary for purchases. In any case, simply disable it.',
		],
		'not_group_on_db' => '<i class="fa fa-xmark"></i> There is no group.',
		'not_results_on_db' => '<i class="fa fa-xmark"></i> There is no results.',
		'user_unknown' => 'There is no registered user.',
	],
    'filters' => [
        'search' => 'Search..',
        'showing' => 'Showing :compag_to: to :end: of :results: entries',
        'unknown' => 'Unknown',
    ],
    'counttime' => [
		'ago-type' => 2, // 1: Ago 20 Days / 2: 20 Days Ago
		'ago' => 'ago',
        'years' => 'Years', // years or Years (example: Since 12 Years ago / Since 12 years ago)
        'year' => 'Year', // year or Year (example: Since 1 Year ago / Since 1 year ago)
        'months' => 'Months',
        'month' => 'Month',
        'days' => 'Days',
        'day' => 'Day',
        'hours' => 'Hours',
        'hour' => 'Hour',
        'minutes' => 'Minutes',
        'minute' => 'Minute',
        'seconds' => 'Seconds',
        'second' => 'Second',
        'separator' => 'and', // 27d, 15mins "and" 30 secs
    ],
	'months' => [
		'low' => [
			'jan' => 'Jan',
			'feb' => 'Feb',
			'mar' => 'Mar',
			'apr' => 'Apr',
			'may' => 'May',
			'jul' => 'Jul',
			'jun' => 'Jun',
			'aug' => 'Aug',
			'sep' => 'Sep',
			'oct' => 'Oct',
			'nov' => 'Nov',
			'dec' => 'Dec',
		],
		'complete' => [
			'jan' => 'January',
			'feb' => 'February',
			'mar' => 'March',
			'apr' => 'April',
			'may' => 'May',
			'jun' => 'June',
			'jul' => 'July',
			'aug' => 'August',
			'sep' => 'September',
			'oct' => 'October',
			'nov' => 'November',
			'dec' => 'December',
		],
	],
];


?>