/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import 'bootstrap-icons/font/bootstrap-icons.css';


const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// start the Stimulus application
import './bootstrap';

// using API places
import { Application } from 'stimulus'
import PlacesAutocomplete from 'stimulus-places-autocomplete'

const application = Application.start()
application.register('places', PlacesAutocomplete)

// wishlist ajax
document.getElementById('wishlist').addEventListener('click', addToWishlist);

function addToWishlist(e)
{
  e.preventDefault();

  const wishlistLink = e.currentTarget;
  const link = wishlistLink.href;
  // Send an HTTP request with fetch to the URI defined in the href
  try {
    fetch(link)

      // Extract the JSON from the response
      .then(res => res.json())

      // Then update the icon
      .then(data => {

        const wishlistIcon = wishlistLink.firstElementChild;
        if (data.isInUserTutorialLiked) {
          wishlistIcon.classList.remove("bi-heart"); // Remove the .bi-heart (empty heart) from classes in <i> element
          wishlistIcon.classList.add("bi-heart-fill"); // Add the .bi-heart-fill (full heart) from classes in <i> element
        } else {
          wishlistIcon.classList.remove("bi-heart-fill"); // Remove the .bi-heart-fill (full heart) from classes in <i> element
          wishlistIcon.classList.add("bi-heart"); // Add the .bi-heart (empty heart) from classes in <i> element
        }
      });
  } catch (err) {
    console.error(err);
  }
}
