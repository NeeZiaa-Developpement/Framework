<?php

namespace NeeZiaa\Twig;

use NeeZiaa\Utils\Exception;
use Twig\Extension\AbstractExtension;
use NeeZiaa\Utils\Alert;

class OthersExtension extends AbstractExtension {

    /**
     * @throws Exception
     */
    public function alert(): string
    {
        return Alert::show();
    }

}