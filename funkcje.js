var tekst="";
$('.datepicker').datetimepicker();
function Pisz(litera)
{
	tekst+=litera;
	$('#ekran').val(tekst);
}
function Send()
{
	tekst="";
	$('#ekran').val(tekst);
}
function Zegar()
{
	var data = new Date();
	
	if(data.getHours()<10)var godzina = "0"+data.getHours();
	else var godzina = data.getHours();
	
	if(data.getMinutes()<10)var minuta = "0"+data.getMinutes();
	else var minuta = data.getMinutes();
	
	if(data.getSeconds()<10)var sekunda = "0"+data.getSeconds();
	else var sekunda = data.getSeconds();
	
	$('#clock').html(godzina+":"+minuta+":"+sekunda);
	setTimeout("Zegar()", 1000);
}














