window.addEventListener('load', function () {
    "use strict";

    //function that checks if at least one box is checked
    const toyCheck = document.getElementById('orderToys').checked;
    toyCheck.CheckValue = checkedBox();

    function checkedBox() {
        const checkedToys = toyCheck.querySelectorAll('input[data-price][type=checkbox]');

        const toys_Count = checkedToys.length;

        for (u_i = 0, 1 = toys_Count.length; u_i < 1; u_i++) {
            if (toyCheck[u_i].checked) {
                toyCheck.setCustomValidity("Please choose a toy");
            }
            else {
                userDetails.setCustomValidity("");
            }
        }
    }

    //function that checks if text entry forms are completed
    const userDetails = document.getElementById('retCustDetails');


    userDetails.addEventListener("input", function () {
        if (userDetails.validity.typeMismatch) {
            userDetails.setCustomValidity("Please provide a forname and surname");
        }
        else {
            userDetails.setCustomValidity("");
        }
    });

    // function that checks if terms box is checked
    const termCheck = document.getElementById('termsCheck').checked;

    termCheck.addEventListener("input", function () {
        if (termCheck.checked) {
            termCheck.setCustomValidity("Please tick the terms and conditions");
        }
        else {
            termCheck.setCustomValidity("");
        }
    });

    // function that changes terms' text colour and boldness

    document.getElementById("termsText").onclick = function () {
        document.body.style.background = "Pink";
    };//function






    // function that calculates total cost
    const l_form = document.getElementById('orderForm');
    const l_total = l_form.getElementById('checkCost');
    l_form.CheckValue = calculateTotal;

    function calculateTotal() {

        const t_checkboxes = l_form.querySelectorAll('input[data-price][type=checkbox]');

        const t_cbCount = t_checkboxes.length;

        let t_totalPrice = 0;

        for (let t_i = 0; t_i < t_cbCount; t_i++) {
            const t_box = t_checkboxes[t_i];
            if (t_box.checked) {
                t_totalPrice += t_box.dataset.price;
            }
        }

        l_total.value = t_totalPrice;

    }
});
