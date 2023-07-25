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
                "Maison Connectées",
                3,
                "others/smartHome/llb-icon-home.png",
                "category_Autres",
                'Others'
            ]
        ];
    }

    public static function getAllTutorialsContent(): array
    {
        return array_merge(
            self::getTutorialSmartphoneContent(),
            self::getTutorialComputerContent(),
            self::getTutorialOthersContent()
        );
    }

    public static function getTutorialSmartphoneContent(): array
    {
        return [
            ////////////SMARTPHONE COMMUNICATION/////////////////
            [
                "title" => "Appeler un proche",
                "objective" => "Apprendre à appeler un proche depuis un smartphone",
                "isPublished" => true,
                "indexOrder" => 1,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Smartphone_Communication",
                "tagRef" => "tag_Débutant",
                "categoryRef" => "Smartphone",
                "tutorialRef" => "Smartphone_Communication_Phone"
            ],
            [
                "title" => "Envoyer des SMS",
                "objective" => "Apprendre à envoyer un SMS depuis un smartphone",
                "isPublished" => true,
                "indexOrder" => 2,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Smartphone_Communication",
                "tagRef" => "tag_Intermédiaire",
                "categoryRef" => "Smartphone",
                "tutorialRef" => "Smartphone_Communication_SMS"
            ],
            [
                "title" => "Utiliser Whatsapp",
                "objective" => "Apprendre à enoyer des messages et passer un appel avec l'application Whatsapp",
                "isPublished" => true,
                "indexOrder" => 3,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Smartphone_Communication",
                "tagRef" => "tag_Avancé",
                "categoryRef" => "Smartphone",
                "tutorialRef" => "Smartphone_Communication_Whatsapp"
            ],
            ////////////SMARTPHONE HARDWARE/////////////////
            [
                "title" => "Utiliser l'Écran Tactile",
                "objective" => "Apprendre à manipuler l'écran tactile d'un smartphone",
                "isPublished" => true,
                "indexOrder" => 1,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Smartphone_Hardware",
                "tagRef" => "tag_Débutant",
                "categoryRef" => "Smartphone",
                "tutorialRef" => "Smartphone_Hardware_TouchScreen"
            ],
            [
                "title" => "Utiliser l'Appareil Photo",
                "objective" => "Apprendre à prendre des photos et des vidéo avec l'application Appareil Photo ",
                "isPublished" => true,
                "indexOrder" => 2,
                "picturePath" => "mbl-takePicture.jpeg",
                "themeRef" => "theme_Smartphone_Hardware",
                "tagRef" => "tag_Intermédiaire",
                "categoryRef" => "Smartphone",
                "tutorialRef" => "Smartphone_Hardware_Camera"
            ],
            [
                "title" => "Se Connecter au Wi-Fi",
                "objective" => "Apprendre à connecter son smartphone au réseau Wi-Fi",
                "isPublished" => true,
                "indexOrder" => 3,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Smartphone_Hardware",
                "tagRef" => "tag_Avancé",
                "categoryRef" => "Smartphone",
                "tutorialRef" => "Smartphone_Hardware_Wifi"
            ],
            ////////////SMARTPHONE SOFTWARE/////////////////
            [
                "title" => "Regarder des vidéos sur Youtube",
                "objective" => "Apprendre à télécharger l'application Youtube et regarder des vidéos",
                "isPublished" => true,
                "indexOrder" => 1,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Smartphone_Software",
                "tagRef" => "tag_Débutant",
                "categoryRef" => "Smartphone",
                "tutorialRef" => "Smartphone_Software_Youtube"
            ],
            [
                "title" => "Acceder à son compte Facebook",
                "objective" => "Apprendre à télécharger l'application Facebook et se connecter à son compte",
                "isPublished" => true,
                "indexOrder" => 2,
                "picturePath" => "mbl-facebook.jpg",
                "themeRef" => "theme_Smartphone_Software",
                "tagRef" => "tag_Intermédiaire",
                "categoryRef" => "Smartphone",
                "tutorialRef" => "Smartphone_Software_Facebook"
            ],
            [
                "title" => "Écouter de la musique avec Spotify",
                "objective" => "Apprendre à télécharger l'application Spotify et écouter de la musique",
                "isPublished" => true,
                "indexOrder" => 3,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Smartphone_Software",
                "tagRef" => "tag_Avancé",
                "categoryRef" => "Smartphone",
                "tutorialRef" => "Smartphone_Software_Spotify"
            ],
        ];
    }

    public static function getTutorialComputerContent(): array
    {
        return [
            ////////////COMPUTER INTERNET/////////////////
            [
                "title" => "Utiliser la Navigateur Internet",
                "objective" => "Apprendre à utiliser le navigateur internet",
                "isPublished" => true,
                "indexOrder" => 1,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Computer_Internet",
                "tagRef" => "tag_Débutant",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Internet_Browser"
            ],
            [
                "title" => "Regarder la Télévision",
                "objective" => "Apprendre à regarder des chaînes de télévision depuis un navigateur internet",
                "isPublished" => true,
                "indexOrder" => 2,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Computer_Internet",
                "tagRef" => "tag_Intermédiaire",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Internet_TV"
            ],
            [
                "title" => "Accéder à Amazon",
                "objective" => "Apprendre à acceder à Amazon depuis un navigateur internet",
                "isPublished" => true,
                "indexOrder" => 3,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Computer_Internet",
                "tagRef" => "tag_Avancé",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Internet_Amazon"
            ],
            ////////////COMPUTER HARDWARE/////////////////
            [
                "title" => "Utiliser la Souris",
                "objective" => "Apprendre à utliser une souris d'ordinateur",
                "isPublished" => true,
                "indexOrder" => 1,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Computer_Hardware",
                "tagRef" => "tag_Débutant",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Hardware_Mouse"
            ],
            [
                "title" => "Utiliser le Clavier",
                "objective" => "Apprendre à utliser un clavier d'ordinateur",
                "isPublished" => true,
                "indexOrder" => 2,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Computer_Hardware",
                "tagRef" => "tag_Intermédiaire",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Hardware_Keyboard"
            ],
            [
                "title" => "Se Connecter au Wifi",
                "objective" => "Apprendre à connecter son ordinateur au réseau Wi-Fi",
                "isPublished" => true,
                "indexOrder" => 3,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Computer_Hardware",
                "tagRef" => "tag_Avancé",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Hardware_Wifi"
            ],
            ////////////COMPUTER COMMUNICATION/////////////////
            [
                "title" => "Allumer et Éteindre son Ordinateur",
                "objective" => "Apprendre à allumer et éteindre son Ordinateur",
                "isPublished" => true,
                "indexOrder" => 3,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Computer_Communications",
                "tagRef" => "tag_Débutant",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Communications_Power"
            ],
            [
                "title" => "Envoyer un E-Mail",
                "objective" => "Apprendre à envoyer un E-Mail",
                "isPublished" => true,
                "indexOrder" => 1,
                "picturePath" => "cmp-mail.jpeg",
                "themeRef" => "theme_Computer_Communications",
                "tagRef" => "tag_Intermédiaire",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Communications_Mail"
            ],
            [
                "title" => "Passer un appel Vidéo",
                "objective" => "Apprendre passer un appel vidéo",
                "isPublished" => true,
                "indexOrder" => 2,
                "picturePath" => "cmp-webcam.png",
                "themeRef" => "theme_Computer_Communications",
                "tagRef" => "tag_Avancé",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Communications_videoCall"
            ],
        ];
    }

    public static function getTutorialOthersContent(): array
    {
        return [
            //////////////// ACCESSOIRES CONNECTES ///////////////////////
            [
                "title" => "Utiliser une Smart Watch",
                "objective" => "Apprendre utiliser une montre connectée",
                "isPublished" => true,
                "indexOrder" => 1,
                "picturePath" => "oth-smartWatch.jpeg",
                "themeRef" => "theme_Others_Accessoires-Connectes",
                "tagRef" => "tag_Avancé",
                "categoryRef" => "Others",
                "tutorialRef" => "Others_Accessoires-Connectes_SmartWatch"
            ],
            //////////////// BOX INTERNET ///////////////////////
            [
                "title" => "Configurer sa Box Internet",
                "objective" => "Apprendre à mettre en place sa Box Internet",
                "isPublished" => true,
                "indexOrder" => 1,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Others_Box-Internet",
                "tagRef" => "tag_Avancé",
                "categoryRef" => "Others",
                "tutorialRef" => "Others_Box-Internet_Box-Internet"
            ],
            //////////////// Smart Home ///////////////////////
            [
                "title" => "Configurer sa Smart TV",
                "objective" => "Apprendre à mettre en place sa TV connectée",
                "isPublished" => true,
                "indexOrder" => 1,
                "picturePath" => "mbl-sms.jpg",
                "themeRef" => "theme_Others_Maison-Connectees",
                "tagRef" => "tag_Intermédiaire",
                "categoryRef" => "Others",
                "tutorialRef" => "Others_Maison-Connectees_Smart-TV"
            ],
        ];
    }
}
