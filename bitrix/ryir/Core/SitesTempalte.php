<?php

namespace Ryir\Core;
//

class SitesTempalte
{

    use \Ryir\Core\Traits\SingletonTrait;
    public $id;
    private $__path;

    private function __construct()
    {
        $this->id = \App\Services\Config::get('template_id');
        $this->__path = $_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->id;
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