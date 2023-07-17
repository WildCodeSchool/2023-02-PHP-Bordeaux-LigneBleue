// wishlist ajax

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
                if (data.isLiked) {
                    wishlistIcon.style.fill = '#0C5395';
                    // wishlistIcon.classList.remove("bi-heart"); // Remove the .bi-heart (empty heart) from classes in <i> element
                    // wishlistIcon.classList.add("bi-heart-fill"); // Add the .bi-heart-fill (full heart) from classes in <i> element
                } else {
                    wishlistIcon.style.fill = '#dddddd';
                    // wishlistIcon.classList.remove("bi-heart-fill"); // Remove the .bi-heart-fill (full heart) from classes in <i> element
                    // wishlistIcon.classList.add("bi-heart"); // Add the .bi-heart (empty heart) from classes in <i> element
                }
            });
    } catch (err) {
        // eslint-disable-next-line no-console
        console.error(err);
    }
}
