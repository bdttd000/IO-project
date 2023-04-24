<?php

session_start();

class AppController
{

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/' . $template . '.php';
        $output = 'File not found';

        if (file_exists($templatePath)) {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }

    public function redirectToHome()
    {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}");
    }
}