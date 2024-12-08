import "./bootstrap";
import "../sass/app.scss";
import "./media_Selector";

import Alpine from "alpinejs";
import axios from "axios";


let menu = document.querySelector(".toggle")
let sideBar = document.querySelector(".side-bar")

// menu.addEventListener("click",()=>{
//     if (sideBar.classList.contains("left-[-700px]")) {
//         sideBar.classList.remove("left-[-700px]") 
//         sideBar.classList.add("left-6")   
//     }else if(sideBar.classList.contains("left-6")){
//         sideBar.classList.remove("left-6")
//         sideBar.classList.add("left-[-700px]")   
//     }
    
// })
menu.addEventListener("click", () => {
    sideBar.classList.remove("left-[-700px]") 
    sideBar.classList.toggle("active");
  });

window.Alpine = Alpine;

Alpine.start();
let x = document.querySelector(".audiohada");
x.addEventListener('play', () => {
    console.log("x : ", x.duration);
})
// console.log("x : ", x.duration);
let csrf = document.querySelector('meta[name="csrf-token"]').content;
let mySelect = document.getElementById("mySelect");
let notif_bell = document.getElementById("notif_bell");
let notif_body = document.getElementById("notif_body");
let notifDiv = document.getElementById("notifications");
let notifDivVisite = document.getElementById("visite_guide");
let notifBodyVisite = document.getElementById("notif_visite");
let map_icon = document.getElementById("visite_icon");
let pop = document.getElementById("pop_triangle");
let pop_map = document.getElementById("pop_triangle_map");
let selectedReview;

const colors = {
    alert: "rgb(220 38 38)",
    satisfying: "rgb(4 120 87)",
    warning: "rgb(245 158 11)",
};

// const { data } = await axios.get("/reviews");

// * reviews && buildings && visitors are sent from app.blade.php <script></script>

function renderReviews(reviewsToRender) {
    notifDiv.innerHTML = "";

    reviewsToRender.map((review) => {
        let buildingName = buildings.filter(
            (building) => building.id == review.building_id
        );
        let visitorName = visitors.filter(
            (visitor) => visitor.id == review.visitor_id
        );
        console.log(visitorName);
        console.log(review);
        notifDiv.innerHTML += ` 
        <div id="review-${
            review.id
        }" class="test" data-bs-toggle="modal" data-bs-target="#exampleModal">  
        <div class="${
            review.mark_read ? "bg-white" : "bg-indigo-100"
        } w-full relative p-2 rounded-sm flex gap-1 mb-2 cursor-pointer no-underline decoration-black text-black">
                <div style="width: 8px ; height: 100%; background-color: ${
                    colors[review.status]
                }" class="  w-2 h-[4.9rem] absolute left-0 top-0 rounded-l-md "></div>
                        <div class="w-full px-2">
                        <div class="flex justify-between items-center w-full">
                        <p class="mb-0">
                        <span class="font-bold">${
                            visitorName[0].full_name
                        }</span> added a review for <span class="font-bold">${
            buildingName[0].name
        }</span>
                        </p>
                        <div class="flex justify-start items-center">
                            <form action="/update/notif/${
                                review.id
                            }" method="POST">
                                <input type="hidden" name="_token" value="${csrf}" autocomplete="off">
                                <input type="hidden" name="_method" value="PUT">
                                <button class="p-1 hover:bg-gray-100 hover:p-1 hover:rounded-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                    
                                </button>
                            </form>
                            <form action="/comments/delete/${
                                review.id
                            }" method="post">
                                <input type="hidden" name="_token" value="${csrf}" autocomplete="off">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="p-1 hover:bg-gray-100 hover:p-1 hover:rounded-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                    
                                </button>
                            </form>
                        </div>
                    </div>
                    <p class="truncate max-w-[20vw]">${review.content}</p>
                </div>
            </div>
        </div>
        
        `;
    });
    reviewsToRender.forEach((review) => {
        document
            .getElementById(`review-${review.id}`)
            .addEventListener("click", () => {
                selectedReview = review;
                if (selectedReview) {
                    // console.log(selectedReview);
                    document.getElementById("exampleModalLabel").innerHTML =
                        selectedReview.status;
                    document.getElementById("exampleModalLabel").style.color =
                        colors[selectedReview.status];
                    document.getElementById(
                        "modal-body-head"
                    ).innerText = `hamza`;
                    document.getElementById("modal-body-content").innerText =
                        selectedReview.content;
                    document.querySelector(".modal-footer").innerHTML = `
                    <form action="/update/notif/${selectedReview.id}" method="POST">
                        <input type="hidden" name="_token" value="${csrf}" autocomplete="off">
                        <input type="hidden" name="_method" value="PUT">
                        <button class="bg-alpha px-3 py-2 rounded text-white" >Mark as Read</button>
                    </form>
                    `;
                }
            });
    });
}

const notifBtn = document.querySelector(".test");

console.log(notifBtn);

renderReviews(reviews);

mySelect.addEventListener("input", function () {
    let filteredReviews;
    if (mySelect.value === "all") {
        filteredReviews = reviews;
    } else {
        filteredReviews = reviews.filter(
            (review) => review.status == mySelect.value
        );
    }
    renderReviews(filteredReviews);
});

let check = true;
notif_bell.addEventListener("click", function () {
    check = !check;
    if (notifBodyVisite.classList.contains("flex")) {
        notifBodyVisite.classList.add("hidden");
        pop_map.classList.add("hidden");
        checkVisite = !checkVisite;
    }

    if (!check) {
        notif_body.classList.remove("hidden");
        pop.classList.remove("hidden");
        notif_body.classList.add("flex");
    } else {
        pop.classList.add("hidden");
        notif_body.classList.remove("flex");
        notif_body.classList.add("hidden");
    }
});

let checkVisite = true;
map_icon.addEventListener("click", () => {
    checkVisite = !checkVisite;
    if (notif_body.classList.contains("flex")) {
        notif_body.classList.add("hidden");
        pop.classList.add("hidden");
        check = !check;
    }
    if (!checkVisite) {
        notifBodyVisite.classList.remove("hidden");
        pop_map.classList.remove("hidden");
        notifBodyVisite.classList.add("flex");
    } else {
        notifBodyVisite.classList.remove("flex");
        pop_map.classList.add("hidden");
        notifBodyVisite.classList.add("hidden");
    }
});

// & update building languages

let englishDiv = document.getElementById("english_version");
let arabicDiv = document.getElementById("arabic_version");
let frenshDiv = document.getElementById("french_version");
let btnArabic = document.getElementById("btnArabic");
let btnFrensh = document.getElementById("btnFrench");
let btnEnglish = document.getElementById("btnEnglish");
let tabs = document.querySelectorAll(".langueBtn");
tabs.forEach((element) => {
    element.addEventListener("click", () => {
        if (element.innerHTML == "English") {
            englishDiv.classList.remove("hidden");
            englishDiv.classList.add("block");

            frenshDiv.classList.add("hidden");
            frenshDiv.classList.remove("block");

            arabicDiv.classList.add("hidden");
            arabicDiv.classList.remove("block");
        } else if (element.innerHTML == "Français") {
            englishDiv.classList.add("hidden");
            englishDiv.classList.remove("block");

            frenshDiv.classList.remove("hidden");
            frenshDiv.classList.add("block");

            arabicDiv.classList.add("hidden");
            arabicDiv.classList.remove("block");
        } else {
            englishDiv.classList.add("hidden");
            englishDiv.classList.remove("block");

            frenshDiv.classList.add("hidden");
            frenshDiv.classList.remove("block");

            arabicDiv.classList.add("block");
            arabicDiv.classList.remove("hidden");
        }
        if (englishDiv.classList.contains("block")) {
            btnEnglish.classList.add("bg-white");
            btnArabic.classList.remove("bg-white");
            btnFrensh.classList.remove("bg-white");
        } else if (frenshDiv.classList.contains("block")) {
            btnFrensh.classList.add("bg-white");
            btnArabic.classList.remove("bg-white");
            btnEnglish.classList.remove("bg-white");
        } else {
            btnArabic.classList.add("bg-white");
            btnFrensh.classList.remove("bg-white");
            btnEnglish.classList.remove("bg-white");
        }
    });
    if (englishDiv.classList.contains("block")) {
        btnEnglish.classList.add("bg-white");
    }
});
