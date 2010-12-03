<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
  <title>Links interessants</title>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" ></script>
  <link rel="stylesheet" type="text/css" href="css/estil.css">
  <style type="text/css">
    
  </style>
  <script type="text/javascript">
      $(document).ready(function() {
        $('#show-form').click(function () {
          $('#lightbox').fadeTo('slow', 0.6, function() {
              $('#form-login').slideDown('slow', function() { $('#user').focus(); });
              $('#form-error').hide();
           });
         });

        $('#cancel').click(function () {
          $('#form-login').slideUp('slow', function() {
              $('#lightbox').fadeTo('slow', 0, function(){ $('#lightbox').hide()});
            });
        });

        $('#submit').click(function() {
          $('#form-error').hide();
          $('#submit').hide();
          $.ajax({
              type: 'POST',
              url: 'login.php',
              data: 'user=' + $('#user').val() + '&password=' + $('#password').val(),
              dataType: 'json',
              success: function (data){
                if (data.status == -1) {
                  $('#form-error').html(data.msg).slideDown('slow');
                }
                else if(data.status == 0) {
                  window.location.replace(data.url);
                }
                $('#submit').show();
              },
              error: function (XMLHttpRequest, textStatus, errorThrown) {
                $('#form-error').html("XMLHttpRequest="+XMLHttpRequest.responseText+"\ntextStatus="+textStatus+"\nerrorThrown="+errorThrown);
                $('#submit').show();
              }
          });
          return false;
        });

      });

  </script>
</head>
<body>
<div id="form-login">
  <form action="login.php" method="post">
    <fieldset>
      <legend>Entra les credencials</legend>
      <div id="form-error"></div>
      <div class="form-row1">
        <label for="user" class="required">Usuari:</label>
        <input name="user" type="text" id="user" maxlength="50" />
      </div>
      <div class="form-row2">
        <label for="password" class="required">Password:</label>
        <input type="password" name="password" id="password" maxlength="50">
      </div>
      <div class="form-row2 text-right" style="margin-right: 3px;">
        <!-- <span id="loading" class="submit-button"><img src="img/loaderb16.gif" alt="loading..." height="16" width="16" ></span> -->
        <input id="loading" class="submit-button" type="image"  src="img/loaderb16.gif" alt="loading..." height="16" width="16" >
        <input id="submit"  class="submit-button" type="submit" name="enviar" value="Enviar" >
        <input id="cancel"  class="submit-button" type="button" value="Cancelar" >
      </div>
    </fieldset>
  </form>
</div>
<div id="lightbox">&nbsp;</div>
<h1>Enllaços interessants relacionats amb TIC / TAC</h1>
<h5 class="text-right"><a id="show-form" href="#">Editar</a></h5>
<?php require('element_list.php'); ?>
</body>
</html>
