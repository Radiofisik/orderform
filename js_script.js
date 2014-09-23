jQuery(function ($) {
jQuery( document ).ready(function() {
 
 $('.addbtn').click(function(){
  //	var clone = jQuery('.prod:last').clone(true);
	var clone=$($(this).parents().get(3)).clone(true); 
	 $( "#cont" ).append(clone);
	itemenum();
}); 
  
  
 $('.delbtn').click(function(){
//delete item if it is not last
	 if($('.prod').length>1) $(this).parents().get(3).remove();
	 else alert("Последний остался, жалко удалять...");
//because user can delete any item, after deletion was made we should reenumerate names of rest items
	itemenum();
 }); 
 
$('#mainform').submit(function()
{
    dataString = $(this).serialize();
    $.ajax(
		{
			type: "POST",
			url: purl+"/orderform/ajax_form_processing.php",
			data: dataString,
			success: function(data){$('#output').html(data);} 
           
        });       
		
    return false; // return false to prevent typical submit behavior
   
});

  
//function makes form fields unique
var itemenum = function ()
{
	var curQname="Quantity";
	var curPname="Product";
	$('.prod').each(function( index ) {
	curQname+="1";
	curPname+="1";
	$(this).find($('[name*="Quantity"]')).attr("name",curQname);
	$(this).find($('[name*="Product"]')).attr("name",curPname);
	});
};
  
});
});

