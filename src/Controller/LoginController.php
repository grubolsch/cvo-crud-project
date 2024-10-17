<?php

declare(strict_types=1);

namespace Src\Controller;

use Twig\Environment;

class LoginController implements HtmlControllerInterface
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(): void
    {
        //@todo finish code

        var_dump($_POST);
        exit;

        $template = $this->twig->load('login.html.twig');
        $template->display();
    }
}
