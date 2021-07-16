<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Summernote</title>

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

</head>
<body>
 <form method="POST">
 	 <textarea name="content" id="summernote"><p>Hello Summernote</p></textarea>
  <button type="submit">SIMPAN</button>
 </form>
  <script>
    $(document).ready(function() {
        $('#summernote').summernote();

        $("#simpan").click(function(e){
        	e.preventDefault();
        	// alert('ahaha');

        	var data = $('#summernote').summernote('code');
        	console.log(data);
        })


        // responsiveVoice.speak("Sukanda Djaya","Indonesian Male");
    });
  </script>
</body>


</html> -->

<?php

 //$url is the same as the link above
    // persiapkan curl
    $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, "https://www.petanikode.com/");

    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 

    // tutup curl 
    curl_close($ch);      

    // menampilkan hasil curl
    echo $output;
?>