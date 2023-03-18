<?php

namespace App\Controllers;

use App\Models\HistoryModel;
use App\Models\KeysModel;
use App\Models\UserModel;
use Config\Services;

class Keys extends BaseController
{
    protected $userModel, $model, $user;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->user = $this->userModel->getUser();
        $this->model = new KeysModel();
        $this->time = new \CodeIgniter\I18n\Time;

        /* ------- Game ------- */
        $this->game_list = [
            'PUBG' => 'PUBG Mobile'
        ];

        $this->duration = [
            1 => '1 Hours &mdash;₹ 50/Device',
            5 => '5 Hours &mdash; ₹100/Device',
            24 => '1 Days &mdash; ₹150/Device',
            72 => '3 Days &mdash; ₹300/Device',
            168 => '7 Days &mdash; ₹600/Device',
           
            720 => '30 Days &mdash; ₹1500/Device',
            1440 => '60 Days &mdash; ₹2500/Device',
        ];

        $this->price = [
            1 => 50,
            5 => 100,
            24 => 150,
            72 => 300,
            168 => 600,
           720 => 1500,
          1440 => 2500,
        ];
    }

    public function index()
    {
        $model = $this->model;
        $user = $this->user;
        $usu = $user->level;
        if ($user->level != 1) {
            $keys = $model->where('registrator', $user->username)
                ->findAll();
        } else {
            $keys = $model->select('user_key')->findAll();
        }
        $data = [
            'title' => 'Keys',
            'user' => $user,
            'keylist' => $keys,
            'time' => $this->time,
        ];
        return view('Keys/list', $data);
    }
    
public function download_all_Keys(){
function transform(&$data) {
    foreach(array_keys($data) as $key) {
        if( is_null($data[$key]) 
            || empty($data[$key]) 
        ) {
            unset($data[$key]);
        } 
    }
}

// usage


//transform($data);
                       // $max_dev = $findKey->max_devices;
    $model = $this->model;
    $user = $this->user;
    $keys = $model->where('devices =', null)->select('user_key')->findAll();
    

   // $keys = $keyss->select('user_key')->findAll();
//transform($keys);
    $data='';
    for($i=0;$i<count($keys);$i++){
        $data.=$keys[$i]['user_key']."\n";
    }
    write_file('newName.txt', $data);
    $this->downloadFile('newName.txt');
}

   
public function download_unused_Keys(){
function transform(&$data) {
    foreach(array_keys($data) as $key) {
        if( is_null($data[$key]) 
            || empty($data[$key]) 
        ) {
            unset($data[$key]);
        } 
    }
}

// usage


//transform($data);
                       // $max_dev = $findKey->max_devices;
    $model = $this->model;
    $user = $this->user;
    $keys = $model->where('devices =', null)->select('user_key')->findAll();
    

   // $keys = $keyss->select('user_key')->findAll();
//transform($keys);
    $data='';
    for($i=0;$i<count($keys);$i++){
        $data.=$keys[$i]['user_key']."\n";
    }
    write_file('newName.txt', $data);
    $this->downloadFile('newName.txt');
}

public function download_used_Keys(){
function transform(&$data) {
    foreach(array_keys($data) as $key) {
        if( is_null($data[$key]) 
            || empty($data[$key]) 
        ) {
            unset($data[$key]);
        } 
    }
}

// usage


//transform($data);
                       // $max_dev = $findKey->max_devices;
    $model = $this->model;
    $user = $this->user;
    $keys = $model->where('devices !=', null)->select('user_key')->findAll();
    

   // $keys = $keyss->select('user_key')->findAll();
//transform($keys);
    $data='';
    for($i=0;$i<count($keys);$i++){
        $data.=$keys[$i]['user_key']."\n";
    }
    write_file('newName.txt', $data);
    $this->downloadFile('newName.txt');
}

    function downloadFile($yourFile){
        // $yourFile = "newName.txt";
        $file = @fopen($yourFile, "rb");
if ($yourFile == "newName.txt"){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=ALL KEYS.txt');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($yourFile));
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        } }
        if ($yourFile == "new.txt"){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=SINGLE KEY.txt');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($yourFile));
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        } }
}
public function alterKeys(){
        $model = $this->model;
        $user = $this->user;
        $usu = $user->level;
        if ($usu == 1) {
    echo 'hello';
    echo  date('Y-m-d H:i:s');
    $model=$this->model;
    $data=$model->where('id_keys !=', 1)->delete();
print_r($data);

    return redirect()->back()->with('msgSuccess', 'success');
    } else {
    return redirect()->back()->with('msgDanger', 'You are not a <b>ADMIN</b> so you cant delete key(s)');
            }
}
public function alterUnusedKeys(){
        $model = $this->model;
        $user = $this->user;
        $usu = $user->level;
        if ($usu == 1) {
    echo 'hello';
    echo  date('Y-m-d H:i:s');
    $model=$this->model;
    $data=$model->where('devices =', null)->delete();
print_r($data);

    return redirect()->back()->with('msgSuccess', 'success');
    } else {
    return redirect()->back()->with('msgDanger', 'You are not a <b>ADMIN</b> so you cant delete key(s)');
            }
}
   public function alterUsedKeys(){
        $model = $this->model;
        $user = $this->user;
        $usu = $user->level;
    if ($usu == 1) {
    echo 'hello';
    echo  date('Y-m-d H:i:s');
    $model=$this->model;
    $data=$model->where('devices !=', null)->delete();
print_r($data);

    return redirect()->back()->with('msgSuccess', 'success');
    } else {
    return redirect()->back()->with('msgDanger', 'You are not a <b>ADMIN</b> so you cant delete key(s)');
            }
}
    
    
    public function api_get_keys()
    {
        // ? API for DataTable Keys
        $model = $this->model;
        return $model->API_getKeys();
    }

    public function api_key_reset()
    {
        sleep(1);
        $model = $this->model;
        $keys = $this->request->getGet('userkey');
        $reset = $this->request->getGet('reset');
        $db_key = $model->getKeys($keys);

        $rules = [];
        if ($db_key) {
            $total = $db_key->devices ? explode(',', $db_key->devices) : [];
            $rules = ['devices_total' => count($total), 'devices_max' => (int) $db_key->max_devices];
            $user = $this->user;
            if ($db_key->devices and $reset) {
                if ($user->level == 1 or $db_key->registrator == $user->username) {
                    $model->set('devices', NULL)
                        ->where('user_key', $keys)
                        ->update();
                    $rules = ['reset' => true, 'devices_total' => 0, 'devices_max' => $db_key->max_devices];
                }
            } else {
            }
        }

        $data = [
            'registered' => $db_key ? true : false,
            'keys' => $keys,
        ];

        $real_response = array_merge($data, $rules);
        return $this->response->setJSON($real_response);
    }

    public function edit_key($key = false)
    {
        if ($this->request->getPost()) return $this->edit_key_action();
        $msgDanger = "The user key no longer exists.";
        if ($key) {
            $dKey = $this->model->getKeys($key, 'id_keys');
            $user = $this->user;
            if ($dKey) {
                if ($user->level == 1 or $dKey->registrator == $user->username) {
                    $validation = Services::validation();
                    $data = [
                        'title' => 'Key',
                        'user' => $user,
                        'key' => $dKey,
                        'game_list' => $this->game_list,
                        'time' => $this->time,
                        'key_info' => getDevice($dKey->devices),
                        'messages' => setMessage('Please carefuly edit information'),
                        'validation' => $validation,
                    ];
                    return view('Keys/key_edit', $data);
                } else {
                    $msgDanger = "Restricted to this user key.";
                }
            }
        }
        return redirect()->to('keys')->with('msgDanger', $msgDanger);
    }

    private function edit_key_action()
    {
        $keys = $this->request->getPost('id_keys');
        $user = $this->user;
        $dKey = $this->model->getKeys($keys, 'id_keys');
        $game = implode(",", array_keys($this->game_list));

        if (!$dKey) {
            $msgDanger = "The user key no longer exists~";
        } else {
            if ($user->level == 1 or $dKey->registrator == $user->username) {
                $form_reseller = [
                    'status' => [
                        'label' => 'status',
                        'rules' => 'required|integer|in_list[0,1]',
                        'erros' => [
                            'integer' => 'Invalid {field}.',
                            'in_list' => 'Choose between list.'
                        ]
                    ]
                ];
                $form_admin = [
                    'id_keys' => [
                        'label' => 'keys',
                        'rules' => 'required|is_not_unique[keys_code.id_keys]|numeric',
                        'errors' => [
                            'is_not_unique' => 'Invalid keys.'
                        ],
                    ],
                    'game' => [
                        'label' => 'Games',
                        'rules' => "required|alpha_numeric_space|in_list[$game]",
                        'errors' => [
                            'alpha_numeric_space' => 'Invalid characters.'
                        ],
                    ],
                    'user_key' => [
                        'label' => 'User keys',
                        'rules' => "required|is_unique[keys_code.user_key,user_key,$dKey->user_key]|alpha_numeric",
                        'errors' => [
                            'is_unique' => '{field} has been taken.'
                        ],
                    ],
                    'duration' => [
                        'label' => 'duration',
                        'rules' => 'required|numeric|greater_than_equal_to[0]',
                        'errors' => [
                            'greater_than_equal_to' => 'Minimum {field} is invalid.',
                            'numeric' => 'Invalid hour {field}.'
                        ]
                    ],
                    'max_devices' => [
                        'label' => 'devices',
                        'rules' => 'required|numeric|greater_than_equal_to[1]',
                        'errors' => [
                            'greater_than_equal_to' => 'Minimum {field} is invalid.',
                            'numeric' => 'Invalid max of {field}.'
                        ]
                    ],
                    'registrator' => [
                        'label' => 'registrator',
                        'rules' => 'permit_empty|alpha_numeric_space|min_length[4]'
                    ],
                    'expired_date' => [
                        'label' => 'expired',
                        'rules' => 'permit_empty|valid_date[Y-m-d H:i:s]',
                        'errors' => [
                            'valid_date' => 'Invalid {field} date.',
                        ]
                    ],
                    'devices' => [
                        'label' => 'device list',
                        'rules' => 'permit_empty'
                    ]
                ];

                if ($user->level == 1) {
                    // Admin full rules.
                    $form_rules = array_merge($form_reseller, $form_admin);
                    $devices = $this->request->getPost('devices');
                    $max_devices = $this->request->getPost('max_devices');

                    $data_saves = [
                        'game' => $this->request->getPost('game'),
                        'user_key' => $this->request->getPost('user_key'),
                        'duration' => $this->request->getPost('duration'),
                        'max_devices' => $max_devices,
                        'status' => $this->request->getPost('status'),
                        'registrator' => $this->request->getPost('registrator'),
                        'expired_date' => $this->request->getPost('expired_date') ?: NULL,
                        'devices' => setDevice($devices, $max_devices),
                    ];
                } else {
                    // Reseller just status rules, you can set manually later.
                    $form_rules = $form_reseller;
                    $data_saves = ['status' => $this->request->getPost('status')];
                }

                if (!$this->validate($form_rules)) {
                    return redirect()->back()->withInput()->with('msgDanger', 'Failed! Please check the error');
                } else {
                    // * Data Updates
                    $this->model->update($dKey->id_keys, $data_saves);
                    return redirect()->back()->with('msgSuccess', 'User key successfuly updated!');
                }
            } else {
                $msgDanger = "Restricted to this user key~";
            }
        }
        return redirect()->to('keys')->with('msgDanger', $msgDanger);
    }

    public function generate()
    {
        if ($this->request->getPost())
            return $this->generate_action();

        $user = $this->user;
        $validation = Services::validation();

        $message = setMessage("<i class='bi bi-wallet'></i> Total Saldo $$user->saldo");
        if ($user->saldo <= 0) {
            $message = setMessage("Please top up to your beloved admin.", 'warning');
        }

        $data = [
            'title' => 'Generate',
            'user' => $user,
            'time' => $this->time,
            'game' => $this->game_list,
            'duration' => $this->duration,
            'price' => json_encode($this->price),
            'messages' => $message,
            'validation' => $validation,
        ];
        return view('Keys/generate', $data);
    }
    

    private function generate_action()
    {
    
        $user = $this->user;
        $game = $this->request->getPost('game');
        $maxd = $this->request->getPost('max_devices');
        $drtn = $this->request->getPost('duration');
        $twst = $this->request->getPost('custominput');
        $cuslicense = $this->request->getPost('cuslicense');
        $getPrice = getPrice($this->price, $drtn, $maxd);
        
        $loopcount =  $this->request->getPost('loopcount');
        
        if ($loopcount == "1"){
        $loopcount = 2;
        
        }
        
        else if ($loopcount == "2"){
        $loopcount = 6;
  
        }
        
        else if ($loopcount == "3"){
        $loopcount = 11;
  
        }
        else if ($loopcount == "4"){
        $loopcount = 51;
        
        }
        else if ($loopcount == "5"){
        $loopcount = 101;
        
        }
       
      

          $game_list = implode(",", array_keys($this->game_list));
          $form_rules = [
              'game' => [
                  'label' => 'Games',
                  'rules' => "required|alpha_numeric_space|in_list[$game_list]",
                  'errors' => [
                      'alpha_numeric_space' => 'Invalid characters.'
                  ],
              ],
              'duration' => [
                  'label' => 'duration',
                  'rules' => 'required|numeric|greater_than_equal_to[1]',
                  'errors' => [
                     'greater_than_equal_to' => 'Minimum {field} is invalid.',
                      'numeric' => 'Invalid hour {field}.'
                  ]
              ],
              'max_devices' => [
                  'label' => 'devices',
                  'rules' => 'required|numeric|greater_than_equal_to[1]',
                  'errors' => [
                      'greater_than_equal_to' => 'Minimum {field} is invalid.',
                      'numeric' => 'Invalid max of {field}.'
                  ]
              ],
          ];

          $validation = Services::validation();
          $reduceCheck = ($user->saldo - $getPrice);
          // dd($reduceCheck);
          if ($reduceCheck < 0) {
              $validation->setError('duration', 'Insufficient balance');
              return redirect()->back()->withInput()->with('msgWarning', 'Please top up to your beloved admin.');
          } else {
              if (!$this->validate($form_rules)) {
                  return redirect()->back()->withInput()->with('msgDanger', 'Failed! Please check the error');
              } else {
                
                 //================================================//
                
           
            
    
                //for($i = 1; $i < $loopcount; $i++) {
                
              //}
            
            
                  
        
                   // echo "$license  <br><br>";
        
                  
               
                  
                  //================================================//
                  
   
                      $msg = "Successfuly Generated.";

                  


                 
                   $data='';

                 // * reseller reduce saldo
                 for($i=1;$i<$loopcount;$i++){
                       $license = random_string('alnum',20);
                $model = $this->model;

if ($twst == "custom") {
if (strlen($cuslicense) > 3 && strlen($cuslicense) < 20){
                $findKey = $model
                    ->getKeysGame(['user_key' => $cuslicense, 'game' => $game]);
if ($findKey) {
                  return redirect()->back()->with('msgDanger', 'Key already exists!!');
} else {
$license = $cuslicense;
}
} else {
                  return redirect()->back()->with('msgDanger', 'Custom Key is too Short/Long');
}


}

                      $data_response = [
                      'game' => $game,
                      'user_key' => $license,
                      'duration' => $drtn,
                      'max_devices' => $maxd,
                      'registrator' => $user->username,
                      'test' => $twst,
                  ];
                    $data.=$license."\n";
                  
                  $idKeys = $this->model->insert($data_response);
                }
                write_file('new.txt', $data);///
                // $this->downloadFile('new.txt');
                
                  $this->userModel->update(session('userid'), ['saldo' => $reduceCheck]);

                  $history = new HistoryModel();
                  $history->insert([
                      'keys_id' => $idKeys,
                      'user_do' => $user->username,
                      'info' => "$game|" . substr($license, 0, 5) . "|$drtn|$maxd"
                  ]);

                  $other_response = [
                      'fees' => $getPrice
                  ];

                  session()->setFlashdata(array_merge($data_response, $other_response));
                 
                 
                  return redirect()->back()->with('msgSuccess', $msg);
                
              }
          }
     }
 
}
