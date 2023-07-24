<?php

namespace App\Service;

class FixturesContent
{
    public array $themes;

    public static function getThemes(): array
    {
        return [
            [
                "Communication",
                1,
                "smartphone/communications/llb-icon-message.png",
                "category_Smartphone",
                'Smartphone'
            ],
            [
                "Hardware",
                2,
                "smartphone/hardware/llb-icon-hardware.png",
                "category_Smartphone",
                'Smartphone'
            ],
            [
                "Software",
                3,
                "smartphone/software/llb-icon-software.png",
                "category_Smartphone",
                'Smartphone'
            ],
            [
                "Hardware",
                1,
                "desktop/hardware/llb-icon-desktop.png",
                "category_Ordinateur",
                'Computer'
            ],
            [
                "Internet",
                2,
                "desktop/browser/llb-icon-browser.png",
                "category_Ordinateur",
                'Computer'
            ],
            [
                "Communications",
                3,
                "desktop/communications/llb-icon-paperPlane.png",
                "category_Ordinateur",
                'Computer'
            ],
            [
                "Accessoires Connectés",
                1,
                "others/accessories/llb-icon-watch.png",
                "category_Autres",
                'Others'
            ],
            [
                "Box Internet",
                2,
                "others/boxInternet/llb-icon-server.png",
                "category_Autres",
                'Others'
            ],
            [
                "TVs Connectées",
                3,
                "others/smartTvs/llb-icon-smartTV.png",
                "category_Autres",
                'Others'
            ]
        ];
    }
}
