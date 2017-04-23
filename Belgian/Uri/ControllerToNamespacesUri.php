<?php 

/*
 * @package     BelgianPHPPHP
 * @author      Estefanio NS <estefanions AT gmail DOT com>
 * @link        http://belgianphp.github.io
 * @copyright   2016 - 2017
 * 
 */



namespace Belgian\Uri;


class ControllerToNamespacesUri implements IGetController
{

    private $controller;


    public function __construct(IGetController $uri)
    {
        self::init($uri);
    }






    public function getController()
    {
        return $this->controller;
    } 







    private function init(IGetController $uri)
    {

        $uriControllerArr = explode('_', $uri->getController());

        $namespace = array();

        foreach ($uriControllerArr as $ns)
        {
            $namespace[] = ucfirst($ns);
        }

        $this->controller = implode('\\', $namespace);

        return $this;


    } 




}


