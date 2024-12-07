<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Hybridauth\Hybridauth;
use Hybridauth\HttpClient;

class Hauth extends CI_Controller
{
    var $config;

    function __construct()
    {
        parent::__construct();

        $this->config = [
            'callback' => current_url(),
            'providers' => [
                /*'Google' => [
                    'enabled' => true,
                    'keys'    => [ 'id' => '70556162479-l688pm4fiqdcaoodfngvorn3nrq0bgad.apps.googleusercontent.com', 'secret' => 'hMfnLDyRE6jDWTTu0L0iwbhP' ],
                ],*/
                'Facebook' => [
                    'enabled' => true,
                    'keys'    => [ 'id' => '936623536854291', 'secret' => '943d04785cf1ee02d15fbc75641375cb' ],
                ],
                'Twitter' => [
                    'enabled' => true,
                    'keys'    => [ 'key' => '', 'secret' => '' ],
                ]
            ],
        ];
    }

    public function login($provider)
    {
        try {

            $hybridauth = new Hybridauth($this->config);

            $adapter = $hybridauth->authenticate($provider);

            $tokens = $adapter->getAccessToken();
            $userProfile = $adapter->getUserProfile();

            $data = ['identifier' => $userProfile->identifier
                , 'webSiteURL' => $userProfile->webSiteURL
                , 'profileURL' => $userProfile->profileURL
                , 'photoURL' => $userProfile->photoURL
                , 'data' => $userProfile->data
            ];

            $userProfile = object2array($userProfile);
            $userProfile['first_name'] = $userProfile['firstName'];
            $userProfile['last_name'] = $userProfile['lastName'];
            $userProfile['photo'] = $userProfile['identifier'] . '.jpg';
            $userProfile['data'] = json_encode($data);
            file_put_contents(asset_dir('front/users/' . $userProfile['photo']), file_get_contents($userProfile['photoURL']));

            $userProfile['username'] = $userProfile['email'];
            $userProfile['status'] = 'Active';
            $userProfile['user_type_id'] = get_option('client_type_id');
            $userProfile['created'] = date('Y-m-d H:i:s');

            $user = $this->db->query("SELECT id FROM users WHERE JSON_EXTRACT(data, '$.identifier') = '{$userProfile['identifier']}'")->row();
            if ($user->id == 0){
                $db_data = getDbArray('users', ['id'], $userProfile);
                $id = save('users', $db_data['dbdata']);
            } else {
                $id = $user->id;
                $db_data = getDbArray('users', ['id'], $userProfile);
                save('users', $db_data['dbdata'], "id='{$id}'");
            }

            $this->session->set_userdata([
                FRONT_SESSION_ID => $id,
                'username' => $userProfile['identifier'],
                'email' => $userProfile['email'],
                'user_type_id' => $userProfile['user_type_id'],
                //'user_info' => $result,
            ]);

            // print_r( $tokens );
            // print_r( $userProfile );

            $adapter->disconnect();

            header('Location: ' . DOMAIN_URL);
            //header('Location: ' . DOMAIN_URL . 'member/account/home');
        }
        catch (\Exception $e) {
            echo '<pre>'; print_r($e->getMessage()); echo '</pre>';
        }
    }

    function logout($provider){

        $hybridauth = new Hybridauth($this->config);

        $adapter = $hybridauth->getAdapter($provider);
        $adapter->disconnect();

        $this->session->unset_userdata([
            FRONT_SESSION_ID,
            'username',
            'email',
            'user_type_id',
            'user_info',
        ]);
        redirect(DOMAIN_URL);
    }

    public function endpoint($provider)
    {
        echo '<pre>'; print_r($_REQUEST ); echo '</pre>';

        log_message('debug', 'controllers.HAuth.endpoint called.');
        log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: ' . print_r($_REQUEST, TRUE));
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
            $_GET = $_REQUEST;
        }
        log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');

        $hybridauth = new Hybridauth($this->config);
        $adapter = $hybridauth->authenticate($provider);
    }
}
/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */