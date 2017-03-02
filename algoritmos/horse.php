#!/usr/bin/env php

<?php

class horse{
	
	var $num_rows;
	var $num_cols;
	var $board = [];
	var $counter = 0;
	
	function __construct($rows, $cols){
		$this->num_rows = $rows;
		$this->num_cols = $cols;
		
		//Initializing the board
		$this->board = array_fill(0, $rows, array_fill(0, $cols, NULL));
		
		//var_dump($this->board);die();
	}
	
	function solve($row, $col, $num=1) {
		$this->counter++;
		$this->board[$row][$col] = $num;
		if($num == ($this->num_rows * $this->num_cols))
			return true;
			
		$likely = $this->likely($row, $col);
		$likely = $this->sort($likely);
		
		//var_dump($likely);die();
		for($i=0; $i < count($likely); $i++) {
			if($this->solve($likely[$i][0], $likely[$i][1], $num + 1)) 
				return true;
		}
		$this->board[$row][$col]=0;
			return false;
	}
	
	function likely($row, $col) {
        $ans = [];
        $pos  = 0;
        
        //Evaluate each possible box from the start point
        if($this->is_valid($row-2,$col-1)){ $ans[$pos][0] = $row-2; $ans[$pos++][1] = $col-1; }
        if($this->is_valid($row-2,$col+1)){ $ans[$pos][0] = $row-2; $ans[$pos++][1] = $col+1; }
        if($this->is_valid($row-1,$col-2)){ $ans[$pos][0] = $row-1; $ans[$pos++][1] = $col-2; }
        if($this->is_valid($row-1,$col+2)){ $ans[$pos][0] = $row-1; $ans[$pos++][1] = $col+2; }
        if($this->is_valid($row+2,$col-1)){ $ans[$pos][0] = $row+2; $ans[$pos++][1] = $col-1; }
        if($this->is_valid($row+2,$col+1)){ $ans[$pos][0] = $row+2; $ans[$pos++][1] = $col+1; }
        if($this->is_valid($row+1,$col-2)){ $ans[$pos][0] = $row+1; $ans[$pos++][1] = $col-2; }
        if($this->is_valid($row+1,$col+2)){ $ans[$pos][0] = $row+1; $ans[$pos++][1] = $col+2; }
        
        $tmp = [];
        for($i = 0; $i < $pos; $i++) { 
			$tmp[$i][0] = $ans[$i][0]; 
			$tmp[$i][1] = $ans[$i][1]; 
		}
        
        return $ans;
    }
	
	//Sorting the likely to get thoose that has less possible solutions
	function sort($likely) {
		for($i=0; $i < count($likely); $i++) {
			for($j = $i+1; $j < count($likely); $j++) {
				$likely_i = count($this->likely($likely[$i][0], $likely[$i][1]));
				$likely_j = count($this->likely($likely[$j][0], $likely[$j][1]));
				if($likely_j < $likely_i) {
					$tmp0 = $likely[$i][0];
					$likely[$i][0] = $likely[$j][0];
					$likely[$j][0] = $tmp0;
					$tmp1 = $likely[$i][1];
					$likely[$i][1] = $likely[$j][1];
					$likely[$j][1] = $tmp1;
				}
			}
		}
		return $likely;
	}
	
	function is_valid($row, $col) {
        if($row < 0 || $row > $this->num_rows-1 || $col < 0 || $col > $this->num_cols-1) 
			return false;
        
        if($this->board[$row][$col] != 0) 
			return false;
			
        return true;
    }
    
    function show() {
        for($i=0; $i < count($this->board); $i++) {
            for($j=0; $j < count($this->board[$i]); $j++) {
                printf("  %2d  |", $this->board[$i][$j]);
            }
            echo "\n";
            
            for($j=0; $j < count($this->board[$i]); $j++) 
				echo "------+";
            
            echo "\n";
        }
    }
	
}


if(!isset($argv[1]) ) die("Hey! I need the size of board, Usage: horse.php {num_rows}x{num_cols}\n");
$param = explode('x', strtolower($argv[1]));

$rows = (int)$param[0];
$cols = (int)$param[1];

$caballo = new horse($rows, $cols);
$caballo->solve(0,0);
$caballo->show();

printf("Amount of movements: %d",  $caballo->counter);

echo "\n";

