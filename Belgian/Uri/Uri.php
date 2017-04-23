<?php 

/*
 * @package     BelgianPHP
 * @author      Estefanio NS <estefanions AT gmail DOT com>
 * @link        http://belgianphp.github.io
 * @copyright   2016 - 2017
 * 
 */



namespace Belgian\Uri;

use Belgian\Filter\Preserve\AlnumUnderscoreHyphen;

class Uri implements IUri, IGetParamArr
{

    private $alnumPreserve;
    private $str;
    private $controller;
    private $action;
    private $param = array();
    private static $instance = NULL;




    protected function __construct()
    {
        self::init();
    }






    public static function getInstance()
    {
        if(self::$instance == NULL)
        {
            self::$instance = new Uri();
        }

        return self::$instance;
    } 





    private function init()
    {
        $this->alnumPreserve = new AlnumUnderscoreHyphen();

        $uri        = self::getUriArr();
        $isAction   = (array_key_exists(1, $uri));
        $controller = ucfirst($uri[0]);
        $action     = (!$isAction)? 'index': lcfirst($uri[1]);

        $this->action     = self::filter($action);
        $this->controller = self::filter($controller);

        unset($uri[0], $uri[1]);
        sort($uri);

        $this->param = $uri;


    } 







    private function filter($value) 
    {
        $value = str_replace('-', '_', $value);
        return $this->alnumPreserve->filter($value);
    }







    private function getUriArr()
    {
        return (!array_key_exists('uri', $_GET))
            ? array('Index', 'index')
            : explode('/', rtrim($_GET['uri'], '/'));
    } 








    public function getController()
    {
        return $this->controller;
    } 








    public function getAction()
    {
        return $this->action;
    } 






    public function getParam($num)
    { 
        $isParam = (array_key_exists($num, $this->param));
        return (!$isParam) ? NULL: $this->param[$num];
    } 







    public function getParamArr()
    {
        return (!count($this->param)) ? array(): $this->param;
    } 






    private function __clone() { } 




        private function __wakeup() { } 



}
