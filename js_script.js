jQuery( document ).ready(function() {
  // Handler for .ready() called.
 
 $('.addbtn').click(function(){
/*  alert('Вы нажали на элемент "foo"');*/
  	var clone = jQuery('.prod:last').clone(true);
	 $( "#cont" ).append(clone);
	var a=$('[name*="Quantity"]:last').attr("name")+"1";
	$('[name*="Quantity"]:last').attr("name",a);
	var b=$('[name*="Product"]:last').attr("name")+"1";
	$('[name*="Product"]:last').attr("name",b);	
}); 
  
$('#mainform').submit(function()
{
    dataString = $("#mainform").serialize();
    $.ajax(
		{
			type: "POST",
			url: purl+"/orderform/ajax_form_processing.php",
			data: dataString,
			success: function(data){$('#output').html(data);} 
           
        });       
		
    return false; // return false to prevent typical submit behavior
   
});

  
  
  
});

