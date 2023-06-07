const shareButton = document.querySelector('#share-button');
shareButton.addEventListener('click', function() {
    console.log('hi');
    navigator.clipboard.writeText(`Check this MiMeals recipe out!\n${window.location.href}`);
    shareButton.innerHTML = "Copied!";
})