import "./bootstrap";
import "../sass/app.scss";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

let csrf = document.querySelector('meta[name="csrf-token"]').content;
let mySelect = document.getElementById("mySelect");
let notif_bell = document.getElementById("notif_bell");
let notif_body = document.getElementById("notif_body");
let notifDiv = document.getElementById("notifications");

function renderReviews(reviewsToRender) {
    notifDiv.innerHTML = ""; 
    reviewsToRender.map((review) => {
        notifDiv.innerHTML += ` 
        <a href="/notiffication/${review.id}" class="no-underline">
        <div class="${review.mark_read ? "bg-white" : "bg-indigo-100"} w-full relative p-2 rounded flex gap-1 mb-2 cursor-pointer no-underline decoration-black text-black">
            <div class="${review.status == "alert" ? "bg-red-700" : review.status == "satisfying" ? "bg-emerald-700" : "bg-amber-500"} w-2 absolute left-0 top-0 h-[4.9rem] rounded-l"></div>
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
                        <form action="/comments/delete/${review.id}" method="post">
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
        filteredReviews = reviews.filter((review) => review.status == mySelect.value);
    }
    renderReviews(filteredReviews);
});


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
