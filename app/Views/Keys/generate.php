<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <?= $this->include('Layout/msgStatus') ?>
        <?php if (session()->getFlashdata('user_key')) : ?>
            <div class="alert alert-success" role="alert">
                Game : <?= session()->getFlashdata('game') ?> / <?= session()->getFlashdata('duration') ?> Days<br>
                Game : <?= session()->getFlashdata('test') ?> / <?= session()->getFlashdata('test') ?> Days<br>
                License : <strong class="key-sensi"><?= session()->getFlashdata('user_key') ?></strong><br>
                Available for <?= session()->getFlashdata('max_devices') ?> Devices<br>
                <small>
                    <i>Duration will start when license login.</i><br>
                    <i class="bi bi-wallet"></i> Saldo Reduce :
                    <span class="text-danger">-<?= session()->getFlashdata('fees') ?></span>
                    (Total left <?= $user->saldo ?>$)
                </small>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header p3 text-light"style="background: linear-gradient(0.9turn, #797DF2, #FF00AA, #FF9270);" text-light">
                <div class="row">
                    <div class="col pt-1">
                        Create License
                    </div>
                    <div class="col text-end">
                        <a class="btn btn-sm btn-outline-light" href="<?= site_url('keys') ?>"><i class="bi bi-people"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open() ?>

                <div class="row">
                    <div class="form-group col-lg-6 mb-3">
                        <label for="game" class="form-label">Games</label>
                        <?= form_dropdown(['class' => 'form-select', 'name' => 'game', 'id' => 'game'], $game, old('game') ?: '') ?>
                        <?php if ($validation->hasError('game')) : ?>
                            <small id="help-game" class="text-danger"><?= $validation->getError('game') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-lg-6 mb-3">
                        <label for="max_devices" class="form-label">Max Devices</label>
                        
                        <input type="number" name="max_devices" id="max_devices" class="form-control" placeholder="1" value="<?= old('max_devices') ?: 1 ?>">
                        <?php if ($validation->hasError('game')) : ?>
                        
                        
                            <small id="help-max_devices" class="text-danger"><?= $validation->getError('max_devices') ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                
                
                <div class="form-group mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <?= form_dropdown(['class' => 'form-select', 'name' => 'duration', 'id' => 'duration'], $duration, old('duration') ?: '') ?>
                    <?php if ($validation->hasError('duration')) : ?>
                        <small id="help-duration" class="text-danger"><?= $validation->getError('duration') ?></small>
                    <?php endif; ?>
                </div>
                <br>
  <label class="form-check-label" for="check">
    Custom Key
  </label>
<input class="form-check-input" type="checkbox" minlength="4" maxlength="16" value="" name="check" onchange="fupi(this)" id="check">
<br>


<br>
<label for="custom" id="cuslabel" class="form-label">Input Your Key</label>
    <input type="text" minlength="4" maxlength="16" name="cuslicense" class="form-control" id="custom"></input>
    
 <br>
  <label for="hulala" id="labula" class="form-label">Bulk Keys</label>         
  <select class="form-select" aria-label="Default select example" id="hulala" name="loopcount">

  <option value="1">1 Keys</option>
  <option value="2">5 Keys</option>
  <option value="3">10 Keys</option>
  <option value="4">50 Keys</option>
  <option value="5">100 Keys</option>
</select>
<br>
                <input type="text" id="textinput" name="custominput" hidden>
                
                <div class="form-group mb-3">
                    <label for="estimation" class="form-label">Estimation</label>
                    <input type="text-light" id="estimation" class="form-control" placeholder="Your order will total" readonly>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-dark text-light"style="background: linear-gradient(0.9turn, #FF00FF88, #25383C, #307D7E); max-width: 80rem;">Generate</button>
                </div>
                <?= form_close() ?>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        var price = JSON.parse('<?= $price ?>');
        getPrice(price);
        // When selected
        $("#max_devices, #duration, #game").change(function() {
            getPrice(price);
        });
        // try to get price
        function getPrice(price) {
            var price = price;
            var device = $("#max_devices").val();
            var durate = $("#duration").val();
            var gprice = price[durate];
            if (gprice != NaN) {
                var result = (device * gprice);
                $("#estimation").val(result);
            } else {
                $("#estimation").val('Estimation error');
            }
        }
    });
    
function getOption() {
 var kop = document.getElementById('keysmode').value;

 
}
$(document).ready( function () {
  document.getElementById("custom").style.display = "none";
document.getElementById("cuslabel").style.display = "none";
});


function fupi(obj) {
  if($(obj).is(":checked")){
  //recommended W3C HTML5 syntax for boolean attributes


document.getElementById("custom").style.display = "block";
document.getElementById("cuslabel").style.display = "block";
 $('#hulala option').prop('selected', function() {
        return this.defaultSelected;
   });
document.getElementById("hulala").style.display = "none";
document.getElementById("labula").style.display = "none";
document.getElementById("textinput").value = "custom";
const input = document.getElementById('custom');
input.removeAttribute('required');
  }else{
document.getElementById("custom").style.display = "none";
document.getElementById("cuslabel").style.display = "none";
document.getElementById("hulala").style.display = "block";
document.getElementById("labula").style.display = "block";
document.getElementById("textinput").value = "auto";
const input = document.getElementById('custom');

// ✅ Set required attribute
//input.setAttribute('required', '');

// ✅ Remove required attribute
// 
  }
  
}
</script>
<?= $this->endSection() ?>