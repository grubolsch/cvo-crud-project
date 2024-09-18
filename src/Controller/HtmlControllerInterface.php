<?php

declare(strict_types=1);

namespace Src\Controller;

interface HtmlControllerInterface
{
    public function render() : void;
}