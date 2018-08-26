<?php
//test
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
    <!-- Meta -->
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css" />
    <!-- JavaScript -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.leanModal.min.js"></script>
    <script type="text/javascript" src="assets/js/sweetalert.min.js"></script>
  </head>
  <body>
    <?php include 'template/main_content.php'; ?>
  </body>
</html>
<script type="text/javascript" src="assets/js/modal.js"></script>
<script type="text/javascript" src="assets/js/map-icons.min.js"></script>
<link rel="stylesheet" href="assets/css/map-icons.min.css" />
