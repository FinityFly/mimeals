const shareButton = document.querySelector('#share-button');
shareButton.addEventListener('click', function() {
    // share button functionality
    navigator.clipboard.writeText(`Check this MiMeals recipe out!\n${window.location.href}`);
    shareButton.innerHTML = "Copied!";
})