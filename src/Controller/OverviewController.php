<?php

declare(strict_types=1);

namespace Src\Controller;

use Twig\Environment;

class OverviewController implements HtmlControllerInterface
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(): void
    {
        //@todo finish code

        $template = $this->twig->load('overview.html.twig');
        $template->display();
    }
}
