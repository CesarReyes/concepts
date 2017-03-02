<?php

//ORM con CRUD Crear, Leer, Actualizar y Borrar
class curso{
	var $id,
	var $nombre,
	var $profesor_id
	
	var $pruebas;
	
	var $table_name = 'curso';
	var $primary_key = 'id';
	
	function __construct($id = NULL){}
	
	function save(){}
	
	function delete(){}
	
	function update(){}
	
	function agregar_alumno(alumno_curso $alumno_curso){}
	function agregar_prueba(prueba $prueba){}
	
	private function cargar_pruebas(){}
} 

class prueba{
	var $id;
	var $nombre;
	var $curso_id;
	
	var $table_name = 'prueba';
	var $primary_key = 'id';
	
	function __construct($id = NULL){}
	
	function save(){}
	
	function delete(){}
	
	function update(){}
}

class alumno_curso{
	var $id;
	var $alumno_id;
	var $curso_id;
	
	var $table_name = 'alumno_curso';
	var $primary_key = 'id';
	
	function __construct($id = NULL){}
	
	function save(){}
	
	function delete(){}
	
	function update(){}
}

class persona{
	var $id,
	var $nombre
	
	var $table_name;
	var $primary_key;
	
	function __construct($id = NULL){}
	
	function save(){}
	
	function delete(){}
	
	function update(){}
}

class profesor extends persona{
	
	var $cursos;
	 
	function __construct($id = NULL){
		
		$this->table_name = 'profesor';
		$this->primary_key = 'id';
		
		parent::__construct($id);
	}
	
	private function cargar_pruebas(){}
	
} 

class alumno extends persona{
	
	function __construct($id = NULL){
		
		$this->table_name = 'alumno';
		$this->primary_key = 'id';
		
		parent::__construct($id);
	}
	
	function tomar_curso(alumno_curso $alumno_curso){}
	function agreagar_nota(nota $nota){}
	
}

class nota{
	var $id;
	var $prueba_id;
	var $alumno_id;
	var $valor;
	
	var $table_name = 'nota';
	var $primary_key = 'id';
	
	function __construct($id = NULL){}
	
	function save(){}
	
	function delete(){}
	
	function update(){}
}

class prueba{
	var $id;
	var $nombre;
	var $curso_id;
	
	var $table_name = 'prueba';
	var $primary_key = 'id';
	
	function __construct($id = NULL){}
	
	function save(){}
	
	function delete(){}
	
	function update(){}
}
