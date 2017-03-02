<?php

class Mazo{

	var $cartas = []; 
	var $barajado = FALSE;

	function __construct(){
		
		$this->_generar_cartas();
	}
	
	private function _generar_cartas(){
		//Genera las 54 cartas y 3 comodines
		//palos -> traboles, diamantes, corazones, picas y dos comodines(Jockers)
		$palos = ['Tréboles', 'Diamantes', 'Corazones', 'Picas'];
		$signos = ['2','3','4','5','6','7','8','9','10','J','Q','K','A'];
		
		foreach($palos as $palo){
			foreach($signos as $signo){
				$carta = new Carta;
				$carta->palo = $palo;
				$carta->signo = $signo;
				$this->cartas[] = $carta;
			}
		}
		
		//Dos Jokers
		$j = new Carta;
		$j->palo = 'JOKER';
		$j->signo = 'JOKER';
		$this->cartas[] = $j;
		$this->cartas[] = $j;
	}
	
	//Cambia aleatoriamente el orden de la cola de cartas
	function barajar(){
		shuffle($this->cartas);
	}
	
	//Extrae una carta de la pila de cartas
	function repartir_carta(){
		return array_shift ( $this->cartas );
	}
	
}


class carta{
	var $palo = NULL; //pintas -> tréboles, diamante, corazones, picas y dos comodines(Jokers)
	var $signo = NULL; //Numero[2-9], J, Q, K, A, No aplica si es comodin
}

$mazo = new mazo();
$mazo->barajar();

var_dump($mazo->repartir_carta());
var_dump($mazo->repartir_carta());
var_dump($mazo->repartir_carta());
