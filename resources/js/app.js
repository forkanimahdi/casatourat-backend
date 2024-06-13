import "./bootstrap";
import "../sass/app.scss";
import "./media_Selector";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

let csrf = document.querySelector('meta[name="csrf-token"]').content;
let mySelect = document.getElementById("mySelect");
let notif_bell = document.getElementById("notif_bell");
let notif_body = document.getElementById("notif_body");
let notifDiv = document.getElementById("notifications");
let notifDivVisite = document.getElementById("visite_guide");
let notifBodyVisite = document.getElementById("notif_visite");
let map_icon = document.getElementById("visite_icon");
let pop = document.getElementById("pop_triangle");
console.log(notifBodyVisite);

const colors = {
    alert: "rgb(220 38 38)",
    satisfying: "rgb(4 120 87)",
    warning: "rgb(245 158 11)",
};

function renderReviews(reviewsToRender) {
    notifDiv.innerHTML = "";
    reviewsToRender.map((review) => {
        notifDiv.innerHTML += ` 
        <a href="/notiffication/${review.id}" class="no-underline">
        <div class="${
            review.mark_read ? "bg-white" : "bg-indigo-100"
        } w-full relative p-2 rounded-sm flex gap-1 mb-2 cursor-pointer no-underline decoration-black text-black">
            <div style="width: 8px ; height: 100%; background-color: ${
                colors[review.status]
            }" class=" ${
            review.status == "alert"
                ? "bg-red-400"
                : review.status == "satisfying"
                ? "bg-emerald-700"
                : "bg-amber-500"
        } w-2 h-[4.9rem] absolute left-0 top-0 rounded-l-md "></div>
            <div class="w-full px-2">
                <div class="flex justify-between items-center w-full">
                    <p class="mb-0">
                        <span class="font-bold">Lionel Messi</span> added a review for
                        <span class="font-bold">Mahkama</span>
                    </p>
                    <div class="flex justify-start items-center">
                        <form action="/update/notif/${review.id}" method="POST">
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
        </a>
        `;
    });
}

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
    console.log("messi");
    checkVisite = !checkVisite;
    if (notif_body.classList.contains("flex")) {
        notif_body.classList.add("hidden");
        check = !check;
    }
    if (!checkVisite) {
        notifBodyVisite.classList.remove("hidden");
        notifBodyVisite.classList.add("flex");
    } else {
        notifBodyVisite.classList.remove("flex");
        notifBodyVisite.classList.add("hidden");
    }
});
