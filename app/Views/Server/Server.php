<?php

include('conn.php');

// for maintainece mode
$sql1 ="select * from onoff where id=11";
$result1 = mysqli_query($conn, $sql1);
$userDetails1 = mysqli_fetch_assoc($result1);
// for ftext and status
$sql2 ="select * from _ftext where id=1";
$result2 = mysqli_query($conn, $sql2);
$userDetails2 = mysqli_fetch_assoc($result2);
?>

<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>


<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-person" role="alert">
            
        </div>
        <div class="card shadow-sm">
           
            <div class="card-header bg-dark text-white h6 p-3"style="background: linear-gradient(0.9turn, #5FD630, #30d65c, #306ad6);">
                
           <a class="btn btn-outline-light btn-sm" href="<?= site_url('admin/manage-users') ?>"><i class="bi bi-person-badge"></i> Manage Users</a>
           
           <a class="btn btn-outline-light btn-sm" href="<?= site_url('keys/generate') ?>"><i class="bi bi-person-plus"></i> Generate Keys</a>
           

           
            </div>
            <br>
<div class="row">
    <div class="col-lg-12">
        <?= $this->include('Layout/msgStatus') ?>
    </div>
    
    <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
     <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-header h6 p-3 text-white"style="background: linear-gradient(0.9turn, #5FD630, #30d65c, #306ad6);">
Mod status
            </div>
            <div class="card-body">
                <?= form_open() ?>

                <input type="hidden" name="status_form" value="1">
                <div class="form-group mb-3">
                    <label for="status">Current Status: <font size="2" color ="#a39c9b"><?php echo $userDetails1['status']; ?></font></label>
                  
                  
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <div class="input-group-text text-white"style="background: linear-gradient(0.9turn, #FF00FF88, #25383C, #307D7E);">
        
      <input type="radio" id="radio" name="radios" value="1" aria-label="Checkbox for following text input" REQUIRED><font size="2"> Online Server</font>
      
    </div>
 </div>
 </div>

 
 <div class="input-group mb-3">
 <div class="input-group-prepend">
 <div class="input-group-text text-white"style="background: linear-gradient(0.9turn, #5FD630, #30d65c, #306ad6);">
        
      <input type="radio" id="radio" name="radios" value="2" aria-label="Checkbox for following text input"><font size="2" REQUIRED> Offline Server</font>
      
    </div>
    </div>
    </div>
    <label for="modname">Current_Offline_Msg: <font size="2" color ="#0015ff"><?php echo $userDetails1['myinput']; ?></font></label>


  <div class="input-group mb-3">
  <div class="input-group-prepend">
      
  <span class="text-white input-group-text role="alert" style="background: linear-gradient(0.9turn, #FF00FF88, #25383C, #307D7E);" id="inputGroup-sizing-default">Offline Msg</span>
  </div>
 
      <textarea class="form-control" placeholder="Server Offline Msg" name = "myInput" id="myInput" id="exampleFormControlTextarea1" rows="1"></textarea>
</div>
                  
                    
                    <?php if ($validation->hasError('modname')) : ?>
                        <small id="help-modname" class="text-danger"><?= $validation->getError('modname') ?></small>
                    <?php endif; ?>
                </div>
<button type="submit" class="text-white btn role="alert" style="background: linear-gradient(0.9turn, #FF00FF88, #25383C, #307D7E);">Update Status</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
   
    <!----><!----><!----><!----><!----><!----><!----><!---->
    
    <div class="col-lg-6" >
        <div class="card mb-3">
            <div class="card-header h6 p-3 text-white"style="background: linear-gradient(0.9turn, #6FFF00, #25383C, #307D7E);">
                👻Change Mod Name👻
            </div>
            <div class="card-body" style="padding-bottom:130px;">
                <?= form_open() ?>

                <input type="hidden" name="modname_form" value="1">
             
                <div class="form-group mb-3">
                    <label for="modname">Current Mod Name: <font size="2" color ="#a39c9b"><?php echo $row['modname']; ?></font></label>
                    <input type="text" name="modname" id="modname" class="form-control mt-2" placeholder="Enter New Mod Name" aria-describedby="help-modname" REQUIRED>
                    <?php if ($validation->hasError('modname')) : ?>
                        <small id="help-modname" class="text-danger"><?= $validation->getError('modname') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group my-2">
                    <button type="submit" class="text-white btn role ="alert" style="background: linear-gradient(0.9turn, #FF00FF88, #25383C, #307D7E);">Update Mod Name</button>
                </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    
    <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
    <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
    
        <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-header h6 p-3 text-white"style="background: linear-gradient(0.9turn,#6FFF00, #25383C, #307D7E);">
            
                👻Change Mod Floating Text👻
            </div>
            <div class="card-body">
                <?= form_open() ?>

                <input type="hidden" name="_ftext" value="1">
                
                <label for="status">Current Mod Status: <font size="2" color ="#a39c9b"><?php echo $userDetails2['_status']; ?> </font> </label>
                
  <div class="input-group mb-3">

  <div class="input-group-prepend">

  <div class="input-group-text text-white"style="background: linear-gradient(0.9turn, #6FFF00, #25383C, #307D7E);">
        
      <input type="radio" id="radio" name="_ftextr" value="1" aria-label="Checkbox for following text input" REQUIRED><font size="2"> Safe</font>
      
    </div>
 </div>
 </div>

 
 <div class="input-group mb-3">
 <div class="input-group-prepend">
 <div class="input-group-text text-white"style="background: linear-gradient(0.9turn, #6FFF00, #25383C, #307D7E);">
        
      <input type="radio" id="radio" name="_ftextr" value="2" aria-label="Checkbox for following text input"><font size="2" REQUIRED> Not Safe</font>
      
    </div>
    </div>
    </div>
                
                <div class="form-group mb-3">
                    <label for="_ftext">Current Floating Text: <font size="2" color ="#a39c9b"><?php echo $userDetails2['_ftext']; ?></font></label>
                    <input type="text" name="_ftext" id="_ftext" class="form-control mt-2" placeholder="Enter New Floating Text" aria-describedby="help-_ftext" REQUIRED>
                    <?php if ($validation->hasError('_ftext')) : ?>
                        <small id="help-_ftext" class="text-danger"><?= $validation->getError('_ftext') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group my-2">
                     <button type="submit" class="text-white btn role="alert" style="background: linear-gradient(0.9turn, #FF00FF88, #25383C, #307D7E);">Update Floating Text </button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    

                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-header h6 p-3 text-white"style="background: linear-gradient(0.9turn,#6FFF00, #25383C, #307D7E);">
             THANK @PBARMYF FOR THIS PANEL
            </div>
            <div class="card-body">
                
                
    </div>
    
    <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
</div>

<?= $this->endSection() ?>