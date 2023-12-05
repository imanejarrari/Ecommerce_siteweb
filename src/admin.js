const btn = document.querySelector('.menu');
const logo = document.querySelector('.logoLink');
const menu = document.querySelector('.left-menu');
const settings = document.getElementById('setting');

btn.addEventListener('click', function () {
    btn.classList.toggle('active');
    if (btn.classList.contains('active')) {
        menu.style.width = '4.4rem';
        logo.style.opacity = '0';
    }
    else {
        menu.style.width = '13rem';
        logo.style.opacity = '1';
    }
})

    var popups = document.getElementsByClassName('form-popup');

    // Loop through all found elements and hide them
    for (var i = 0; i < popups.length; i++) {
        popups[i].style.display = 'none';
    }

    function openForm(formId) {
        // Construct the form id based on the product id or any unique identifier
        document.getElementById(formId).style.display = "block";

        let selectMenu = document.querySelector("#status_select_" + formId);
        selectMenu.addEventListener("change", function () {
            let categoryName = this.value;
            console.log(categoryName);
            console.log(formId);

            let http = new XMLHttpRequest();

            http.open('POST', "AffichageProduct.php", true);
            http.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            http.send("category=" + categoryName + "&id=" + formId);
            location.reload();
        });
    }

    function closeForm(formId) {
        document.getElementById(formId).style.display = "none";
    }

