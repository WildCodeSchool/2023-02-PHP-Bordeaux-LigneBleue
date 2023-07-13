function startSequence(e)
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
                const sequenceContainer = document.getElementById('sequenceContainer');
                if (data.isStarted) {
                    // sequenceContainer.style.display = 'flex';
                    // sequenceContainer.style.opacity = '1';
                    sequenceContainer.classList.add("llb-show-display");
                    setTimeout(function () {
                        sequenceContainer.classList.add("llb-show-opacity");
                    }, 20);
                }
            });
    } catch (err) {
        // eslint-disable-next-line no-console
        console.error(err);
    }
}
