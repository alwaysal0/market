document.addEventListener('DOMContentLoaded', function() {
    let alert = document.getElementsByClassName('alert');
    if (alert.length > 0) {
        alert = alert[0];

        setTimeout(() => {
            alert.style.opacity= '0';
            setTimeout (() => {
                alert.style.display = 'none';
            }, 200)
        }, 3000)
    }
});
