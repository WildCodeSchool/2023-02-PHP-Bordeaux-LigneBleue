<?php

namespace App\Service;

use Faker\Factory;

class FixturesContent
{
    public array $themes;

    public static function getThemesContent(): array
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
                "title" => "Accessoires",
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
                "title" => "Maison Connectée",
                "indexOrder" => 3,
                "iconPath" => "others/smartHome/llb-icon-home.png",
                "categoryRef" => "category_Autres",
                "themeRef" => 'Others'
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
                "picturePath" => "call.jpg",
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
                "picturePath" => "sms.jpeg",
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
                "picturePath" => "whatsapp.jpeg",
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
                "picturePath" => "tactile.jpg",
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
                "picturePath" => "picture-smartphone.jpg",
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
                "picturePath" => "wifi-smartphone.jpeg",
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
                "picturePath" => "youtube.jpeg",
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
                "picturePath" => "facebook.jpg",
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
                "picturePath" => "spotify.jpeg",
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
                "title" => "Utiliser le Navigateur Internet",
                "objective" => "Apprendre à utiliser le navigateur internet",
                "isPublished" => true,
                "indexOrder" => 1,
                "picturePath" => "navigateurs.jpg",
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
                "picturePath" => "tv-computer.jpg",
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
                "picturePath" => "amazon.jpeg",
                "themeRef" => "theme_Computer_Internet",
                "tagRef" => "tag_Avancé",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Internet_Amazon"
            ],
            ////////////COMPUTER HARDWARE/////////////////
            [
                "title" => "Utiliser la Souris",
                "objective" => "Apprendre à utiliser une souris d'ordinateur",
                "isPublished" => true,
                "indexOrder" => 1,
                "picturePath" => "souris.jpeg",
                "themeRef" => "theme_Computer_Hardware",
                "tagRef" => "tag_Débutant",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Hardware_Mouse"
            ],
            [
                "title" => "Utiliser le Clavier",
                "objective" => "Apprendre à utiliser un clavier d'ordinateur",
                "isPublished" => true,
                "indexOrder" => 2,
                "picturePath" => "clavier.jpeg",
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
                "picturePath" => "wifi-computer.jpg",
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
                "picturePath" => "bouton-ordi.jpeg",
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
                "picturePath" => "mail-computer.jpeg",
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
                "picturePath" => "call-computer.jpeg",
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
                "picturePath" => "box.jpeg",
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
                "picturePath" => "smartTV.jpeg",
                "themeRef" => "theme_Others_Maison-Connectee",
                "tagRef" => "tag_Intermédiaire",
                "categoryRef" => "Others",
                "tutorialRef" => "Others_Maison-Connectee_Smart-TV"
            ],
        ];
    }

    public static function getAllSequencesContent(): array
    {
        return array_merge(
            self::getSequenceCustomContent(),
            self::getSequenceGenericContent()
        );
    }

    public static function getTutorialRefs(): array
    {
        return [
            // "tutorial_Smartphone_Communication_Phone",
            "tutorial_Smartphone_Communication_SMS",
            "tutorial_Smartphone_Communication_Whatsapp",
            "tutorial_Smartphone_Hardware_TouchScreen",
            "tutorial_Smartphone_Hardware_Camera",
            "tutorial_Smartphone_Hardware_Wifi",
            "tutorial_Smartphone_Software_Youtube",
            "tutorial_Smartphone_Software_Facebook",
            "tutorial_Smartphone_Software_Spotify",
            "tutorial_Computer_Internet_Browser",
            "tutorial_Computer_Internet_TV",
            "tutorial_Computer_Internet_Amazon",
            "tutorial_Computer_Hardware_Mouse",
            "tutorial_Computer_Hardware_Keyboard",
            "tutorial_Computer_Hardware_Wifi",
            "tutorial_Computer_Communications_Power",
            "tutorial_Computer_Communications_Mail",
            "tutorial_Computer_Communications_videoCall",
            "tutorial_Others_Accessoires-Connectes_SmartWatch",
            "tutorial_Others_Box-Internet_Box-Internet",
            "tutorial_Others_Maison-Connectee_Smart-TV",
        ];
    }

    public static function getSequenceCustomContent(): array
    {
        $faker = Factory::create();

        return [
            [
                "title" => "Taper un numéros de téléphone",
                "content" => $faker->paragraph(10, true),
                "exercice" => false,
                "indexOrder" => 1,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Smartphone_Communication_Phone"
            ],
            [
                "title" => "Enregistrer un Numéros",
                "content" => $faker->paragraph(10, true),
                "exercice" => true,
                "indexOrder" => 1,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Smartphone_Communication_Phone"
            ],
            [
                "title" => "Appeler un Contact",
                "content" => $faker->paragraph(10, true),
                "exercice" => false,
                "indexOrder" => 1,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Smartphone_Communication_Phone"
            ],
            [
                "title" => "Écouter ses Messages Vocaux",
                "content" => $faker->paragraph(10, true),
                "exercice" => false,
                "indexOrder" => 1,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Smartphone_Communication_Phone"
            ],
        ];
    }

    public static function getSequenceGenericContent(): array
    {
        $faker = Factory::create();
        $tutorialRefs = self::getTutorialRefs();

        $sequences = [];
        foreach ($tutorialRefs as $tutorialRef) {
            for ($i = 0; $i < rand(3, 7); $i++) {
                $sequences[] = [
                    "title" => $faker->sentence(),
                    "content" => $faker->paragraph(10, true),
                    "exercice" => rand(1, 4) == 4,
                    "indexOrder" => $i + 1,
                    "picturePath" => "mbl-sms.jpg",
                    "tutorialRef" => $tutorialRef
                ];
            }
        }

        return $sequences;
    }
}
