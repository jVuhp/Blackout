<?php

$messages = [
	'display' => ['ar', 'mx', 'cl', 'co', 'cr', 'cu', 'do', 'ec', 'sv', 'gq', 'gt', 'hn', 'ni', 'pa', 'py', 'pe', 'es', 'us (pr)', 'uy', 've'],
	'location' => [
		'flag' => 'ar',
		'name' => 'Español (AR)',
	],
	'dropdown' => [
		'toggle' => 'Cambiar Tema',
		'profile' => 'Mi Perfil',
		'logout' => 'Cerrar Sesión',
	],
	'theme' => [
		'light' => 'Claro',
		'dark' => 'Oscuro',
		'mode' => [
			'dark' => 'Modo Oscuro',
			'light' => 'Modo Claro',
		],
	],
	'404' => [
		'title' => '¡Ups... Acabas de encontrar una página de error!',
		'subtitle' => 'Lo sentimos, pero la página que buscas no se encontró.',
		'button' => 'Volver a la página',
	],
	'erase' => [
		'secure' => [
			'type' => 'question',
			'title' => '¿Estás seguro?',
			'subtitle' => 'No habrá forma de recuperar.',
			'button' => 'Borrar',
		],
	],
	'clone' => [
		'secure' => [
			'type' => 'question',
			'title' => '¿Seguro que quieres hacer esto?',
			'subtitle' => 'Acabas de crear y pegar la configuración de esto.',
			'button' => 'Ok',
		],
	],
	'edit' => [
		'complete' => [
			'type' => 'success',
			'title' => '¡Todos los cambios guardados!',
			'subtitle' => '',
		],
	],
	'auth' => [
		'header' => [
			'name' => 'Autenticación',
			'icon' => 'login',
		], 
		'content' => [
			'community' => [
				'name' => 'Comunidad',
				'link' => 'https://discord.gg/FWMK2XQhpa',
			],
			'new' => [
				'logo' => 'https://devlicense.devbybit.com/parent/img/devbybit-logos.png',
				'title' => '¡Bienvenido a {site:name}! 👋',
				'button' => 'Iniciar sesión con Discord',
			],
			'old' => [
				'remember' => 'Mantenerme conectado en este dispositivo.',
				'placeholder' => 'Tu contraseña',
				'close' => 'Cerrar sesión en esta cuenta.',
			],
		],
	],
	'product' => [
		'header' => [
			'name' => 'Productos',
			'icon' => 'box-seam',
		], 
		'alert' => [
			'erase' => [
				'type' => 'success',
				'title' => '¡Producto eliminado correctamente!',
				'subtitle' => 'El producto ha sido eliminado exitosamente. No hay forma de recuperarlo.',
			],
		],
		'content' => [
			'title' => 'Resumen',
			'subtitle' => 'Producto',
			'table' => [
				'icon' => 'Ícono',
				'name' => 'Nombre',
				'description' => 'Descripción',
				'price' => 'Precio',
				'version' => 'Versión',
				'since' => 'Desde',
				'actions' => 'Acciones',
				'no_results' => '<h5>No se encontraron resultados.</h5>',
				'buttons' => [
					'add_to_cart' => [
						'text' => '<i class="fa fa-cart-plus"></i>',
						'tooltip' => 'Agregar al Carrito',
					],
					'overview' => [
						'text' => '<i class="fa fa-chart-simple"></i>',
						'tooltip' => 'Resumen',
					],
					'settings' => [
						'icon' => '<i class="fa fa-gear"></i>',
						'clone' => '<i class="fa-regular fa-clone"></i> Clonar',
						'edit' => '<i class="fa-regular fa-pen-to-square"></i> Editar',
						'erase' => '<i class="fa fa-eraser"></i> Borrar',
						'update' => '<i class="fa fa-file-arrow-down"></i> Actualizar',
					],
				],
			],
			'overview' => [
				'title' => '{product:name}',
				'subtitle' => 'Producto',
				'card' => [
					'keys' => [
						'icon' => '<i class="fa fa-key"></i>',
						'text' => '<b>Llaves</b>',
					],
					'profits' => [
						'icon' => '<i class="fa fa-coins"></i>',
						'text' => '<b>Ganancias</b>',
						'tooltip' => 'Esto se calcula por las llaves existentes y el precio del producto.',
					],
					'actions' => [
						'icon' => '<i class="fa fa-coins"></i>',
						'files' => [
							'icon' => '<i class="fa fa-file"></i>',
							'title' => 'Descargar Archivos',
							'subtitle' => '{product:count:files}',
						],
						'keys' => [
							'icon' => '<i class="fa fa-key"></i>',
							'title' => 'Llaves de Licencia',
							'subtitle' => '{product:count:keys}',
						],
						'group' => [
							'icon' => '<i class="fa fa-layer-group"></i>',
							'title' => 'Asignar Grupos',
							'subtitle' => '{product:count:group}',
						],
					],
				],
			],
			'updates' => [
				'title' => 'Actualizaciones',
				'form' => [
					'title' => 'Actualizar producto',
					'new_version' => [
						'label' => 'Número de versión nueva:',
						'placeholder' => '1.1',
					],
					'new_content' => 'Nuevo contenido:',
					'new_title' => 'Título de la actualización:',
					'new_message' => 'Mensaje de la actualización:',
				],
				'card' => [
					'version' => 'Versión',
					'initial_released' => 'Lanzamiento Inicial',
					'buttons' => [
						'edit' => '<i class="fa fa-file-pen"></i> Editar',
						'erase' => '<i class="fa fa-eraser"></i> Borrar',
					],
				],
			],
			'create' => [
				'edit_title' => 'Editar',
				'title' => 'Crear',
				'subtitle' => 'Producto',
				'buttons' => [
					'ref' => 'Crear <i class="fa fa-plus"></i>',
					'back' => '<i class="fa fa-chevron-left"></i> Atrás',
					'create' => 'Crear <i class="fa fa-plus"></i>',
					'save' => 'Guardar <i class="fa fa-check"></i>',
					'cancel' => '<i class="fa fa-ban"></i> <b>Cancelar</b>',
					'update' => '<i class="fa fa-file-arrow-up"></i> <b>Actualizar</b>',
				],
				'form' => [
					'id_name' => [
						'label' => 'Nombre ID',
						'placeholder' => 'Esto es necesario para verificar en la solicitud.',
						'tooltip' => 'Esto se utilizará en caso de que quiera o necesite este producto para su clave. Debe poner el nombre de su software que enviará el nombre del código.',
					],
					'name' => [
						'label' => 'Nombre',
						'placeholder' => 'Nombre del producto',
						'tooltip' => 'Este nombre se utilizará para la vista de Blackout Software. Es casi opcional pero necesario definirlo.',
					],
					'price' => [
						'label' => 'Precio',
						'placeholder' => '5.50',
					],
					'version' => [
						'label' => 'Versión',
						'placeholder' => '1.0',
					],
					'tebex_product' => [
						'label' => 'ID de Producto Tebex',
						'placeholder' => '6119444',
						'tooltip' => 'Es necesario ingresar solo el ID del producto, en caso de que coloque la venta.',
					],
					'description' => [
						'label' => 'Descripción',
						'placeholder' => 'Descripción del producto',
						'tooltip' => 'La descripción es opcional. Esto se puede usar para dar una biografía al producto.',
					],
					'icon' => [
						'label' => 'Ícono',
						'placeholder' => 'Coloque la URL de la imagen.',
						'tooltip' => 'Puede dejarlo en blanco para usar un ícono con el texto del nombre del producto.',
					],
					'actions' => [
						'label' => 'Acciones',
						'tooltip' => 'Estas acciones solo se aplican si el usuario compró en el sitio.',
						'file_download' => [
							'button' => 'Descarga de Archivo',
							'title' => 'Subir sus Archivos',
							'new_file' => 'Subir nuevo archivo',
							'header' => 'Archivos',
						],
						'license_key' => [
							'button' => 'Llave de Licencia',
							'title' => 'Configurar las Licencias',
							'new_keys' => 'Nuevas llaves',
						],
						'group' => [
							'button' => 'Grupo',
							'title' => 'Seleccionar grupos para Asignar',
						],
					],
				],
			],
			'alert' => [
				'create_product' => [
					'type' => 'success',
					'title' => '¡Ejecución completa!',
					'subtitle' => '¡Tu producto se ha creado correctamente! Serás redirigido.',
				],
				'edited_product' => [
					'type' => 'success',
					'title' => '¡Ejecución completa!',
					'subtitle' => '¡Tu producto ha sido editado correctamente! Serás redirigido.',
				],
				'cloned_product' => [
					'type' => 'success',
					'title' => '¡Ejecución completa!',
					'subtitle' => '¡Tu producto ha sido clonado correctamente! Serás redirigido.',
				],
				'updated_product' => [
					'type' => 'success',
					'title' => '¡Actualización creada!',
					'subtitle' => '¡La actualización se ha subido correctamente!',
				],
				'does_not_exist' => [
					'type' => 'error',
					'title' => '¡Ohhh!',
					'subtitle' => '¡Este producto no existe!',
				],
				'files' => [
					'upload' => [
						'error' => [
							'type' => 'error',
							'title' => 'Error al cargar el archivo.',
							'subtitle' => '',
						],
						'extension' => [
							'type' => 'error',
							'title' => 'Extensión no permitida.',
							'subtitle' => 'rar, zip, png, gif, pdf, doc, docx, txt',
						],
					],
					'erase' => [
						'type' => 'error',
						'title' => 'Error al borrar el archivo.',
						'subtitle' => '',
					],
				],
			],
		],
	],
	
	'license' => [
		'header' => [
			'name' => 'Gestionar Licencia',
			'icon' => 'key',
		], 
		'alert' => [
			'erase' => [
				'type' => 'success',
				'title' => '¡Licencia borrada exitosamente!',
				'subtitle' => 'No hay forma de recuperarla.',
			],
		],
		'content' => [
			'title' => 'Resumen',
			'subtitle' => 'Gestionar Licencia',
			'table' => [
				'client' => 'Cliente',
				'key' => 'Llave',
				'product' => 'Producto',
				'expire' => 'Vencimiento',
				'status' => [
					'name' => 'Estado',
					'active' => 'Activo',
					'inactive' => 'Inactivo',
				],
				'since' => 'Desde',
				'actions' => 'Acciones',
				'no_results' => '<h5>No tienes artículos en tu cesta.</h5>',
				'buttons' => [
					'copy_key' => [
						'text' => '<i class="fa-regular fa-copy"></i>',
						'tooltip' => '¡Copiar Llave!',
					],
					'overview' => [
						'text' => '<i class="fa fa-chart-simple"></i>',
						'tooltip' => '¡Resumen!',
					],
					'settings' => [
						'text' => '<i class="fa fa-gear"></i>',
						'clone' => '<i class="fa-regular fa-clone"></i> Clonar',
						'edit' => '<i class="fa-regular fa-pen-to-square"></i> Editar',
						'erase' => '<i class="fa fa-eraser"></i> Borrar',
						'refresh' => '<i class="fa fa-rotate-right"></i> Actualizar Llave',
						'reset_ips' => '<i class="fa fa-rotate"></i> Restablecer Límites de IP',
						'reset_logs' => '<i class="fa fa-scroll"></i> Restablecer Registros',
					],
					'gift' => [
						'text' => '<i class="fa fa-gift"></i>',
						'tooltip' => '¡Canjear regalo!',
					],
				],
			],
			'buttons' => [
				'create' => 'Crear <i class="fa fa-plus"></i>',
				'redeem' => 'Canjear <i class="fa fa-gift"></i>',
				'edit' => '<i class="fa-regular fa-pen-to-square"></i> Editar',
				'back' => '<i class="fa fa-circle-left"></i> Atrás',
				'save' => '<i class="fa fa-check"></i> Guardar',
				'download' => '<i class="ti ti-cloud-download"></i> Descargar',
			],
			'card' => [
				'request' => '<b>Solicitudes</b>',
				'keys' => '<b>Llaves</b>',
				'keys_on' => '<b>Llaves Activas</b>',
				'keys_off' => '<b>Llaves Inactivas</b>',
			],
			'redeem' => [
				'header' => '<i class="text-primary fa fa-gift"></i> Códigos de Canje',
				'placeholder' => 'DEVBY-BBBBB-CCCCC-DDDDD',
				'button' => 'Canjear <i class="fa fa-gift"></i>',
			],
			
			'overview' => [
				'title' => 'Resumen',
				'subtitle' => 'Llave #{license:id}',
				'card' => [
					'key' => [
						'title' => 'Llave de Licencia',
						'subtitle' => '{license:key}',
					],
					'created_at' => [
						'title' => 'Creado en',
						'subtitle' => '{license:date}',
					],
					'expire' => [
						'title' => 'Vencimiento',
						'subtitle' => '{license:expire}',
					],
					'product' => [
						'title' => 'Producto',
						'subtitle' => '{license:product}',
					],
					'status' => [
						'title' => 'Estado',
						'subtitle' => '{license:status}',
					],
					'custom_addons' => [
						'title' => 'Addons Personalizados',
						'subtitle' => '{license:quant:custom_addons}',
					],
				],
				'ip_history' => [
					'title' => 'Historial de IP',
					'counter' => '{license:ips}/{license:ipsmax}',
					'button' => 'Restablecer',
				],
			],
			"create" => [
				"title" => "Crear",
				"subtitle" => "Licencia",
				"already_exists" => [
					"title" => "<i class='text-warning fa fa-warning'></i> La clave ya existe",
					"subtitle" => "Si deseas modificarla, simplemente cambia los datos necesarios y haz clic en guardar. Y si deseas cancelar esta opción, simplemente genera una nueva clave. <br>Exactamente haz clic en el ícono: <i class='text-danger fa fa-arrows-rotate'></i> <br>Y este método se cancelará automáticamente. Si deseas hacerlo nuevamente, ingresa una clave que exista y este signo volverá a aparecer.",
				],
				"form" => [
					"client" => [
						"label" => "Cliente",
						"placeholder" => "ID de sincronización de usuario",
						"tooltip" => "Escribe 2 letras o números y aparecerá la lista.",
					],
					"key" => [
						"label" => "Clave",
						"placeholder" => "XXXXX-XXXXX-XXXXX-XXXXX",
						"tooltip" => [
							"copy" => "Copiar la clave.",
							"refresh" => "Regenerar la clave.",
							"config" => "Configurar iniciales de la clave.",
						],
					],
					"product" => [
						"label" => "Producto",
						"placeholder" => "Nombre del producto",
						"tooltip" => "El nombre que ingreses debe ser exactamente igual al nombre del producto en caso de que habilites el requisito del producto.",
					],
					"ip_cap" => [
						"label" => "Límite de IP",
						"placeholder" => "5",
						"tooltip" => "Limitador de uso excesivo de licencias, limitando hasta * ips en la licencia.",
					],
					"expiration" => [
						"label" => "Vencimiento",
						"placeholder" => "",
						"type" => [
							"seconds" => "Segundos",
							"minutes" => "Minutos",
							"hours" => "Horas",
							"days" => "Días",
							"months" => "Meses",
							"years" => "Años",
							"never" => "Nunca",
							"expired" => "Expirado",
						],
					],
					"reason" => [
						"label" => "Motivo",
						"placeholder" => "",
						"tooltip" => "Ingresa un motivo o simplemente déjalo en blanco.",
					],
					"custom_addons" => [
						"label" => "Complementos Personalizados",
						"button" => "<i class='fa fa-plus' style='margin-right: 7px;'></i> Complementos Personalizados",
					],
					"addons" => [
						"label" => "Complementos",
						"bound" => [
							"text" => "Solo acepta el tipo de producto colocado.",
							"tooltip" => "Si intentas utilizar la licencia con otro producto, esta acción no aceptará esa solicitud.",
						],
						"ip_log" => [
							"text" => "Obtener y guardar las IP que utilizan esta licencia.",
						],
						"logs" => [
							"text" => "Guardar cualquier tipo de registros.",
							"tooltip" => "El registro de IP no cuenta en esta opción.",
						],
						"delete_ips" => [
							"text" => "Eliminar las IP utilizadas cada cierto tiempo después de realizar otra solicitud.",
							"tooltip" => "Eliminará todas las IP utilizadas y que haya pasado un tiempo exacto desde su último uso.",
						],
						"limit" => [
							"text" => "Establecer estado congelado si la licencia tiene 100 solicitudes en 1 hora.",
							"tooltip" => "Cuando la licencia tenga más de 100 solicitudes en menos de 1 hora, congélela por 1 día. Esto podría ayudarlo a mantener una seguridad muy alta. Se recomienda si las solicitudes no son realizadas por el servidor.",
						],
						"product_verify" => [
							"text" => "El producto debe estar en la categoría de productos.",
							"tooltip" => "Si activas esto, si el producto no se encuentra en la categoría de productos, automáticamente denegará las solicitudes. A menos que exista. Con esto también obtendrás la última versión del producto en caso de que desees hacer un mensaje de actualización.",
						],
						"require_version" => [
							"text" => "La versión de la solicitud debe ser la misma que la del producto obligatorio.",
							"tooltip" => "Si deseas que la clave requiera que la versión de la solicitud sea la misma que la versión actual del producto, puedes habilitar esta opción.",
						],
						"expire_erase" => [
							"text" => "Eliminar la clave si está vencida.",
						],
						"admit_clone" => [
							"text" => "Permitir clonar esta configuración.",
						],
						"send_discord" => [
							"text" => "Enviar mensaje al mensaje privado del cliente en discord.",
							"tooltip" => "Para esta función, el token del bot, la clave secreta y el ID del cliente deben estar configurados. Al activar esta función, puede tardar de 1 a 5 segundos en crearse.",
						],
						"send_webhook" => [
							"text" => "Enviar un mensaje al webhook de discord, al crear la licencia.",
							"tooltip" => "Es necesario tener configurada la URL del webhook para que funcione esta función.",
						],
					],
					"key_config" => [
						"title" => "<i class='text-primary fa fa-key'></i> Configuración de Clave",
						"key_digits" => "Dígitos de Clave:",
						"quant_of_separator" => "Cantidad de Separadores:",
						"separator_digit" => "Dígito Separador:",
						"qodps" => "Cantidad de Dígitos por Separador:",
						"example" => "Ejemplo:",
						"buttons" => [
							"generate" => "<i class='fa fa-arrows-rotate'></i> Generar Ejemplo",
							"save" => "<i class='fa fa-check'></i> Guardar Borrador",
						],
					],
				],
			],
		],
	],
	
	'dashboard' => [
		'header' => [
			'name' => 'Tablero',
			'icon' => 'chart-bar',
		],
		'content' => [
			'title' => 'Resumen',
			'subtitle' => 'Tablero',
		],
	],

	'group' => [
		'header' => [
			'name' => 'Administrar Grupo',
			'icon' => 'tags',
		],
		'content' => [
			'title' => 'Resumen',
			'subtitle' => 'Administrar Grupo',
			'new' => 'Nuevos Grupos',
			'buttons' => [
				'save' => '<i class="fa fa-check"></i> Guardar',
				'create' => 'Crear <i class="fa fa-plus"></i>',
				'cancel' => '<i class="fa fa-xmark"></i> Cancelar',
				'edit' => '<i class="fa-regular fa-pen-to-square"></i> Editar',
				'back' => '<i class="fa fa-chevron-left"></i> Volver',
			],
			'overview' => [
				'title' => 'Grupo',
				'subtitle' => '{group:name}',
				'permissions' => [
					'tab' => 'Lista de Permisos',
					'title' => 'Permisos',
				],
				'users' => [
					'tab' => 'Lista de Usuarios',
					'title' => 'Usuarios',
				],
			],
			'edit' => [
				'name' => [
					'label' => 'Nombre:',
					'placeholder' => 'Nuevo nombre para el grupo',
				],
				'color' => [
					'label' => 'Color:',
					'title' => 'Elegir nuevo color',
				],
				'default' => 'Establecer como grupo predeterminado. Esto incluye que todos los que tengan el grupo anterior serán transferidos a este.',
			],
		],
	],

	'code' => [
		'header' => [
			'name' => 'Administrar Código',
			'icon' => 'lock-code',
		],
		'content' => [
			'title' => 'Resumen',
			'subtitle' => 'Administrar Código',
			'table' => [
				'type' => 'Tipo',
				'code' => 'Código',
				'status' => [
					'column' => 'Estado',
					'used' => 'Usado',
					'canceled' => 'Cancelado',
					'pending' => 'Pendiente',
				],
				'used_by' => 'Usado por',
				'since' => 'Desde',
				'actions' => 'Acciones',
				'no_results' => '<h5>No tienes ítems en tu cesta.</h5>',
				'buttons' => [
					'overview' => [
						'text' => '<i class="fa fa-chart-simple"></i>',
						'tooltip' => 'Resumen',
					],
					'edit' => [
						'text' => '<i class="fa fa-pen-to-square"></i>',
						'tooltip' => 'Editar',
					],
					'erase' => [
						'text' => '<i class="fa fa-eraser"></i>',
						'tooltip' => 'Borrar',
					],
				],
			],
			'buttons' => [
				'create' => 'Crear <i class="fa fa-plus"></i>',
				'license' => '<i class="fa fa-key"></i> Licencia',
				'addons' => '<i class="fa fa-plus-minus"></i> Complementos',
				'request' => '<i class="fa fa-code-pull-request"></i> Solicitar',
				'back' => '<i class="fa fa-circle-left"></i> Volver',
			],
			'overview' => [
				'title' => 'Resumen',
				'subtitle' => 'Código #{code:id}',
				'card' => [
					'code' => 'Código:',
					'type' => 'Tipo:',
					'used_by' => 'Usado Por:',
					'status' => 'Estado:',
				],
				'buttons' => [
					'refresh' => 'Actualizar Código',
					'reset' => 'Restablecer Uso',
				],
			],
			'create' => [
				'license' => [
					'title' => 'Crear Código',
					'subtitle' => 'Licencia',
				],
				'addons' => [
					'title' => 'Crear Código',
					'subtitle' => 'Complementos para Licencia',
					'code' => [
						'label' => 'Código',
						'placeholder' => 'XXXXX-XXXXX-XXXXX-XXXXX',
						'tooltip' => [
							'1' => 'Copiar Código',
							'2' => 'Regenerar el código',
						],
					],
					'note' => '<b class="text-warning">NOTA:</b> <br>Esta operación de complemento es para agregar complementos personalizados al reclamar el código a la licencia elegida por el usuario. Los complementos agregados aquí se implementarán automáticamente en la licencia.',
				],
				'request' => [
					'title' => 'Crear Código',
					'subtitle' => 'Solicitud',
					'low_lvl' => [
						'title' => 'El nivel de solicitudes es demasiado bajo.',
						'subtitle' => 'Es necesario configurar el nivel de solicitud al nivel requerido para habilitar esta función.',
						'click_here' => 'Documentación',
					],
					'level' => [
						'card' => [
							'type' => [
								'title' => 'Tipo',
								'subtitle' => '{code:type}',
							],
						],
						'note' => '<b class="text-warning">NOTA:</b> Sin claves simplemente aceptará todas las licencias que intenten ingresar con el código. Si desea evitar esto, simplemente agregue claves y solo aceptará las licencias encontradas en el código.',
						'information' => [
							'title' => 'Puede utilizar este formato de seguridad de varias maneras.',
							'subtitle' => 'Puede hacerlo seguro poniéndolo dentro de su código o puede entregarlo para que el usuario lo ponga en la configuración.',
						],
					],
					'custom_addons' => [
						'label' => 'Limitado a [Escribir la clave]',
						'button' => 'Licencias específicas (opcional)',
					],
				],
			],
			'status' => [
				'active' => 'Activo',
				'canceled' => 'Cancelado',
				'pending' => 'Pendiente',
			],
		],
	],

	'user' => [
		'header' => [
			'name' => 'Usuario',
			'icon' => 'user-hexagon',
		], 
		'content' => [
			'title' => 'Resumen',
			'subtitle' => 'Gestionar Usuario',
			'table' => [
				'username' => 'Usuario',
				'email' => 'Correo Electrónico',
				'token' => 'Token',
				'keys' => 'Claves',
				'group' => 'Grupo Principal',
				'since' => 'Desde',
				'actions' => 'Acciones',
				'no_results' => '<h5>No tienes ítems en tu cesta.</h5>',
				'buttons' => [
					'overview' => '¡Resumen!',
					'groups' => 'Grupos',
					'edit' => 'Editar',
					'erase' => 'Borrar',
				],
				'ip_history' => [
					'country' => 'País',
					'ip' => 'IP',
					'since' => 'Desde',
				],
			],
			'buttons' => [
				'edit' => '<i class="fa-regular fa-pen-to-square"></i> Editar',
				'back' => '<i class="fa fa-circle-left"></i> Volver',
			],
			'discord' => [
				'on_server' => '¡El usuario es miembro de tu gremio de discordia!',
				'not_on_server' => 'El usuario no es miembro de tu gremio de discordia.',
			],
			'card' => [
				'member_since' => 'Miembro Desde',
				'sync_id' => [
					'label' => 'ID de Sincronización',
					'tooltip' => 'Crear licencia para este usuario.',
				],
				'devices' => [
					'label' => 'Dispositivos Conectados',
					'tooltip' => 'Cerrar sesión en todos los dispositivos',
				],
				'request' => [
					'label' => 'Solicitudes',
					'tooltip' => 'Limpiar todas las solicitudes',
				],
				'keys' => 'Claves de Licencia',
				'groups' => 'Grupos',
				'claims' => 'Reclamos',
				'ip_history' => 'Historial de IP',
			],
			'modal' => 'Seleccionar Grupos',
		],
		'edit' => [
			'title' => 'Editar Cuenta',
			'subtitle' => '{user:name}',
			'buttons' => [
				'save' => '<i class="fa fa-check"></i> Guardar',
			],
			'username' => 'Nuevo Nombre de Usuario:',
			'update_password' => 'Nueva Contraseña:',
			'change_email' => 'Nuevo Correo Electrónico:',
			'alert' => [
				'title' => '¡Completado!',
				'subtitle' => '¡El usuario ha sido modificado correctamente!',
			],
		],
	],
	
	'settings' => [
		'header' => [
			'name' => 'Mi Perfil',
			'icon' => 'settings',
		], 
		'content' => [
			'status' => [
				'online' => 'Conectado',
				'offline' => 'Desconectado',
			],
			'buttons' => [
				'logout' => 'Cerrar Sesión',
			],
			'card' => [
				'language' => 'Idioma',
				'theme' => [
					'title' => 'Tema',
					'light' => 'Claro',
					'dark' => 'Oscuro',
					'auto' => 'Sincronizar con la computadora',
				],
				'information' => [
					'title' => 'Información Secreta',
					'secret' => [
						'label' => 'Clave Secreta',
						'tooltip' => [
							'copy' => 'Copiar Clave Secreta',
							'refresh' => 'Regenerar Clave Secreta',
						],
						'placeholder' => 'Clave Secreta',
					],
					'token' => [
						'label' => 'Token',
						'tooltip' => 'Copiar Token',
						'placeholder' => 'Clave de Token',
					],
					'note' => '<b class="text-danger">NOTA:</b> Nunca compartas la clave secreta. Simplemente colócala en el software de nuestros servicios.',
				],
				'update_password' => [
					'title' => 'Actualizar Contraseña',
					'button' => 'Cambiar',
					'current' => [
						'label' => 'Contraseña Actual',
						'placeholder' => '',
					],
					'new' => [
						'label' => 'Nueva Contraseña',
						'placeholder' => '',
					],
					'confirm' => [
						'label' => 'Confirmar Contraseña',
						'placeholder' => '',
					],
					'note' => '<b class="text-danger">NOTA:</b> Nunca compartas la clave secreta. Simplemente colócala en el software de nuestros servicios.',
				],
				'change_email' => [
					'title' => 'Actualizar Correo Electrónico',
					'button' => 'Confirmar',
					'new' => [
						'label' => 'Nuevo Correo Electrónico',
						'placeholder' => '',
					],
					'confirm' => [
						'label' => 'Código de Confirmación',
						'placeholder' => '',
					],
					'note' => '<b class="text-danger">NOTA:</b> Una vez enviado, revisa tu bandeja de entrada de correo electrónico, así como tu bandeja de spam.',
				],
			],
		],
	],
	
	'download' => [
		'header' => [
			'name' => 'Descargas',
			'icon' => 'cloud-download',
		], 
		'content' => [
			'title' => 'Resumen',
			'subtitle' => 'Gestionar Descargas',
			'buttons' => [
				'download' => 'Descargar',
			],
			'table' => [
				'id' => '#',
				'user' => 'Usuario',
				'file' => 'Archivo',
				'code' => 'Código',
				'since' => 'Desde',
			],
		],
	],

	'basket' => [
		'header' => [
			'name' => 'Cesta',
			'icon' => 'basket',
		],
		'content' => [
			'title' => 'Resumen',
			'subtitle' => 'Mi Cesta',
			'button' => 'Ir a Pagar',
			'remove' => 'Quitar de la Cesta',
			'auth' => [
				'description' => 'Debemos validar tu cuenta de discord con tebex para poder comenzar la compra.',
				'button' => 'Autenticarme',
			],
			'payments' => [
				'title' => 'Pago completado',
				'subtitle' => '¡Gracias por tu compra!',
				'list' => 'Artículos comprados:',
				'note' => 'Todos tus artículos para descargar podras encontrarlo en \'descargas\' o tus llaves en \'licencias\'',
			],
		],
	],
	
	'session' => [
		'expire' => '<h4><i class="text-warning fa fa-warning"></i> Tu sesión ha expirado. Por favor, comienza de nuevo.</h4>',
		'alert' => [
			'type' => 'error',
			'title' => 'Sesión expirada',
			'subtitle' => 'Tu sesión ha expirado. Por favor, comienza de nuevo.',
		],
	],
	'error' => [
		'without_permission' => [
			'type' => 'error',
			'title' => 'Sin Permisos.',
			'subtitle' => 'No tienes permiso para ejecutar esta acción.',
		],
		'empty' => [
			'type' => 'error',
			'title' => '¡Ohh, hay problemas!',
			'subtitle' => 'Se han producido problemas. ¡Inténtalo de nuevo!',
		],
		'tebex_empty' => [
			'type' => 'error',
			'title' => 'ID de producto de Tebex',
			'subtitle' => 'El ID del producto es necesario para las compras. En cualquier caso, simplemente desactívalo.',
		],
		'not_group_on_db' => '<i class="fa fa-xmark"></i> No hay ningún grupo.',
		'not_results_on_db' => '<i class="fa fa-xmark"></i> No hay resultados.',
		'user_unknown' => 'No hay usuario registrado.',
	],
    'filters' => [
        'search' => 'Buscar..',
        'showing' => 'Mostrando :compag_to: a :end: de :results: entradas',
        'unknown' => 'Desconocido',
    ],
    'counttime' => [
		'ago-type' => 2, // 1: Hace 20 días / 2: 20 días atrás
		'ago' => 'hace',
        'years' => 'Años', // years or Years (ejemplo: Desde hace 12 años / Desde hace 12 años)
        'year' => 'Año', // year or Year (ejemplo: Desde hace 1 año / Desde hace 1 año)
        'months' => 'Meses',
        'month' => 'Mes',
        'days' => 'Días',
        'day' => 'Día',
        'hours' => 'Horas',
        'hour' => 'Hora',
        'minutes' => 'Minutos',
        'minute' => 'Minuto',
        'seconds' => 'Segundos',
        'second' => 'Segundo',
        'separator' => 'y', // 27d, 15mins "y" 30 secs
    ],
	'months' => [
		'low' => [
			'jan' => 'Ene',
			'feb' => 'Feb',
			'mar' => 'Mar',
			'apr' => 'Abr',
			'may' => 'May',
			'jul' => 'Jul',
			'jun' => 'Jun',
			'aug' => 'Ago',
			'sep' => 'Sep',
			'oct' => 'Oct',
			'nov' => 'Nov',
			'dec' => 'Dic',
		],
		'complete' => [
			'jan' => 'Enero',
			'feb' => 'Febrero',
			'mar' => 'Marzo',
			'apr' => 'Abril',
			'may' => 'Mayo',
			'jun' => 'Junio',
			'jul' => 'Julio',
			'aug' => 'Agosto',
			'sep' => 'Septiembre',
			'oct' => 'Octubre',
			'nov' => 'Noviembre',
			'dec' => 'Diciembre',
		],
	],
];


?>