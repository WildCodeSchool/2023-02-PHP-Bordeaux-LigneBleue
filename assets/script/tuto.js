// eslint-disable-next-line no-undef
const tour = new Shepherd.Tour({
    defaultStepOptions: {
        scrollTo: true, //autorise scroll sur la fenetre
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
        element: '.navbar-brand',
        on: 'top',
    },
    modalOverlayOpeningRadius: 16,
    modalOverlayOpeningPadding: 14,
    canClickTarget: false,
    title: 'Logo',
    text: 'Cliquez ici pour rejoindre la toute première page du site.',
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
        element: '.llb-navbar-search-container',
        on: 'top',
    },
    canClickTarget: false,
    title: 'Barre de recherche',
    text: 'Vous pouvez rechercher toutes nos formations en fonction de leurs noms, thèmes ou tags.',
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
        element: '#llb-btn-profil-navbar',
        on: 'top',
    },
    canClickTarget: false,
    title: 'Profil',
    text: 'Cliquez ici pour rejoindre votre espace personnel à tout moment.',
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
        element: '#llb-btn-forma-navbar',
        on: 'top',
    },
    canClickTarget: false,
    title: 'Formations',
    text: 'Cliquez ici pour retrouvez toutes nos formations.',
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
        element: '.llb-welcome-userPage',
        on: 'bottom',
    },
    modalOverlayOpeningRadius: 16,
    canClickTarget: false,
    title: 'Avatar et Tuto',
    text: 'Dans cette partie du profil vous pouvez rejouer ce tuto si nécessaire mais aussi modifier votre avatar.',
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
    attachTo: {
        element: '#llb-infoUserCard',
        on: 'bottom',
    },
    modalOverlayOpeningRadius: 16,
    canClickTarget: false,
    title: 'Informations personnelles',
    text: 'Ici vous pouvez consulter vos informations personnelles et les modifier si besoin.',
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
    id: 'step8',
    attachTo: {
        element: '#llb-tutoIsSavedUserCard',
        on: 'bottom',
    },
    modalOverlayOpeningRadius: 16,
    canClickTarget: false,
    title: 'Mes formations sauvegardées',
    text: 'Retrouvez ici toutes les formations que vous avez liké précédemment  !',
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
    id: 'step9',
    attachTo: {
        element: '#llb-tutoIsFinishedUserCard',
        on: 'bottom',
    },
    modalOverlayOpeningRadius: 16,
    canClickTarget: false,
    title: 'Mes formations terminées',
    text: 'Retrouvez l\' historique de toutes les formations déja réusssies.',
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
    id: 'step10',
    attachTo: {
        element: '.llb-blue-container-userShow',
        on: 'top',
    },
    modalOverlayOpeningRadius: 16,
    canClickTarget: false,
    title: 'Mes formations en cours',
    text: 'Dans cette partie de votre espace personnel vous pouvez retrouver les dernières formations que vous avez commencées mais pas terminées.',
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
    id: 'step11',
    attachTo: {
        element: '.footer-basic',
        on: 'top',
    },
    modalOverlayOpeningRadius: 16,
    canClickTarget: false,
    title: 'Mentions Légales',
    text: 'En bas de page vous retrouverez toutes les mentions légales inhérentes à la Ligne Bleue',
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
    id: 'step12',

    title: 'En route !',
    text: 'Et voilà on vous à tout dit. À vous de jouer et n\'hésitez à nous contacter si vous avez besoin de plus d\'aide. Bonne navigation !',
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
                return this.hide();
            }
        },
    ],
    scrollTo: 'top',
});
if (!localStorage.getItem('shepherd-tour')) {
    tour.start();
    localStorage.setItem('shepherd-tour', 'yes');
}

let buttonRestart = document.querySelector('.restartButton')
buttonRestart.addEventListener('click', () => {
    tour.start()
})
