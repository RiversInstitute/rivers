<?php
use Kirby\Cms\Page;
use Kirby\Toolkit\Str;

class PublicationPage extends Page
{

    public static function create(array $props): Page
    {
        $props['slug'] = Str::slug($props['content']['title'] . "-" . "publication");
        return parent::create($props);
    }
}