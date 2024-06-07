import "./bootstrap";
import "../sass/app.scss";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

let mySelect = document.getElementById('mySelect');
// mySelect.addEventListener("change", () => {
//     console.log("dcfihydbf")
// })
let notif_bell = document.getElementById("notif_bell");
let notif_body = document.getElementById("notif_body");
let notifDiv = document.getElementById("notifications");
let options = document.getElementsByClassName("filterOption");
let reviewsfilter = [];
// console.log(options);



// Array.from(options).forEach(element => {
    // console.log(element);
    mySelect.addEventListener("change", function () {
        // console.log('ladskf');
        // console.log(mySelect.value);
        reviewsfilter = reviews.filter(
            (review) => review.status == mySelect.value
            );
        console.log(reviewsfilter);
        });
// });
        notifDiv.innerHTML = reviewsfilter.map((review)=>{
            return "<h1>review</h1>"
        })


let check = true;
notif_bell.addEventListener("click", function () {
    check = !check;
    if (!check) {
        notif_body.classList.remove("hidden");
        notif_body.classList.add("flex");
    } else {
        notif_body.classList.remove("flex");
        notif_body.classList.add("hidden");
    }
});
// console.log(reviews);
// console.log(test);
let array = [1,2,3]

