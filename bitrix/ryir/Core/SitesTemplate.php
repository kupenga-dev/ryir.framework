<?php

namespace Ryir\Core;

use App\Services\Config;


class SitesTemplate
{

    use \Ryir\Core\Traits\SingletonTrait;
    public $id;
    private $__path;

    private function __construct()
    {
        $this->id = Config::get('template_id');
    }
    public function setPath($docroot)
    {
        $this->__path = $docroot . "/templates/" . $this->id;
    }
    public function getHeader()
    {
        include $this->__path . "/header.php";
    }

    public function getFooter()
    {
        include $this->__path . "/footer.php";
    }
}
