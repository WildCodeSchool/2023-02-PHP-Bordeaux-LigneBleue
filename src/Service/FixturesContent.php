<?php

namespace App\Service;

class FixturesContent
{
    public array $themes;

    public static function getThemes(): array
    {
        return [
            [
                "title" => "Communication",
                "indexOrder" => 1,
                "iconPath" => "smartphone/communications/llb-icon-message.png",
                "categoryRef" => "category_Smartphone",
                "themeRef" => 'Smartphone'
            ],
            [
                "title" => "Hardware",
                "indexOrder" => 2,
                "iconPath" => "smartphone/hardware/llb-icon-hardware.png",
                "categoryRef" => "category_Smartphone",
                "themeRef" => 'Smartphone'
            ],
            [
                "title" => "Software",
                "indexOrder" => 3,
                "iconPath" => "smartphone/software/llb-icon-software.png",
                "categoryRef" => "category_Smartphone",
                "themeRef" => 'Smartphone'
            ],
            [
                "title" => "Hardware",
                "indexOrder" => 1,
                "iconPath" => "desktop/hardware/llb-icon-desktop.png",
                "categoryRef" => "category_Ordinateur",
                "themeRef" => 'Computer'
            ],
            [
                "title" => "Internet",
                "indexOrder" => 2,
                "iconPath" => "desktop/browser/llb-icon-browser.png",
                "categoryRef" => "category_Ordinateur",
                "themeRef" => 'Computer'
            ],
            [
                "title" => "Communications",
                "indexOrder" => 3,
                "iconPath" => "desktop/communications/llb-icon-paperPlane.png",
                "categoryRef" => "category_Ordinateur",
                "themeRef" => 'Computer'
            ],
            [
                "title" => "Accessoires Connectés",
                "indexOrder" => 1,
                "iconPath" => "others/accessories/llb-icon-watch.png",
                "categoryRef" => "category_Autres",
                "themeRef" => 'Others'
            ],
            [
                "title" => "Box Internet",
                "indexOrder" => 2,
                "iconPath" => "others/boxInternet/llb-icon-server.png",
                "categoryRef" => "category_Autres",
                "themeRef" => 'Others'
            ],
            [
                "title" => "TVs Connectées",
                "indexOrder" => 3,
                "iconPath" => "others/smartTvs/llb-icon-smartTV.png",
                "categoryRef" => "category_Autres",
                "themeRef" => 'Others'
            ]
        ];
    }
}
