<?php namespace Mustache; use Laravel;

class Mustache {

    public static function Comb() {
        Laravel\Event::listen(View::engine, function($view)
        {
            // Only Fire for .mustache files
            if ( ! str_contains($view->path, '.mustache'))
            {
                return;
            }

            // JSON_PRETTY_PRINT only avail in php 5.4+
            if ( ! defined('JSON_PRETTY_PRINT') )
                define('JSON_PRETTY_PRINT', FALSE);

            Laravel\Event::fire("laravel.composing: {$view->view}", array($view));
            Laravel\Log::info('<strong>Source Data (JSON Encoded) Passed to Template:</strong> ' . "<br><pre>" . json_encode($view->data, JSON_PRETTY_PRINT) . '</pre>');

            ob_start();

            try {
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
