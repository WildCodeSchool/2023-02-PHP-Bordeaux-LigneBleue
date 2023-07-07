const tour = new Shepherd.Tour({
    defaultStepOptions: {
        scrollTo: false, //autorise scroll sur la fenetre
        showCancelLink: true,
        cancelIcon: { //
            enabled: true
        },
    },
    useModalOverlay: true,
});

// Ajoutez les étapes du tutoriel
tour.addStep({
    id: 'step1',
    title: 'Introduction à l\'application',
    text: 'Bienvenue sur votre espace personnel ! Ce tutoriel va vous permettre de découvrir les fonctionnalités de l\'application. <br> Appuyez sur le bouton "Suivant" pour continuer.',
    buttons: [
        {
            text: 'Suivant',
            action: tour.next,
        },
    ],
});

tour.addStep({
    id: 'step2',
    attachTo: {
        element: '.llb-welcome-userPage',
        on: 'bottom',
    },
    canClickTarget: false,
    title: 'Avatar et Tuto',
    text: 'Dans cette première partie vous pourrez rejouer ce tuto si besoin ainsi que changer votre avatar.',
    buttons: [
        {
            action() {
                return this.back();
            },
            classes: 'shepherd-button-secondary',
            text: 'Retour arrière'
        },
        {
            text: 'Suivant',
            action: tour.next,
        },
    ],
});

tour.addStep({
    id: 'step3',
    attachTo: {
        element: '.llb-cards-userPage',
        on: 'bottom',
    },
    canClickTarget: false,
    title: 'Faire une estimation',
    text: 'Cet onglet vous envoie vers la page destinée à l\'estimation d\'un téléphone.',
    buttons: [
        {
            action() {
                return this.back();
            },
            classes: 'shepherd-button-secondary',
            text: 'Retour arrière'
        },
        {
            text: 'Suivant',
            action: tour.next,
        },
    ],
});
tour.addStep({
    id: 'step4',
    attachTo: {
        element: '.es-sidebar-faq',
        on: 'bottom',
    },
    canClickTarget: false,
    title: 'Foire aux questions',
    text: 'Cet onglet vous envoie vers les questions fréquemment posées, vous y trouverez certainement vos réponses !',
    buttons: [
        {
            action() {
                return this.back();
            },
            classes: 'shepherd-button-secondary',
            text: 'Retour arrière'
        },
        {
            text: 'Suivant',
            action: tour.next,
        },
    ],
});

tour.addStep({
    id: 'step5',
    attachTo: {
        element: '.es-sidebar-contact',
        on: 'bottom',
    },
    canClickTarget: false,
    title: 'Contact',
    text: 'Cet onglet vous envoie vers la page pour contacter un administrateur, si vous avez des questions ou des suggestions.',
    buttons: [
        {
            action() {
                return this.back();
            },
            classes: 'shepherd-button-secondary',
            text: 'Retour arrière'
        },
        {
            text: 'Suivant',
            action: tour.next,
        },
    ],
});

tour.addStep({
    id: 'step6',
    attachTo: {
        element: '.es-sidebar-logout',
        on: 'top',
    },
    canClickTarget: false,
    title: 'Se déconnecter',
    text: 'Ce bouton sert à vous déconnecter de l\'application, cliquez dessus quand vous avez fini de vous en servir.',
    buttons: [
        {
            action() {
                return this.back();
            },
            classes: 'shepherd-button-secondary',
            text: 'Retour arrière'
        },
        {
            text: 'Suivant',
            action: tour.next,
        },
    ],
});

tour.addStep({
    id: 'step7',

    title: 'En route !',
    text: 'Et voilà ! vous savez désormais comment utiliser cette aplication. Vous pouvez rejouer ce tutoriel à tout moment en cliquant sur le bouton associé dans l\'onglet de la Foire aux Questions. Bonne navigation !',
    buttons: [
        {
            action() {
                return this.back();
            },
            classes: 'shepherd-button-secondary',
            text: 'Retour arrière'
        },
        {
            text: 'Fermer',
            action() {
                dismissTour();
                return this.hide();
            }
        },
    ],
});
tour.start();
