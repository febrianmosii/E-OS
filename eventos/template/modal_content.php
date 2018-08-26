<?php
	$data_event_types = $request->get_event_type(); 
?>
<a id="modal_trigger_content" href="#modal-content" class="btn" style="display: none;">Content</a>
<div id="modal-content" class="popupContainer" style="display:none; width: 700px !important; left: 37% !important;">
  <header class="popupHeader">
    <span class="header_title">Content Type</span>
    <span class="modal_close"><i class="fa fa-times"></i></span>
  </header>
  
  <section class="popupBody">
    <form method="post" id="form-content">
      <div class="row form-group">
          <div class="col-md-3">
            <label class="control-label">Latitude</label>
          </div>
          <div class="col-md-9">
            <input type="text" name="latitude" id="latitude" class="form-control" readonly="readonly">
          </div>
      </div>
      <div class="row form-group">
          <div class="col-md-3">
            <label class="control-label">Longitude</label>
          </div>
          <div class="col-md-9">
            <input type="text" name="longitude" id="longitude" class="form-control" readonly="readonly">
          </div>
      </div>
      <div class="row form-group">
          <div class="col-md-3">
            <label class="control-label">Event Type</label>
          </div>
          <div class="col-md-9">
              <select id="id_event" name="id_event_type" class="form-control">
                <?php while($row = mysql_fetch_array($data_event_types, MYSQL_ASSOC)) { ?>
                  <option value="<?= $row['id_event_type'] ?>"> <?= $row['name']?></option>
                <?php }?>
              </select>
          </div>
      </div>
      <div class="row form-group">
          <div class="col-md-3">
            <label class="control-label">Name</label>
          </div>
          <div class="col-md-9">
            <input type="text" name="name" id="name" class="form-control">
          </div>
      </div>
      <div class="row form-group">
          <div class="col-md-3">
            <label class="control-label">Description</label>
          </div>
          <div class="col-md-9">
            <textarea type="text" name="description" id="description" class="form-control"></textarea>
          </div>
      </div>
      <div class="row form-group price" style="display: none;">
          <div class="col-md-3">
            <label class="control-label">Price</label>
          </div>
        	<div class="col-md-9">
            <input type="text" name="price" id="price" class="form-control">
      		</div>
      </div>
      <div class="row text-right">
        <div class="col-md-12">
          <a class="btn btn-primary" style="color: #fff;" id="save-content">Save</a>
        </div>
      </div>
    </form>
  </section>
</div>
<script>
  $(document).on('change', '#id_event', function() {
    var val = $(this).val();
    if (val == 3 || val == 4) {
      $('#price').val('');
      $('.price').slideDown();
    } else {
      $('#price').val('');
      $('.price').slideUp();
    }
  });
</script>