<?php

namespace DPWeb\Models\User;

class Login extends \DefaultModel {

    public function loginUser($user, $pass) {
        $db = \DPWeb\Application\Database::getInstance();
        $view = \DPWeb\Controllers\View::getInstance();
        
        $user = $db->escape($user);
        $pass = $db->escape($pass);

        if ($user === false || $this->validator->filter($user) != 0) {
            $view->setError('Invalid username!');
        }

        if ($pass === false || $this->validator->filter($pass) != 0) {
            $view->setError('Invalid password!');
        }

        if (!$this->validator->rstrlen($user)) {
            $view->setError('The lenght of the username should be between 4 and 10 characters!');
        }

        if (!$this->validator->rstrlen($pass)) {
            $view->setError('The lenght of the password should be between 4 and 10 characters!');
        }

        if (\DPWeb\Application\Config::getInstance()->main['md5']) {
            $password = "[dbo].[fn_md5]('{$pass}','{$user}')";
        } else {
            $password = "'{$pass}'";
        }

        $login = $db->query("Select [memb__pwd], [memb___id] from [MEMB_INFO] Where [memb___id]='{$user}' and [memb__pwd]={$password}");
        $nr = $db->numRows($login);
        
        if($nr === 1){
            $fa = $db->fetchArray($login);
            $_SESSION['dpw_user'] = $fa['memb___id'];
            $_SESSION['dpw_pass'] = strtoupper(bin2hex($fa['memb__pwd']));
        } else {
            $view->setError('Invalid username or password!');
        }
    }

}
