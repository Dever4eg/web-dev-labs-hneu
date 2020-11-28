<?php

namespace src;

class ViewRenderer
{
    private $templatePath;
    private $defaultLayout;

    public function __construct($templatePath, $defaultLayout)
    {
        $this->templatePath = $templatePath;
        $this->defaultLayout = $defaultLayout;
    }

    public function show(string $view, array $options = [], $layout = null)
    {
        $result = $this->render($view, $options, $layout);
        echo $result;
    }

    public function render(string $view, array $options = [], $layout = null): string
    {
        foreach($options as $key => $val)
        {
            $$key = $val;
        }

        ob_start();
        require $this->templatePath . $view . '.php';
        $content = ob_get_clean();

        $layout = $layout ? $layout : $this->defaultLayout;
        if ($layout) {
            ob_start();
            require $this->templatePath . $layout . '.php';
            $content = ob_get_clean();
        }

        return $content;
    }
}
