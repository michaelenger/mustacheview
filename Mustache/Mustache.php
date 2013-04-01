<?php namespace Mustache; use Laravel;

class Mustache {

    public static function Comb() {
        Laravel\Event::listen(View::engine, function($view)
        {
            // The Blade view engine should only handle the rendering of views which
            // end with the Blade extension. If the given view does not, we will
            // return false so the View can be rendered as normal.
            if ( ! str_contains($view->path, '.mustache'))
            {
                return;
            }

            if ( ! defined('JSON_PRETTY_PRINT') )
            define('JSON_PRETTY_PRINT', FALSE);

            Laravel\Event::fire("laravel.composing: {$view->view}", array($view));
            Laravel\Log::info('<strong>Source Data (JSON Encoded) Passed to Template:</strong> ' . "<br><pre>" . json_encode($view->data, JSON_PRETTY_PRINT) . '</pre>');

            ob_start();

            try {

                // $m = new Engine(array('cache' => 'storage/cache', 'template_class_prefix' => 'Mustache_Template_'));
                $m = new Engine(array(
                    'template_class_prefix' => 'Mustache_Template_',
                    'partials_loader' => new Loader\FilesystemLoader(path('app').'/views'),
                    ));

                print $m->render(file_get_contents($view->path), $view->data);

            } catch(\Exception $e) {ob_get_clean(); throw $e;}

            return ob_get_clean();
        });
    }
}
