<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initSession() 
    {
       Zend_Session::start();
       Zend_Locale::disableCache(true);
       date_default_timezone_set('Asia/Kolkata');
    }

    protected function _initAppAutoload() 
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'App',
            'basePath'  => dirname(__FILE__),));
        return $autoloader;
    }

    protected function _initLayoutHelper() 
    {
        $this->bootstrap('frontController');
        $layout = Zend_Controller_Action_HelperBroker::addHelper(new Mod_Controller_Action_Helper_LayoutLoader());
     }

    protected function _initView() 
    {
        $view = new Zend_View();
        $view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewRenderer->setView($view);
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
    }

    public function _inittranslate() 
    {

        $translate = new Zend_Translate(
        array(
            'adapter' => 'gettext',
            'content' => APPLICATION_PATH.'/languages/default.mo',
            'locale'  => 'en'));

//         $translate->addTranslation(
//         array(
//               'content' => APPLICATION_PATH.'/languages/hindi.mo',
//               'locale'  => 'hi_IN'));

//         $sessionName = new Zend_Session_Namespace('ourbank');
//         $translate->setLocale($sessionName->__get('language'));

        Zend_Registry::set('Zend_Translate', $translate);
    }
	public function _initRest()
    {
        $front     = Zend_Controller_Front::getInstance();
		$restRoute = new Zend_Rest_Route($front, array(), array('product'));
		$front->getRouter()->addRoute('rest', $restRoute);
    }
   

    


}
