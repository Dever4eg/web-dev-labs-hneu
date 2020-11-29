<?php

namespace src;

class ViewRenderer
{
    private string $templatePath;
    private string $defaultLayout;

    private array $options = [];

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

    /**
     * Renders php template into a string
     *
     * @param string $view template file name
     * @param array $options template variables
     * @param null $layout layout name
     * @return string
     */
    public function render(string $view, array $options = [], $layout = null): string
    {
        $options = array_merge($this->options, $options);

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

    public function addOptions(array $options)
    {
        $this->options = array_merge(
            $this->options,
            $options
        );
    }
}
