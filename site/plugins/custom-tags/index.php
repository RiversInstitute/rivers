<?php
Kirby::plugin('rivers/custom-tags', [

    'tags' => [
        'snippet' => [
            'html' => function($tag) {
                $snippetName = $tag->value();
                return snippet($snippetName, [], true);
            }
        ]
    ]
]);