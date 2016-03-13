<div class="container-fluid">

  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th>#</th>
        <th>image</th>
        <th>pic_name</th>
        <th>big_url</th>
        <th>thumbs_url</th>
        <th>Aktif</th>
        <th>işlem</th>
      </tr>
    </thead>

    <tbody>
  <?php foreach ($pics as $key => $value) { ?>
    <tr><th scope="row"><?php echo $key; ?></th>
      <td><img src="<?php echo URL.$value->thumbs_url; ?>" class="img-rounded" height="150" width="150"></td>
      <td><?php echo $value->pic_name; ?></td>
      <td><?php echo $value->big_url; ?></td>
      <td><?php echo $value->thumbs_url; ?></td>
      <td><?php  if($value->aktif){
        echo "aktif";
      }
      else { echo "pasif"; }
      ?></td>
      <td>
        <button id="edit<?php echo $value->pic_id; ?>" class="btn btn-sm btn-primary" data-toggle="modal" onclick="editModalShow(<?php echo $value->pic_id; ?>)">Düzenle</button>
        <button id="del<?php echo $value->pic_id; ?>" class="btn btn-sm btn-primary ">Sil</button>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="editModalLabel">Düzenle</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid bd-example-row">
          <div class="row">
            <div class="col-md-4" id="img"></div>
            <div class="col-md-7">
                <div class="form-group">
                  <label for="picnameinmodel"><strong>Adı :</strong></label>
                  <input type="name" class="form-control" id="picnameinmodel" placeholder="Adını Girin" />
                </div>
                <div class="form-group">
                  <label for="picsizeinmodel"><strong>Boyutu : </strong></label>
                  <label id="picsizeinmodel" ></label>
                </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-12" >
              <div class="form-group">
                <label for="picbigurlinmodel"><strong>Big Url : </strong></label>
                  <input type="name" class="form-control" id="picbigurlinmodel" placeholder="Url Adresi" />
              </div>
              <div class="form-group">
                <label for="picthmburlinmodel"><strong>Thumb Url : </strong></label>
                <input type="name" class="form-control" id="picthmburlinmodel" placeholder="Url Adresi" />
              </div>
              <div class="checkbox" >
                <label id="picstatuslabelinmodel">
                  <input type="checkbox" id="picstatusinmodel" /> Statü
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="button" class="btn btn-primary" id="savebtn">Kaydet</button>
      </div>
    </div>
  </div>
</div>
<?php
/*$modele = array();
$deger = array_filter($pics,function($obj) {
  if(isset($obj->pic_id)){
    if($obj->pic_id == 1 ) { print_r($obj); return true; }
    return false;
  }
});*/?>
</div>
<script>
function editModalShow(id){
console.log("function editModal çalıştı.");

$.ajax({
  type: "POST",
  url: url + "admin/ajaxGetinfo/"+id,
  dataType: 'json',
  success: function(data){
    $('#editModal #img').html("<img src='"+url+data.thumbs_url+"'class='img-rounded' height='150' width='150'></img>");
    $('#picnameinmodel').val(data.pic_name);
    $('#picsizeinmodel').html(data.size);
    $('#picbigurlinmodel').val(data.big_url);
    $('#picthmburlinmodel').val(data.thumbs_url);
    if(data.aktif == 1){
      $('#picstatusinmodel').prop('checked', true);
    }
    else {
      $('#picstatusinmodel').prop('checked', false);
    }
  },
  error: function(data){
    console.log(data);
  }

});

//


  $('#editModal').modal('show');
}
</script>
