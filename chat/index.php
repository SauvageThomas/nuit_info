<?php
session_start ();
?>

<?php
// unset($_SESSION ['login']);
if (isset ( $_POST ['login'] )) {
	$_SESSION ['login'] = $_POST ['login'];
}
if (! isset ( $_SESSION ['login'] )) {
	?>
<form method='POST'>
	Login <input type="text" name='login'><br /> <input type="submit"
		value='Valider'>
</form>
<?php
} else {
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Chat</title>

<link rel="stylesheet" href="style.css" type="text/css" />

<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="chat.js"></script>
<script type="text/javascript">

var chat =  new Chat();
		
        // ask user for name with popup prompt    
        var name = '<?php echo $_SESSION ['login']; ?>';
        
        // default name is 'Guest'
    	if (!name || name === ' ') {
    	   name = "Guest";	
    	}
    	
    	// strip tags
    	name = name.replace(/(<([^>]+)>)/ig,"");
    	
    	// display name on page
    	$("#name-area").html("You are: <span>" + name + "</span>");
    	
    	// kick off chat
        
    	$(function() {
    	
    		 chat.getState(); 
    		 
    		 // watch textarea for key presses
             $("#sendie").keydown(function(event) {  
             
                 var key = event.which;  
           
                 //all keys including return.  
                 if (key >= 33) {
                   
                     var maxLength = $(this).attr("maxlength");  
                     var length = this.value.length;  
                     
                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {  
                         event.preventDefault();  
                     }  
                  }  
    		 																																																});
    		 // watch textarea for release of key press
    		 $('#sendie').keyup(function(e) {	
    		 					 
    			  if (e.keyCode == 13) { 
    			  
                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
                     
    			        chat.send(text, name);	
    			        $(this).val("");
    			        
                    } else {
                    
    					$(this).val(text.substring(0, maxLength));
    					
    				}	
    				
    				
    			  }
             });
            
    	});
    </script>

</head>

<body onload="setInterval('chat.update()', 1000)">





	<div id="page-wrap">

		<h2>jQuery/PHP Chat</h2>

		<p id="name-area"></p>

		<div id="chat-wrap">
			<div id="chat-area"></div>
		</div>

		<form id="send-message-area">
			<p>Your message:</p>
			<textarea id="sendie" maxlength='100'></textarea>
		</form>

	</div>
	<?php
}
?>
</body>

</html>