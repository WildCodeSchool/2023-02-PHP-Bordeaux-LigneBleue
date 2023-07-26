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
                "title" => "Comment appeler un proche",
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
                "title" => "Comment envoyer des SMS",
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
                "title" => "Comment utiliser Whatsapp",
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
                "title" => "Comment utiliser l'Écran Tactile",
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
                "title" => "Comment tiliser l'Appareil Photo",
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
                "title" => "Comment se Connecter au Wi-Fi",
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
                "title" => "Comment regarder des vidéos sur Youtube",
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
                "title" => "comment accéder à son compte Facebook",
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
                "title" => "comment écouter de la musique avec Spotify",
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
                "title" => "Comment regarder la Télévision",
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
                "title" => "Comment lancer une recherche sur internet",
                "objective" => "Apprendre à rechercher des informations sur internet",
                "isPublished" => true,
                "indexOrder" => 3,
                "picturePath" => "amazon.jpeg",
                "themeRef" => "theme_Computer_Internet",
                "tagRef" => "tag_Avancé",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Internet_Search"
            ],
            ////////////COMPUTER HARDWARE/////////////////
            [
                "title" => "Comment utiliser la Souris",
                "objective" => "Apprendre à utliser une souris d'ordinateur",
                "isPublished" => true,
                "indexOrder" => 1,
                "picturePath" => "souris.jpeg",
                "themeRef" => "theme_Computer_Hardware",
                "tagRef" => "tag_Débutant",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Hardware_Mouse"
            ],
            [
                "title" => "Comment utiliser le Clavier",
                "objective" => "Apprendre à utliser un clavier d'ordinateur",
                "isPublished" => true,
                "indexOrder" => 2,
                "picturePath" => "clavier.jpeg",
                "themeRef" => "theme_Computer_Hardware",
                "tagRef" => "tag_Intermédiaire",
                "categoryRef" => "Ordinateur",
                "tutorialRef" => "Computer_Hardware_Keyboard"
            ],
            [
                "title" => "Comment se Connecter au Wifi",
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
                "title" => "comment allumer et Éteindre son Ordinateur",
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
                "title" => "Comment envoyer un E-Mail",
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
                "title" => "Comment passer un appel Vidéo",
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
                "title" => "Comment utiliser une Smart Watch",
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
                "title" => "Comment configurer sa Box Internet",
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
                "title" => "Comment configurer sa Smart TV",
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

    public static function getTutorialRefs(): array
    {
        return [
            "tutorial_Smartphone_Communication_Phone",
            "tutorial_Smartphone_Communication_SMS",
            "tutorial_Smartphone_Communication_Whatsapp",
            "tutorial_Smartphone_Hardware_TouchScreen",
            "tutorial_Smartphone_Hardware_Camera",
            "tutorial_Smartphone_Hardware_Wifi",
            "tutorial_Smartphone_Software_Youtube",
            "tutorial_Smartphone_Software_Facebook",
            "tutorial_Smartphone_Software_Spotify",
            "tutorial_Computer_Internet_TV",
            // "tutorial_Computer_Internet_Browser",
            // "tutorial_Computer_Internet_Search",
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












    public static function getAllSequencesContent(): array
    {
        return array_merge(
            self::getSequenceCustomContent(),
            self::getSequenceGenericContent()
        );
    }

    public static function getSequenceCustomContent(): array
    {
        $faker = Factory::create();

        return [
            /////////////////////////// TUTORIAL BROWSER //////////////////////////
            [
                "title" => "Qu’est-ce qu’un navigateur ?",
                "content" => "Un navigateur est un logiciel qui permet de traduire le langage des sites web en langage humain. C’est le bateau qui permet de naviguer sur l’océan qu’est le web !
                Il existe une multitude de navigateurs gratuits, cependant certains protègent mieux vos données personnelles. En fonction du navigateur utilisé, certains sites peuvent plus ou moins bien fonctionner. Nous vous conseillons donc d’en installer plusieurs.
                Enfin, sachez que pour les utiliser au mieux, vous devrez les mettre à jour régulièrement !",
                "exercice" => false,
                "indexOrder" => 1,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Computer_Internet_Browser"
            ],
            [
                "title" => "Quels sont les différents navigateurs qui existent ?",
                "content" => "Chrome : Développé par Google, il fonctionne sous la majorité des systèmes d’exploitation. Les utilisateurs apprécient en général sa vitesse d'utilisation et ses nombreuses fonctionnalités, applications et extensions disponibles.
 
                Safari : Distribué et disponible uniquement pour les produits Apple. Safari se revendique comme extrêmement rapide et personnalisable.
                Mozilla Firefox : Développé par la fondation Mozilla et ses nombreux bénévoles. Il est disponible sur la majorité des systèmes d'exploitation. Il possède également de nombreuses fonctionnalités et extensions et apparaît réputé pour la protection des données personnelles.
                Microsoft Edge : Navigateur web de la société Microsoft, pré-installé sur les appareils sous Windows. Il existe depuis 2015 et remplace Internet Explorer plus mis à jour et donc non sécurisé. Microsoft Edge fonctionne aussi sous macOS, Android et iOS.
                 Il propose également des outils intégrés pour vous aider lors de vos achats en ligne.
                Opera : Navigateur norvégien créé en 1995, Opera fonctionne aussi bien sous Windows, Linux, macOS, iOS ou Android. Il a été un des premiers à instaurer les onglets pour faciliter la navigation. Son avantage ? il possède un VPN intégré pour naviguer en toute sécurité.
                Brave : Open source gratuit, Brave cherche avant tout à protéger la vie privée en bloquant par défaut les pisteurs et les pubs. Il fonctionne sous Windows, Linux, macOS, iOS ou Android.",
                "exercice" => false,
                "indexOrder" => 2,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Computer_Internet_Browser"
            ],
            [
                "title" => "Exercice",
                "content" => "Quel(s) est(sont) le(s) navigateur(s) installé(s) sur votre appareil ?",
                "exercice" => true,
                "indexOrder" => 3,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Computer_Internet_Browser"
            ],
            [
                "title" => "Comment personnaliser son navigateur ?",
                "content" => "Afin d’améliorer votre expérience utilisateur, les navigateurs proposent une multitude d’extension. Ces outils peuvent par exemple vous servir à prendre des mesures, trouver les polices d’écriture utilisées, traduire des pages web ou simplement personnaliser votre curseur de souris !",
                "exercice" => false,
                "indexOrder" => 4,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Computer_Internet_Browser"
            ],
            [
                "title" => "Comment savoir si une page est sécurisée ?",
                "content" => "Avec l’avènement d’internet, de nombreuses arnaques numériques ont vues le jour. En cas de doute, n’hésitez pas à rentrer le nom du site et le mot « arnaque » sur un moteur de recherche pour voir si d’autres utilisateurs ont eu une mauvaise expérience.
                Lorsque l’url de la page commence par « https:// », le « s » correspond à « secure ». Un cadenas fermé peut également apparaître dans la fenêtre de naviagation.",
                "exercice" => false,
                "indexOrder" => 5,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Computer_Internet_Browser"
            ],
            /////////////////////////// TUTORIAL SEARCH //////////////////////////
            [
                "title" => "Qu’est-ce qu’un moteur de recherche ?",
                "content" => "Un moteur de recherche est une application web qui fonctionne comme un « annuaire » de tous les sites web. Sans lui, il serait impossible de trouver une information dans l’océan du web. Il s’agit donc de la boussole de votre bateau !
                A la différence du navigateur, le moteur de recherche ne s’installe pas sur votre équipement. Pour changer de moteur de recherche, il faut modifier les paramètres du navigateur ou se rendre à l’adresse URL du site web. Par exemple : www. qwant.fr
                Le moteur de recherche utilise les mots-clefs que vous allez taper pour chercher la bonne information. En quelques instants, vous aurez ainsi accès à différents types de ressources en lien avec votre recherche : sites et pages web, articles, images, vidéos, etc.",
                "exercice" => false,
                "indexOrder" => 1,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Computer_Internet_Search"
            ],
            [
                "title" => " Quelques exemples de moteurs de recherche:",
                "content" => "Certains navigateurs sont installés avec un moteur de recherche par défaut : Google Chrome avec Google ou encore Microsoft Edge avec Bing. Vous pouvez facilement changer cela grâce aux paramètres de votre navigateur. Voici les principaux moteurs de recherche :
                Google : Créé en 1998, le moteur de recherche américain Google est le leader mondial incontesté, 90% des utilisateurs du web du monde entier l'utilisent. Il tient sa réputation de la puissance de ses algorithmes (ensemble d'instructions dans un calcul permettant d'obtenir un résultat). Google suscite néanmoins beaucoup d'inquiétudes quant au respect de la vie privée et de la confidentialité des données.
                Bing : Fondé en 2009 par la société américaine Microsoft, Bing est aujourd'hui le deuxième moteur de recherche utilisé au monde, loin derrière Google. Il a succédé aux différents moteurs de recherche créés par Microsoft : MSN search, Windows Live Search, Live Search.
                Yahoo : L'américain Yahoo existe depuis 1994. Il est à l'origine un annuaire web et fait ainsi partie des premiers moteurs de recherche utilisés. Associé à Bing depuis 2009, il se sert de ses algorithmes.
                Qwant : Existant depuis 2013, l'européen Qwant refuse de tracer ses utilisateurs ou de vendre leurs données personnelles pour garantir la vie privée. De même, il se veut le plus neutre possible dans l'affichage des résultats de recherche.
                DuckDuckGO : Créé en 2008, l'américain garantit à ses utilisateurs un respect de leur vie privée. Il refuse de filtrer et de personnaliser à votre insu, grâce à vos données collectées, les publicités qui s'affichent.
                 L'outil préfère vous donner accès à l'ensemble du Web en filtrant vous-mêmes vos résultats en fonction de vos besoins.
                Ecosia : Moteur de recherche allemand, fondé en 2009, il se base sur Bing qu'il a adapté. Il reverse 80% de ses bénéfices à des associations à but non lucratif, luttant contre la déforestation dans les pays du Sud. Ses bénéfices proviennent ainsi des recherches sur son moteur mais aussi des liens publicitaires. Vous avez la possibilité toutefois de ne pas afficher les publicités. En l'utilisant vous contribuerez à la reforestation : déjà plus 130 millions d'arbres plantés depuis sa création ! Ecosia assure également protéger vos données personnelles.
                Lilo : Fondé en 2014, le moteur de recherche français finance des projets sociaux et environnementaux choisis par les internautes. Pour rendre son moteur efficace, il a noué des partenariats avec Bing, Google et Yahoo, entre autres. Lilo protège également vos données personnelles (pas de collecte ni de revente de données utilisateurs).",
                "exercice" => false,
                "indexOrder" => 2,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Computer_Internet_Search"
            ],
            [
                "title" => "Comment faire une recherche ?",
                "content" => "Rendez-vous sur votre navigateur internet et lancez votre moteur de recherche préféré. Cliquez sur la barre de recherche et rentrez des mots-clés. Plus vos mots-clés seront précis et pertinents, plus les résultats seront adaptés à votre demande. Mettre beaucoup de mots risque de vous renvoyer trop de résultats et donc vous demander plus de travail de filtrage ensuite.",
                "exercice" => false,
                "indexOrder" => 3,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Computer_Internet_Search"
            ],
            [
                "title" => "Exercice:",
                "content" => "quels seraient les meilleurs mots clefs pour la recherche suivante “je cherche un recette de gâteau aux pommes sans gluten”
                OU quel est le moteur de recherche associé  votre navigateur ?",
                "exercice" => true,
                "indexOrder" => 4,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Computer_Internet_Search"
            ],
            [
                "title" => "Comment choisir le résultat?",
                "content" => "Même avec les bons mots clés, il y aura toujours beaucoup de résultats. Les premiers résultats sont souvent ceux qui correspondent le mieux à votre recherche. Mais les premiers résultats peuvent aussi être des « annonces ». Il s’agit de sites web qui ont payé pour figurer dans les premiers résultats. Un résultat de recherche est composé de trois parties : le nom du site, son adresse URL et le résumé de son contenu. Pour choisir le meilleur résultat, il faut prendre le temps de lire ces différents éléments pour voir si l’objectif correspond à ce que nous recherchons.",
                "exercice" => false,
                "indexOrder" => 5,
                "picturePath" => "mbl-sms.jpg",
                "tutorialRef" => "tutorial_Computer_Internet_Search"
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




















    public static function getAllQuizzesContent(): array
    {
        return array_merge(
            self::getQuizCustomContent(),
            self::getQuizzesGenericContent(),
        );
    }

    public static function getQuizCustomContent(): array
    {
        return [
            [
                "quizRef" => "Computer_Internet_Browser",
                "tutorialRef" => "tutorial_Computer_Internet_Browser"
            ],
            [
                "quizRef" => "Computer_Internet_Search",
                "tutorialRef" => "tutorial_Computer_Internet_Search"
            ],
        ];
    }

    public static function getQuizzesGenericContent(): array
    {
        $quizzes = [];
        foreach (self::getTutorialRefs() as $tutorialRef) {
            $quizzes[] = [
                "quizRef" => "quiz_" . $tutorialRef,
                "tutorialRef" => $tutorialRef
            ];
        }

        return $quizzes;
    }

    public static function getQuestionsCustomContent(): array
    {
        return [
            [
                "prompt" => "Qui n’est pas un navigateur ?",
                "proposition1" => "Chrome",
                "proposition2" => "Firefox",
                "proposition3" => "Edge",
                "proposition4" => "Bing",
                "answer" => "Bing",
                "quizRef" => "quiz_Computer_Internet_Browser"
            ],
            [
                "prompt" => "Par quoi commence l'URL d'un sîte sécurisé ?",
                "proposition1" => "http",
                "proposition2" => "html",
                "proposition3" => "https",
                "proposition4" => "www",
                "answer" => "https",
                "quizRef" => "quiz_Computer_Internet_Browser"
            ],
            [
                "prompt" => "Exemple",
                "proposition1" => "bla",
                "proposition2" => "bli",
                "proposition3" => "blou",
                "proposition4" => "blargh",
                "answer" => "blou",
                "quizRef" => "quiz_Computer_Internet_Search"
            ],
            [
                "prompt" => "Exemple",
                "proposition1" => "bla",
                "proposition2" => "bli",
                "proposition3" => "blou",
                "proposition4" => "blargh",
                "answer" => "blou",
                "quizRef" => "quiz_Computer_Internet_Search"
            ],
        ];
    }
}
