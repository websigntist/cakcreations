<?php
/**
 * Developed by Adnan Bashir.
 * Email: pisces_adnan@hotmail.com
 * Autour: Adnan Bashir
 * Date: 5/30/12
 * Time: 12:56 AM
 */


if (!defined('BASEPATH')) exit('No direct script access allowed');

class _Image extends Gregwar\Image\Image
{

    protected $cacheDir = 'assets/cache/images';

    function __construct($originalFile = null, $width = null, $height = null)
    {
        $this->setCacheDir('assets/cache/images');

        $filename = explode('.', urlencode(end(explode('/', $originalFile))))[0];
        $this->setPrettyName($filename);

        parent::__construct($originalFile, $width, $height);
    }



    public function show()
    {
            return base_url($this->cacheFile('png', 100));
    }

}

