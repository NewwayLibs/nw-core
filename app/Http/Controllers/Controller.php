<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Libraries\FlashMessageBag;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use YAAP\Theme\Facades\Theme;


/**
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class Controller extends BaseController
{

    use DispatchesJobs, ValidatesRequests;

    public $viewData = array();
    public $_theme = '';
    public $_view = '';
    public $messageBag;


    /**
     * Constructor
     */
    public function __construct()
    {

        // @todo - Collect client info
        //$this->clientInfo();

        // @todo - Collect device info
        // $this->deviceInfo();

        // Init
        $this->init();


        $this->messageBag = new FlashMessageBag(App::make('session'));

    }


    /* ------------------------------------------------------------------------------------------------------------------------

    Templating methods

    ------------------------------------------------------------------------------------------------------------------------ */

    public function render($view = '', array $data = array())
    {

        if (count($data) === 0) {
            foreach ($data as $k => $v) {
                $this->data($k, $v);
            }
        }

        if (empty($view) || !View::exists($view)) {
            $view = $this->_view;
        }

        if (View::exists($view)) {
            return View::make($view, $this->viewData)->with('messages', $this->getMessageBag());
        }

        return View::make('noexist', array('message' => 'View <strong>' . $view . '</strong> doesn\'t exist'));

    }


    public function data(/*array or pair of values*/)
    {

        $data = func_get_args();

        if (count($data) === 0) {
            if (count($data) > 1) {
                $this->viewData[$data[0]] = $data[1];
            } elseif (is_array($data[0])) {
                $this->viewData = array_merge($this->viewData, $data[0]);
            } else {
                return false;
            }
        }

        return true;
    }


    /* ------------------------------------------------------------------------------------------------------------------------

    Application base data collectors

    ------------------------------------------------------------------------------------------------------------------------ */
    function deviceInfo()
    {


        $client = Client::get_instance();

        // Referral
        $client->referrer = Useragent::referrer();

        // Heavy detections will be cached in cookie
        $cookieStore = array('device', 'browser', 'browserVersion', 'os', 'country', 'city', 'lat', 'lon', 'timezone');


        $device_info_cookie = Cookie::get('device_info');
        if ($device_info_cookie && $device_info_cookie = json_decode($device_info_cookie)) {
            foreach ($cookieStore as $key) {
                $client->{$key} = $device_info_cookie->{$key};
            }
        } else {
            // Device and browser
            // Use Mobile_Detect for better device recognition
            $client->device = Useragent::is_mobile() ? 'phone' : 'computer';
            $client->browser = Useragent::browser();
            $client->browserVersion = Useragent::version();
            $client->os = Useragent::platform();

            // Geolocation
            // Defaults to Kyiv

            $gb = new IPGeoBase();
            $geo = $gb->getRecord($client->ip);

            $client->country = empty($geo['cc']) ? 'UA' : $geo['cc'];
            $client->city = empty($geo['city']) ? 'Киев' : $geo['city'];
            $client->lat = empty($geo['lat']) ? 50.4501 : $geo['lat'];
            $client->lon = empty($geo['lon']) ? 30.5234 : $geo['lon'];
            $client->timezone = empty($geo['timezone']) ? Config::get(
                    'application.timezone',
                    'Europe/Kiev'
            ) : $geo['timezone'];


            $cookieStoreData = new \stdClass();
            foreach ($cookieStore as $key) {
                $cookieStoreData->{$key} = $client->{$key};
            }

            Cookie::make('device_info', json_encode($cookieStoreData), 60 * 60 * 4);
        }

    }


    // Get client info (lang, location etc)
    private function clientInfo()
    {

        $client = Client::get_instance();

        $forvard = getenv('HTTP_X_FORWARDED_FOR');
        $client->ip = !empty($forvard) ? $forvard : isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;

    }


    private function init()
    {

        if (!empty($this->_theme)) {
            Theme::init($this->_theme);
        }

    }

    public function message($message, $type = 'info')
    {

        $this->messageBag->add($type, $message)->flash();
    }

    public function getMessages($type = 'info')
    {

        return $this->messageBag->get($type);
    }

    public function getMessagesCount($type = 'info')
    {

        return $this->messageBag->count($type);
    }

    public function getFirstMessage($type = 'info')
    {

        return $this->messageBag->first($type);
    }

    public function getMessageBag()
    {

        return $this->messageBag;
    }
}