<?php namespace Indikator\News\Controllers;

use Backend\Classes\Controller;
use Indikator\News\Classes\Logger;
use Indikator\News\Models\Logs;
use Redirect;
use Request;

class Newsletter extends Controller
{
    /**
     * @var array Defines a collection of actions available without authentication.
     */
    protected $publicActions = ['image', 'open', 'confirm'];

    /**
     * Log the mail open and output a 1x1 image.
     * @param  integer $id
     * @param  string $hash
     * @return void
     */
    public function image($id = null, $hash = null)
    {
        $hash = str_replace('.png', '', $hash);
        $log  = Logs::where('hash', $hash)->find($id);

        if ($log) {
            Logger::viewed($log->id);
        }

        header('Content-Type: image/png');
        header('Cache-Control: no-cache, max-age=0');

        echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');
        die;
    }

    public function open($id = null, $hash = null)
    {
        $url = Request::get('url', url('/'));
        $log = Logs::where('hash', $hash)->find($id);

        if ($log) {
            Logger::clicked($log->id);
        }

        return Redirect::to($url);
    }
}
