<?php
include('conn.php');
if ($user->level == 1) {
$usus = "Admin";
}
if ($user->level == 2) {
$usus = "Reseller";
}
if ($user->level > 2) {
$usus = "error";
}
if(!$conn) {

die(" PROBLEM WITH CONNECTION : " . mysqli_connect_error());

}
$rst = $user->username;
        $sql1 ="select keys_id from history where user_do='$rst'";
        $result1 = mysqli_query($conn, $sql1);
        $userDetails1 = mysqli_num_rows($result1);
        $sql2 ="select keys_id from history";
        $result2 = mysqli_query($conn, $sql2);
        $userDetails2 = mysqli_num_rows($result2);
        $sql3 ="select id_keys from keys_code";
        $result3 = mysqli_query($conn, $sql3);
        $userDetails3 = mysqli_num_rows($result3);

?>

<head>



<style>

.button-85 {
  padding: 0.6em 2em;
  border: none;
  outline: none;
  color: rgb(255, 255, 255);
  background: #111;
  cursor: pointer;
  position: relative;
  z-index: 0;
  border-radius: 10px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-85:before {
  content: "";
  background: linear-gradient(
    45deg,
    #ff0000,
    #ff7300,
    #fffb00,
    #48ff00,
    #00ffd5,
    #002bff,
    #7a00ff,
    #ff00c8,
    #ff0000
  );
  position: absolute;
  top: -2px;
  left: -2px;
  background-size: 400%;
  z-index: -1;
  filter: blur(5px);
  -webkit-filter: blur(5px);
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  animation: glowing-button-85 20s linear infinite;
  transition: opacity 0.3s ease-in-out;
  border-radius: 10px;
}

@keyframes glowing-button-85 {
  0% {
    background-position: 0 0;
  }
  50% {
    background-position: 400% 0;
  }
  100% {
    background-position: 0 0;
  }
}

.button-85:after {
  z-index: -1;
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background: #222;
  left: 0;
  top: 0;
  border-radius: 10px;
}
</style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
@import url('https://fonts.googleapis.com/css?family=Krub:400,700');
 * {
	 margin: 0;
	 padding: 0;
	 box-sizing: border-box;
}
 html, body {
	 width: 100%;
	 height: 100%;
}
 body {
	 background: #202020;
	 font-family: 'Krub', sans-serif;
}
 .card {
	 position: absolute;
	 margin: auto;
	 top: 0;
	 right: 0;
	 bottom: 0;
	 left: 0;
	 width: 250px;
	 height: 400px;
	 border-radius: 10px;
	 box-shadow: 0 10px 25px 5px rgba(0, 0, 0, 0.2);
	 background: #151515;
	 overflow: hidden;
}
 .card .ds-top {
	 position: absolute;
	 margin: auto;
	 top: 0;
	 right: 0;
	 left: 0;
	 width: 300px;
	 height: 80px;
	 background: crimson;
	 animation: dsTop 1.5s;
}
 .card .avatar-holder {
	 position: absolute;
	 margin: auto;
	 top: 40px;
	 right: 0;
	 left: 0;
	 width: 100px;
	 height: 100px;
	 border-radius: 50%;
	 box-shadow: 0 0 0 5px #151515, inset 0 0 0 5px #000, inset 0 0 0 5px #000, inset 0 0 0 5px #000, inset 0 0 0 5px #000;
	 background: white;
	 overflow: hidden;
	 animation: mvTop 1.5s;
}
 .card .avatar-holder img {
	 width: 100%;
	 height: 100%;
	 object-fit: cover;
}
 .card .name {
	 position: absolute;
	 margin: auto;
	 top: -60px;
	 right: 0;
	 bottom: 0;
	 left: 0;
	 width: inherit;
	 height: 40px;
	 text-align: center;
	 animation: fadeIn 2s ease-in;
}
 .card .name a {
	 color: white;
	 text-decoration: none;
	 font-weight: 700;
	 font-size: 18px;
}
 .card .name a:hover {
	 text-decoration: underline;
	 color: crimson;
}
 .card .name h6 {
	 position: absolute;
	 margin: auto;
	 left: 0;
	 right: 0;
	 bottom: 0;
	 color: white;
	 width: 40px;
}
 .card .button {
	 position: absolute;
	 margin: auto;
	 padding: 8px;
	 top: 20px;
	 right: 0;
	 bottom: 0;
	 left: 0;
	 width: inherit;
	 height: 40px;
	 text-align: center;
	 animation: fadeIn 2s ease-in;
	 outline: none;
}
 .card .button a {
	 padding: 5px 20px;
	 border-radius: 10px;
	 color: white;
	 letter-spacing: 0.05em;
	 text-decoration: none;
	 font-size: 10px;
	 transition: all 1s;
}
 .card .button a:hover {
	 color: white;
	 background: crimson;
}
 .card .ds-info {
	 position: absolute;
	 margin: auto;
	 top: 120px;
	 bottom: 0;
	 right: 0;
	 left: 0;
	 width: inherit;
	 height: 40px;
	 display: flex;
}
 .card .ds-info .pens, .card .ds-info .projects, .card .ds-info .posts {
	 position: relative;
	 left: -300px;
	 width: calc(250px / 3);
	 text-align: center;
	 color: white;
	 animation: fadeInMove 2s;
	 animation-fill-mode: forwards;
}
 .card .ds-info .pens h6, .card .ds-info .projects h6, .card .ds-info .posts h6 {
	 text-transform: uppercase;
	 color: crimson;
}
 .card .ds-info .pens p, .card .ds-info .projects p, .card .ds-info .posts p {
	 font-size: 12px;
}
 .card .ds-info .ds:nth-of-type(2) {
	 animation-delay: 0.5s;
}
 .card .ds-info .ds:nth-of-type(1) {
	 animation-delay: 1s;
}
 .card .ds-skill {
	 position: absolute;
	 margin: auto;
	 bottom: 10px;
	 right: 0;
	 left: 0;
	 width: 200px;
	 height: 100px;
	 animation: mvBottom 1.5s;
}
 .card .ds-skill h6 {
	 margin-bottom: 5px;
	 font-weight: 700;
	 text-transform: uppercase;
	 color: crimson;
}
 .card .ds-skill .skill h6 {
	 font-weight: 400;
	 font-size: 8px;
	 letter-spacing: 0.05em;
	 margin: 4px 0;
	 color: white;
}
 .card .ds-skill .skill .fab {
	 color: crimson;
	 font-size: 14px;
}
 .card .ds-skill .skill .bar {
	 height: 5px;
	 background: crimson;
	 text-align: right;
}
 .card .ds-skill .skill .bar p {
	 color: white;
	 font-size: 8px;
	 padding-top: 5px;
	 animation: fadeIn 5s;
}
 .card .ds-skill .skill .bar:hover {
	 background: white;
}
 .card .ds-skill .skill .bar-html {
	 width: 50%;
	 animation: htmlSkill 1s;
	 animation-delay: 0.4s;
}
 .card .ds-skill .skill .bar-css {
	 width: 90%;
	 animation: cssSkill 2s;
	 animation-delay: 0.4s;
}
 .card .ds-skill .skill .bar-js {
	 width: 75%;
	 animation: jsSkill 3s;
	 animation-delay: 0.4s;
}
 @keyframes fadeInMove {
	 0% {
		 opacity: 0;
		 left: -300px;
	}
	 100% {
		 opacity: 1;
		 left: 0;
	}
}
 @keyframes fadeIn {
	 0% {
		 opacity: 0;
	}
	 100% {
		 opacity: 1;
	}
}
 @keyframes htmlSkill {
	 0% {
		 width: 0;
	}
	 100% {
		 width: 95%;
	}
}
 @keyframes cssSkill {
	 0% {
		 width: 0;
	}
	 100% {
		 width: 90%;
	}
}
 @keyframes jsSkill {
	 0% {
		 width: 0;
	}
	 100% {
		 width: 75%;
	}
}
 @keyframes mvBottom {
	 0% {
		 bottom: -150px;
	}
	 100% {
		 bottom: 10px;
	}
}
 @keyframes mvTop {
	 0% {
		 top: -150px;
	}
	 100% {
		 top: 40px;
	}
}
 @keyframes dsTop {
	 0% {
		 top: -150px;
	}
	 100% {
		 top: 0;
	}
}
 .following {
	 color: white;
	 background: crimson;
}
 
</style>
     <script>
       function buta(){
           window.location = ("<?= site_url('dashboard') ?>");
                       }
    </script>
    </head>
    <body>
<div class="card">
  <div class="ds-top"></div>
  <div class="avatar-holder">
    <img src="<?php echo $user->image; ?>" alt="Albert Einstein">
  </div>
  <div class="name">
    <a href="https://codepen.io/AlbertFeynman/" target="_blank"><?php echo $user->fullname; ?></a>
    <h6 title="Followers"><i class="fas fa-users"></i> <span class="followers"><?php echo "@".$user->username; ?></span></h6>
  </div>

  <div class="ds-info">
    <div class="ds pens">
      <h6 title="Number of pens created by the user">Keys Made <i class="fas fa-edit"></i></h6>
      <p><?php echo $userDetails1; ?></p>
    </div>
    <div class="ds projects">
      <h6 title="Number of projects created by the user">Role <i class="fas fa-project-diagram"></i></h6>
      <p><?php echo $usus; ?></p>
    </div>
    <div class="ds posts">
      <h6 title="Number of posts">Uplink <i class="fas fa-comments"></i></h6>
      <p><?php echo $user->uplink; ?></p>
    </div>
  </div>
  <div class="ds-skill">
    <h6>Total Number Of Keys Made:-  <i class="fa fa-code" aria-hidden="true" style="color:#08f26e;"><?php echo $userDetails2." Keys"; ?></i></h6>
        <h6>Total Number Of Keys in Database:- <i class="fa fa-code" aria-hidden="true" style="color:#08f26e;"><?php echo $userDetails3." Keys"; ?></i></h6>
   <div class="button">
<button class="button-85" onclick="buta()" style="margin-top:20px;">Dashboard</button>
</div>
    <div class="skill html" hidden>
    <h6>Total Number Of Keys Made Till Now <i class="fa fa-code" aria-hidden="true"> <?php echo $userDetails2." Keys"; ?></i></h6>
    <div class="skill html"hidden>
      <h6><i class="fab fa-html5"></i> <?php echo "PUBG :-".$userDetails2." Keys"; ?> </h6>
      <div class="bar bar-html" hidden>
        <p><?php echo $userDetails2." keys"; ?></p>
      </div>
    </div>


  </div>
</div>
    <div class="skill html">

    </div>
   
</body>