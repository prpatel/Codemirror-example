<?php

ini_set('display_errors','1');

define('FILE_NAME', './element_list.php');

session_name("YOUR_SESSION_NAME_HERE");
session_start();

if (!isset($_SESSION['authenticated'])) {
  header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  file_put_contents(FILE_NAME, $_POST['source-code']);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title>Editant pàgina...</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
  
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" ></script>
  <script src="js/codemirror/js/codemirror.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="css/estil.css">

  <style type="text/css">
    .CodeMirror-line-numbers {
      width: 2.2em;
      color: #aaa;
      background-color: #eee;
      text-align: right;
      padding-right: .3em;
      font-size: 10pt;
      font-family: monospace;
      padding-top: .4em;
      line-height: normal;
    }

  </style>
  <script type="text/javascript">
    $(document).ready(function() {
        var logout = function() {
                         window.location.replace('logout.php');
                     };

        $('#exit-top').click(logout);
        $('#exit-bottom').click(logout);
    });
  </script>
</head>
<body>
<form id="edit-form" method="post" action="">
  <div class="form-row1 text-right">
    <input id="Save-top" class="submit-button" type="submit" value="Save">
    <input id="exit-top" class="submit-button" type="button" value="Exit" >
  </div>
  <div style="border-bottom: 2px dashed #AAA; border-top: 2px dashed #AAA">
    <textarea id="code" name="source-code" cols="120" rows="50" style=""><?php echo htmlentities(file_get_contents(FILE_NAME), ENT_COMPAT, 'UTF-8') ?></textarea><br>
  </div>
  <div class="form-row1 text-right">
    <input id="Save-bottom" class="submit-button" type="submit" value="Save">
    <input id="exit-bottom" class="submit-button" type="button" value="Exit" >
  </div>
</form>
<script type="text/javascript">
  var editor = CodeMirror.fromTextArea('code', {
       height: "500px",
       parserfile: "parsexml.js",
       stylesheet: "js/codemirror/css/xmlcolors.css",
       path: "js/codemirror/js/",
       continuousScanning: 500,
       lineNumbers: true
     });
</script>

</body>
</html>
