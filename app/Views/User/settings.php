<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<script>
var timezone_offset_minutes = new Date().getTimezoneOffset();
timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;

// Timezone difference in minutes such as 330 or -360 or 0
console.log(timezone_offset_minutes); 
</script>
<?php
$timezone_offset_minutes = 330;  // $_GET['timezone_offset_minutes']

// Convert minutes to seconds
$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);

// Asia/Kolkata
//echo $timezone_name;
//date_default_timezone_set($timezone_name);
?>

<div class="row">
    <div class="col-lg-12">
        <?= $this->include('Layout/msgStatus') ?>
    </div>
    
    
    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-header h6 p-3 bg-dark text-white"style="background:linear-gradient(0.90turn,  #0022FF,#00FF37, #FF0000);">
                Change Full Name, Profile pic
            </div>
            <div class="card-body">
                <?= form_open() ?>

                <input type="hidden" name="fullname_form" value="1">
                <div class="form-group mb-3">
            <div class="card-body">

<b>SELECT PROFILE PIC(Must be less than 1mb)</b>
            <input
                class="form-control form-control-lg"
                id="selectAvatar"
                type="file"
            />
 
    <br>  <img id="avatar"class="img-circle avatar" style="max-width:90px;max-height:90px;margin-left: 40%;" src="https://wallpapers.com/images/file/cool-neon-blue-profile-picture-u9y9ydo971k9mdcf-2.jpg"></img></br>
<textarea id="textArea" style="" row="20" column="20"  name="image" hidden></textarea>
                    <label for="fullname">Full Name</label>
                    <input type="text" name="fullname" id="fullname" class="form-control mt-2" placeholder="Maru-kun" aria-describedby="help-fullname" value="<?= old('fullname') ?: ($user->fullname ?: '') ?>">
                    <?php if ($validation->hasError('fullname')) : ?>
                        <small id="help-fullname" class="text-danger"><?= $validation->getError('fullname') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group my-2">
                    <button type="submit" class="btn btn-outline-danger text-white"style="background: linear-gradient(0.9turn, #0022FF,#00FF37, #FF0000); max-width: 80rem;">Update Account</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
    
    
    <div class="col-lg-6">
        <div class="card mb-3">
                  <div class="card-header h6 p-3 bg-dark text-white"style="background:linear-gradient(0.90turn,  #0022FF,#00FF37, #FF0000);">
                Change Password
            </div>
            <div class="card-body">
                <?= form_open() ?>

                <input type="hidden" name="password_form" value="1">
                <div class="form-group mb-2">
                    <label for="current" hidden>Current Password</label>
                    <input type="password" name="current" id="current" class="form-control mt-2" placeholder="Current Password" hidden>
                    <?php if ($validation->hasError('current')) : ?>
                        <small id="help-current" class="text-danger"><?= $validation->getError('current') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group mb-2">
                    <label for="password" hidden>New Password</label>
                    <input type="password" name="password" id="password" class="form-control mt-2" placeholder="New Password" aria-describedby="help-password" hidden>
                    <?php if ($validation->hasError('password')) : ?>
                        <small id="help-password" class="text-danger"><?= $validation->getError('password') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group mb-2">
                    <label for="password2" hidden>Confirm Password</label>
                    <input type="password" name="password2" id="password2" class="form-control mt-2" placeholder="Password" aria-describedby="help-password2" hidden>
        <input type="hidden" name="timezone" value="<?php echo $timezone_name; ?>"></input>

                    <?php if ($validation->hasError('password2')) : ?>
                        <small id="help-password2" class="text-danger"><?= $validation->getError('password2') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group my-2">
                    <button type="submit" class="btn btn-outline-danger text-white "style="background: linear-gradient(0.9turn, #FF00FF88, #25383C, #307D7E); max-width: 80rem;">Send Password Reset Request To Your Mail</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>


   <script>
   
const input = document.getElementById("selectAvatar");
const avatar = document.getElementById("avatar");
const textArea = document.getElementById("textArea");

const convertBase64 = (file) => {
    return new Promise((resolve, reject) => {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(file);

        fileReader.onload = () => {
            resolve(fileReader.result);
        };

        fileReader.onerror = (error) => {
            reject(error);
        };
    });
};

const uploadImage = async (event) => {
    const file = event.target.files[0];
    const base64 = await convertBase64(file);
    avatar.src = base64;
    textArea.innerText = base64;
};

input.addEventListener("change", (e) => {

const target = e.target
  	if (target.files && target.files[0]) {

      /*Maximum allowed size in bytes
        5MB Example
        Change first operand(multiplier) for your needs*/
      const maxAllowedSize = 5242880;
      if (target.files[0].size < maxAllowedSize) {
      	// Here you can ask your users to load correct file
       	uploadImage(e);
      } else {
      Swal.fire('Failed','File sixe is too big','error')
      }
  }
    
    

});
   
   


   </script>


<?= $this->endSection() ?>