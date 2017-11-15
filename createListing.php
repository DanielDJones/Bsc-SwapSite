<?php
session_start();
require 'dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['submit'])) {
        require 'createListingBackend.php';
    }
}
?>

<!DOCTYPE html>
  <html>
    <head>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" href="css/style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta charset="UTF-8">
      <title>Login</title>
    </head>

    <body>
      <div class="container">
        <div class="row">
          <div class="col s12">
            <div class="card green darken-1">
              <div class="card-content white-text">
                <div class="row">

 <form role="form" action="createListing.php" method="post" class="col s12">

   <div class="row">
     <div class="input-field col s12">
       <input id="compName" type="text" class="validate" name="compName">
       <label for="compName">Listing Title</label>
     </div>
   </div>
   <div class="row">
     <div class="input-field col s12">
       <input id="compDesc" type="text" class="validate" name="compDesc">
       <label for="compDesc">Component Description</label>
     </div>
   </div>
   <div class="row">
     <div class="input-field col s12">
       <input id="locationTown" type="text" class="validate" name="locationTown">
       <label for="locationTown">Location: Town</label>
     </div>
   </div>
   <div class="row">
     <div class="input-field col s12">
       <input id="locationDetails" type="text" class="validate" name="locationDetails">
       <label for="locationDetails">Location: Details</label>
     </div>
   </div>
   <div class="row">
     <div class="input-field col s12">
       <input id="lookingFor" type="text" class="validate" name="lookingFor">
       <label for="lookingFor">Looking For</label>
     </div>
   </div>
   <div class="row">
     <div class="input-field col s12">
       <select id="cat" name="cat">
       <option value="" disabled selected>Select Catagory</option>
       <optgroup label="Resistors">
          <option value="Res1">10uF</option>
          <option value="Res2">20uF</option>
          <option value="Res3">30uF</option>
        </optgroup>
        <optgroup label="Capacitors">
          <option value="Cap1">10uF</option>
          <option value="Cap2">20uF</option>
          <option value="Cap3">30uF</option>
        </optgroup>
      </select>
      <label for="cat">Catagory</label>
    </div>
   </div>
   <div class="row center">
      <button type="submit" class="btn-large waves-effect waves-light black-text yellow" name="submit" />Submit</button>
   </div>
 </form>
</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
        $(document).ready(function() {
          $('select').material_select();
        });
      </script>
    </body>
  </html>
