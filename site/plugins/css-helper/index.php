<?php 
    Kirby::plugin('my/css', [
    'components' => [
        'css' => function (Kirby\Cms\App $kirby, string $url, $options = null): string {
            $relative_url = Url::path($url, false);
            $file_root = $kirby->root('index') . DS . $relative_url;

            if (F::exists($file_root)) {
                return url($relative_url . '?' . F::modified($file_root));
            }

            return $url;
        }
    ]
    ]);