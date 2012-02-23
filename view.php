<?php namespace Mustache; use Laravel;

class View extends Laravel\View {

	/**
	 * Get the path to a given view on disk.
	 *
	 * @param  string  $view
	 * @return string
	 */
	protected function path($view) {
		$view = str_replace('.', '/', $view);

		$root = Laravel\Bundle::path(Laravel\Bundle::name($view)).'views/';

		// Use the ".mustache" extension for mustache files and the default bladed
		// extension for compiled templates.
		foreach (array('.mustache', BLADE_EXT) as $extension)
		{
			if (file_exists($path = $root.Laravel\Bundle::element($view).$extension))
			{
				return $path;
			}
		}

		throw new \Exception("View [$view] does not exist.");
	}

	/**
	 * Get the evaluated string content of the view.
	 *
	 * @return string
	 */
	public function render() {
		// Events ^^
		Laravel\Event::fire("laravel.composing: {$this->view}", array($this));

		ob_start();

		// Use the default BLADE_EXT value
		if (strpos($this->path, BLADE_EXT) !== false) {
			$this->path = $this->compile();
		}

		try {
			$m = new Mustache();
			print $m->render(file_get_contents($this->path), $this->data);
		} catch(\Exception $e) {ob_get_clean(); throw $e;}

		return ob_get_clean();
	}

}
