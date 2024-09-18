<?php

declare(strict_types=1);

namespace Src\Controller;

use Twig\Environment;

class CreateController implements HtmlControllerInterface
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(): void
    {
        //@todo finish code

        $template = $this->twig->load('create.html.twig');
        $template->display();
    }
}
