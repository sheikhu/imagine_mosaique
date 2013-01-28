<?php

class Mosaique
{

	protected $params = array();

	protected $filters = array();


	public function __construct($params = array())
	{
		$this->params = $params;

		$this->filters = isset($params['filters'])? $params['filters'] : array() ;
	}




	public function generate()
	{
		$images = glob($this->params['source']. '/*.{' . implode(',', $this->filters) . '}', GLOB_BRACE);


		$imagine = new Imagine\Gd\Imagine();


		// Longeur de la mosaique : longeur_image * nombre_images / par_ligne

		$moz_width = $this->params['width'] * $this->params['per_line'];

		$moz_height = $this->params['height'] * ceil(count($images) / $this->params['per_line']);

		$size = new Imagine\Image\Box($moz_width ,$moz_height);

		// echo $moz_width.'<br>';

		// echo $moz_height.'<br>';

		// exit;
		$mosaic = $imagine->create($size);

		$x = 0;

		$y = 0;

		$start = microtime(true);

		foreach ($images as $image) {

			$width = $this->params['width'];

			$height = $this->params['height'];

			$photo = $imagine->open($image)->resize(new Imagine\Image\Box($width, $height));

			$mosaic->paste($photo, new Imagine\Image\Point($x, $y));

			$x += $width;

			if($x >= $width * $this->params['per_line'])
			{
				$x = 0;

				$y += $height;
			}

			if($height >= $height * ceil(count($images) / $this->params['per_line']))
				break;

			sleep(5/1000);


		}

		$mosaic->save($this->params['output']);

		echo 'Mosaique generee en '. (microtime(true) - $start) . 's';
	}
}

 ?>