<?php namespace Mustache; use Laravel;

class View extends Laravel\View {

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
