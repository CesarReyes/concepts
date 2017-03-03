angular.module('app', [])
	.controller('agenda', function($scope,$http) {
	
    $scope.bloques = {}
    $scope.citas = {
			lunes: [
					{nombre: 'Daniel', hora_inicio: '08:00', hora_termino: '09:00'},
					{nombre: 'Daniel', hora_inicio: '09:30', hora_termino: '11:00'},
					{nombre: 'Daniel', hora_inicio: '15:00', hora_termino: '16:00'},
					{nombre: 'Daniel', hora_inicio: '17:00', hora_termino: '19:30'}
				],
			martes: [
					{nombre: 'Daniel', hora_inicio: '08:00', hora_termino: '09:00'},
					{nombre: 'Daniel', hora_inicio: '11:30', hora_termino: '12:00'},
					{nombre: 'Daniel', hora_inicio: '15:00', hora_termino: '16:00'},
					{nombre: 'Daniel', hora_inicio: '17:00', hora_termino: '19:30'}
				],
			miercoles: [
					{nombre: 'Daniel', hora_inicio: '08:00', hora_termino: '09:00'},
					{nombre: 'Daniel', hora_inicio: '10:30', hora_termino: '12:00'},
					{nombre: 'Daniel', hora_inicio: '15:00', hora_termino: '16:00'},
					{nombre: 'Daniel', hora_inicio: '17:00', hora_termino: '19:30'}
				],
			jueves: [
					{nombre: 'Daniel', hora_inicio: '08:00', hora_termino: '09:00'},
					{nombre: 'Daniel', hora_inicio: '09:30', hora_termino: '12:00'},
					{nombre: 'Daniel', hora_inicio: '15:00', hora_termino: '16:00'},
					{nombre: 'Daniel', hora_inicio: '17:00', hora_termino: '19:30'}
				],
			viernes: [
					{nombre: 'Daniel', hora_inicio: '08:00', hora_termino: '09:00'},
					{nombre: 'Daniel', hora_inicio: '09:30', hora_termino: '12:00'},
					{nombre: 'Daniel', hora_inicio: '15:00', hora_termino: '16:00'},
					{nombre: 'Daniel', hora_inicio: '17:00', hora_termino: '19:30'}
				]
		}

	$scope.creaCitas = function(){
		for (var dia in $scope.citas){
			var citasDia = $scope.citas[dia];
			for(var i=0;i<citasDia.length;i++){
				var cita = citasDia[i];
				var horas = cualesBloques(cita.hora_inicio, cita.hora_termino)
				angular.forEach(horas, function(hora) {
					$scope.bloques[hora][dia].texto = cita.nombre
					$scope.bloques[hora][dia].clase = 'ocupado'
				});
			}
		}
	}
	
	$scope.generarBloques = function(){
		var x = 30; 
		var tt = 0; 
	
		for (var i=0;tt<24*60; i++) {
		  var hh = Math.floor(tt/60);
		  var mm = (tt%60);
		  var hora = ("0" + hh).slice(-2) + ':' + ("0" + mm).slice(-2)
		  //$scope.horas.push(hora)
		  $scope.bloques[hora] = 
			{
				hora: hora,
				lunes: {texto:null, clase:null},
				martes: {texto:null, clase:null},
				miercoles: {texto:null, clase:null},
				jueves: {texto:null, clase:null},
				viernes: {texto:null, clase:null},
				sabado: {texto:null, clase:null},
				domingo: {texto:null, clase:null}
			}
		  
		  tt = tt + x;
		}

	}
    
   
    
	$scope.generarBloques();
	$scope.creaCitas();
	
    
  });
  
var cualesBloques = function(ini, fin){
	
	var bloques = []
	var hIni = ini.split(':');
	var hFin = fin.split(':');
	
	var mIni  = parseFloat(hIni[0])*60 + parseFloat(hIni[1]);
	var mFin  = parseFloat(hFin[0])*60 + parseFloat(hFin[1]);
	var iteraciones = (mFin - mIni) / 30;
	
	for(mIni; mIni<mFin; mIni+=30){
		var hh = Math.floor( mIni / 60);          
		var mm = mIni % 60;
    
		var hora = ("0" + hh).slice(-2) + ':' + ("0" + mm).slice(-2)
		bloques.push(hora);
	}
	
	return bloques;
	
}
