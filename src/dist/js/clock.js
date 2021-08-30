$(document).ready(function() {
var monthNames = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]; 
var dayNames= ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"]

var newDate = new Date();
newDate.setDate(newDate.getDate());
$('.datemk').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

setInterval( function() {
	var seconds = new Date().getSeconds();
	$(".secmk").html(( seconds < 10 ? "0" : "" ) + seconds);
	},1000);
	
setInterval( function() {
	var minutes = new Date().getMinutes();
	$(".minmk").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);
	
setInterval( function() {
	var hours = new Date().getHours();
	$(".hoursmk").html(( hours < 10 ? "0" : "" ) + hours);
    }, 1000);	
});
