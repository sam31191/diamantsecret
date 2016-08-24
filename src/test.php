<!DOCTYPE html>
<html>
 
<head>   
 
<!-- 1 -->
<link href="css/dropzone.min.css" type="text/css" rel="stylesheet" />
 
<!-- 2 -->
<script src="js/dropzone.min.js"></script>
 
</head>
 
<body>
 
<!-- 3 -->
<div class="dropzone" id="dropzone"> Dropzone </div>
</body>
<script>
	var myDZ = new Dropzone("#dropzone", { url: "/gfx",
	paramName: "files", // The name that will be used to transfer the file
  	maxFilesize: 2, // MB
  	accept: function(file, done) {
		if (file.name == "justinbieber.jpg") {
		  done("Naha, you don't.");
		}
    	else { done(); }
	} 
	});
	
	
</script>
</html>