<?php
  $data_list = $request->get_newest_update(); 
?>
<div id="map"></div>
<div id="dropdown-holder" style="width: 20% !important;">
  <div class="button-selected"><label id="newest-title">Newest Update</label></div>
  <div class="dropdown">
     <?php while($row = mysql_fetch_array($data_list, MYSQL_ASSOC)) { ?>
      <div class="row dropdown-list">
        <div class="col-md-6"><?=$row['name']?></div>
        <div class="col-md-6 text-right"><?=$row['tipe']?></div>
      </div>
    <?php }?>
  </div>
</div>
<?php if ( ! $_SESSION['id_auth_user']) {?>
  <!-- Modal Login -->
  <?php include 'template/modal_login.php' ?>
<?php } else { ?>
  <!-- Modal Add Content -->
  <?php include 'template/modal_content.php' ?>
  <a id="modal_trigger" class="btn logout hand">Sign Out</a>
<?php } ?>
<script>
  var customLabel = {
    restaurant: {
      label: 'R'
    },
    bar: {
      label: 'B'
    }
  };


  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: new google.maps.LatLng(-2.5489, 118.0149),
      zoom: 5
    });
    var infoWindow = new google.maps.InfoWindow;
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

    // Change this depending on the name of your PHP or XML file
    downloadUrl('load_marker.php', function(data) {
      var xml = data.responseXML;
      var markers = xml.documentElement.getElementsByTagName('marker');
      Array.prototype.forEach.call(markers, function(markerElem) {
        var id = markerElem.getAttribute('id');
        var name = markerElem.getAttribute('name');
        var desc = markerElem.getAttribute('desc');
        var type = markerElem.getAttribute('type');
        var point = new google.maps.LatLng(
            parseFloat(markerElem.getAttribute('lat')),
            parseFloat(markerElem.getAttribute('lng')));

        var infowincontent = document.createElement('div');
        var strong = document.createElement('strong');
        strong.textContent = name
        infowincontent.appendChild(strong);
        infowincontent.appendChild(document.createElement('br'));

        var text = document.createElement('text');
        text.textContent = desc
        infowincontent.appendChild(text);
        
        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        var icons = {
          default: {
            icon: iconBase + 'info-i_maps.png'
          },
          parking: {
            icon: 'https://png.icons8.com/color/50/000000/google-play-music.png'
          },
          library: {
            icon: iconBase + 'library_maps.png'
          },
          info: {
            icon: iconBase + 'info-i_maps.png'
          }
        };

        // var icon = customLabel[type] || {};
        var marker = new google.maps.Marker({
          map: map,
          position: point,
           icon: icons['parking'].icon,
          map_icon_label: '<span class="map-icon map-icon-painter"></span>'
          // label: icon.label
        });
        marker.addListener('click', function() {
          infoWindow.setContent(infowincontent);
          infoWindow.open(map, marker);
        });
      });
    });
  }

  function addDropDown(map) {
    var dropdown = document.getElementById('dropdown-holder');
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(dropdown);
  }

  function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
      if (request.readyState == 4) {
        request.onreadystatechange = doNothing;
        callback(request, request.status);
      }
    };

    request.open('GET', url, true);
    request.send(null);
  }

  function doNothing() {}
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAT7ygNsrnlP0FQ1zlR_Nj-wyeVcjvCN1w&callback=initMap">
</script>