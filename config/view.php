<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Template Engine [EXPERIMENTAL]
    |--------------------------------------------------------------------------
    |
    | Leaf MVC unlike other frameworks tries to give you as much control as
    | you need. As such, you can decide which view engine to use.
    |
    */
    'viewEngine' => \Leaf\Blade::class,

    /*
    |--------------------------------------------------------------------------
    | Custom config method
    |--------------------------------------------------------------------------
    |
    | Configuration for your templating engine.
    |
    */
    'config' => function ($config) {
        $blade = \Leaf\Config::get('views.blade')->configure($config['views'], $config['cache']);

        $blade->addExtension('blade.js', 'blade');

        # Route directive
        $blade->compiler()->directive('route', function ($expression) {
            return "<?php echo route($expression); ?>";
        });

        # Script directive
        $blade->compiler()->directive('script', function ($expression, $type = 'module') {
            
            $expression = trim($expression, "()'\"");

            $scriptTag = "<script>" . PHP_EOL;
            if($type == 'module')
                $scriptTag = "<script type=\'module\'>" . PHP_EOL;

            return <<<HTML
            <?php
                \$view = str_replace('.', '/', '$expression');
                \$filePath = trim(ViewsPath(\$view . '.blade.js'), '//');
                if (file_exists(\$filePath)) {
                    \$__env->startPush('scripts');
                    echo '$scriptTag';
                    echo \$__env->make('$expression', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render() . PHP_EOL;
                    echo chr(60) . "/script" . chr(62);
                    \$__env->stopPush();
                }
            ?>
            HTML;
        });
    },

    /*
    |--------------------------------------------------------------------------
    | Custom render method
    |--------------------------------------------------------------------------
    |
    | This render method is triggered whenever render() is called
    | in your app if you're using a custom view engine.
    |
    */
    'render' => null,
];
