<?php

namespace DPWeb\Controllers;

class View {

    public $layoutData = array();
    public $smarty = null;
    public static $instance = null;

    private function __construct() {
        $smarty = new \Smarty;
        $smarty->setCacheDir('./views/cache');
        $smarty->setCompileDir('./views/compiled');
        $smarty->setTemplateDir('./views');

        if (!\DPWeb\Application\Config::getInstance()->main['development']) {
            $smarty->caching = true;
            $smarty->cache_lifetime = 120;
        } else {
            if (\DPWeb\Application\Config::getInstance()->main['smartydebug']) {
                $smarty->debugging = true;
            }
        }

        $this->smarty = $smarty;
    }

    public function render($view, $data = array()) {
        $smarty = $this->smarty;
        $this->dpcustom();
        
        $viewFile = $view . '.tpl';
        $data['layout'] = $this->layoutData;

        if (!$smarty->templateExists($viewFile)) {
            $viewFile = '404.tpl';
        }

        $this->variableAssign($data, $viewFile);
        $this->dispatch();
    }

    public function dpcustom() {
        $this->layoutData = array(
            'title' => 'DarkPowerMu',
            'sess' => $_SESSION,
            'links' => array(
                'Home' => './home',
                'Register' => './register',
                'Rankings' => './rankings',
                'Download' => './download',
                'Castle Siege' => './castlesiege',
                'Market' => './market',
                'Webshop' => './webshop'
            ),
            'navlinks' => array(
                'Home' => './home',
                'Events' => './events',
                'Hall of Fame' => '/hof',
            ),
            'title' => 'DarkPowerMu - Season 3 Episode 1 MuOnline',
            'imgs' => "./templates/dpcustom/images/",
            'css' => "./templates/dpcustom/css/",
            'servername' => 'DarkPowerMu',
            'online' => 20,
            'limit' => 200, 'news' => array(
                'Test of the news 1' => 'blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah ',
                'Test of the news 2' => 'blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah ',
                'Test of the news 3' => 'blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah ',
            )
        );
    }

    public function variableAssign($data, $viewFile) {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        $this->smarty->assign('viewFileTPL', $viewFile);
        $this->smarty->assign('usedMemory', number_format(((memory_get_usage() / 1024) / 1024), 2, '.', ' '));
    }

    public function dispatch() {
        $this->smarty->display('index.tpl');
    }

    /**
     * 
     * @return View
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new View();
        }

        return self::$instance;
    }

}
