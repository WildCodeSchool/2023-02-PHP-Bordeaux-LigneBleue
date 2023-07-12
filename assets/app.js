/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// start the Stimulus application
import './bootstrap';
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// import 'bootstrap-icons/font/bootstrap-icons.css';

// using API places
import { Application } from 'stimulus'
import PlacesAutocomplete from 'stimulus-places-autocomplete'

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

const application = Application.start()
application.register('places', PlacesAutocomplete)
