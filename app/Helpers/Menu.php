<?php
	class Menu{

	public static function navbarsideleft(){
		return [
		[
			'path' => 'home',
			'label' => "Home",
			'icon' => '<i class="material-icons mi-sd">home</i>'
		],

		[
			'path' => 'home',
			'label' => "gestion pqrs",
			'icon' => '<i class=" material-icons mi-sd">menu</i>',
'submenu' => [
		[
			'path' => 'pqrsregpqrs',
			'label' => "pqrs",
			'icon' => '<i class="material-icons mi-sd">work</i>'
		],

		[
			'path' => 'pqrspet',
			'label' => "peticionarios",
			'icon' => '<i class="material-icons mi-sd">people_outline</i>'
		],

		[
			'path' => 'pqrsrespu',
			'label' => "respuestas",
			'icon' => '<i class="material-icons mi-sd">assignment</i>'
		],

		[
			'path' => 'pqrsregpqrs/pqrs_sin_asignar',
			'label' => "sin asignar",
			'icon' => '<i class="material-icons mi-sd">assignment</i>'
		],

		[
			'path' => 'pqrsregpqrs/pqrs_asignados',
			'label' => "asignados",
			'icon' => '<i class="material-icons mi-sd">assignment</i>'
		],

		[
			'path' => 'pqrsregpqrs/pqrs_respond',
			'label' => "respondidas",
			'icon' => '<i class="material-icons mi-sd">assignment</i>'
		],

		[
			'path' => 'pqrsregpqrs/list_pqrs_total_cont_',
			'label' => "total pqrs",
			'icon' => '<i class="material-icons mi-sm">disc_full</i>'
		]
	]
		],

		[
			'path' => 'home',
			'label' => "config pqrs",
			'icon' => '<i class="material-icons mi-sd">brightness_7</i>',
'submenu' => [
		[
			'path' => 'pqrstipdoc',
			'label' => "tipdoc",
			'icon' => ''
		],

		[
			'path' => 'pqrstipsol',
			'label' => "tipsol",
			'icon' => ''
		],

		[
			'path' => 'pqrscarg',
			'label' => "cargos",
			'icon' => ''
		],

		[
			'path' => 'pqrsmun',
			'label' => "municipios",
			'icon' => ''
		],

		[
			'path' => 'pqrsrespon',
			'label' => "funcionarios",
			'icon' => ''
		],

		[
			'path' => 'pqrsent',
			'label' => "entidades",
			'icon' => ''
		],

		[
			'path' => 'pqrstipent',
			'label' => "tipo entidad",
			'icon' => ''
		]
	]
		],

		[
			'path' => 'home',
			'label' => "config app",
			'icon' => '<i class="material-icons mi-sd">brightness_7</i>',
'submenu' => [
		[
			'path' => 'roles',
			'label' => "Roles",
			'icon' => '<i class="material-icons">extension</i>'
		],

		[
			'path' => 'user',
			'label' => "User",
			'icon' => '<i class="material-icons">extension</i>'
		],

		[
			'path' => 'permissions',
			'label' => "Permissions",
			'icon' => '<i class="material-icons">extension</i>'
		]
	]
		],

		[
			'path' => 'detalleven',
			'label' => "Detalle Ven",
			'icon' => '<i class="material-icons">extension</i>'
		]
	] ;
	}


	public static function tipEntAsig(){
		return [
		[
			'value' => '3',
			'label' => "Oficina Interna",
		],] ;
	}

	public static function medioSol(){
		return [
		[
			'value' => 'FISICO',
			'label' => "FISICO",
		],
		[
			'value' => 'EMAIL',
			'label' => "EMAIL",
		],] ;
	}

	public static function regsolDias(){
		return [
		[
			'value' => '0',
			'label' => "0",
		],
		[
			'value' => '1',
			'label' => "1",
		],
		[
			'value' => '2',
			'label' => "2",
		],
		[
			'value' => '3',
			'label' => "3",
		],
		[
			'value' => '4',
			'label' => "4",
		],
		[
			'value' => '5',
			'label' => "5",
		],
		[
			'value' => '6',
			'label' => "6",
		],
		[
			'value' => '7',
			'label' => "7",
		],
		[
			'value' => '8',
			'label' => "8",
		],
		[
			'value' => '9',
			'label' => "9",
		],
		[
			'value' => '10',
			'label' => "10",
		],
		[
			'value' => '11',
			'label' => "11",
		],
		[
			'value' => '12',
			'label' => "12",
		],
		[
			'value' => '13',
			'label' => "13",
		],
		[
			'value' => '14',
			'label' => "14",
		],
		[
			'value' => '15',
			'label' => "15",
		],
		[
			'value' => '16',
			'label' => "16",
		],
		[
			'value' => '17',
			'label' => "17",
		],
		[
			'value' => '18',
			'label' => "18",
		],
		[
			'value' => '19',
			'label' => "19",
		],
		[
			'value' => '20',
			'label' => "20",
		],
		[
			'value' => '21',
			'label' => "21",
		],
		[
			'value' => '22',
			'label' => "22",
		],
		[
			'value' => '23',
			'label' => "23",
		],
		[
			'value' => '24',
			'label' => "24",
		],
		[
			'value' => '25',
			'label' => "25",
		],] ;
	}

	}
