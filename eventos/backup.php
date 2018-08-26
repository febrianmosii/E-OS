<?php
  session_start();
  require_once 'includes/Requests.php';
  require_once 'includes/Fb_config.php';
  require_once 'includes/Fb_session.php';
  $request = new Requests();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Eventos Events</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <!-- JavaScript -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript"src="http://maps.google.com/maps?file=api&v=2&sensor=false&key=ABQIAAAA8G9ZUehlmgHFYSk0eHkvMxSMGSzrQzuxP9i0yI8OwKXwu_vyNhQuc40vTW0co5ModYSrK6lCkwof0Q&callback=asdsad"></script>
    <script type="text/javascript" src="assets/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.leanModal.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css" />
    <script type="text/javascript">
      $(document).ready(function() {
        function initialize() {
          var mapDiv = document.getElementById('map');
          var myOptions = {
            zoom: 12,
            center: new google.maps.LatLng(41.850033, -87.6500523),
            fullscreenControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          }
          var map = new google.maps.Map(mapDiv, myOptions);

          addDropDown(map);

          google.maps.event.addListener(map, 'click', function( event ){
            var latitude  = event.latLng.lat();
            var longitude = event.latLng.lng();
            var placeId   = event.placeId;
            var session   = "<?= $_SESSION['email'] ?>";

            if ( ! placeId) 
            {
              if (session) 
              {
                $('#latitude').val(latitude);
                $('#longitude').val(longitude);

                swal({
                  title: "Tambah Event?",
                  text: "Latitude: " + latitude + " , Longitude: " + longitude,
                  icon: "info",
                  customClass: 'swal-wide',
                  buttons: true,
                  dangerMode: false,
                })
                .then((willDelete) => {
                  if (willDelete) {
                      $('#modal_trigger_content').trigger('click');
                  }
                });
              }
            }
          });
        }

        function addDropDown(map) {
          var dropdown = document.getElementById('dropdown-holder');
          map.controls[google.maps.ControlPosition.TOP_RIGHT].push(dropdown);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
      });
    </script>
  </head>
  <body>
    <?php include 'template/main_content.php'; ?>
  </body>
</html>
<script type="text/javascript" src="assets/js/modal.js"></script>
