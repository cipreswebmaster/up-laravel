const actualPhase = document.getElementById("actual_phase");
const phases = document.querySelectorAll(".phases_list .phase");
phases.forEach(function (el, i) {
    el.addEventListener("click", function (e) {
        const actualActive = document.querySelector(".phase.active");
        const nextActive = phases[i];
        actualActive.classList.remove("active");
        nextActive.classList.add("active");

        const newImg = nextActive.querySelector(".img img").src;
        const newTitle =
            nextActive.getElementsByClassName("title")[0].innerHTML;
        const newContent =
            nextActive.getElementsByClassName("description")[0].innerHTML;

        actualPhase.querySelector(".p_img img").src = newImg;
        actualPhase.getElementsByClassName("p_title")[0].innerHTML = newTitle;
        actualPhase.getElementsByClassName("p_descrip")[0].innerHTML =
            newContent;
    });
});

const actualReq = document.getElementById("actual_req");
const reqs = document.querySelectorAll("#reqs_list #req");
reqs.forEach(function (el, i) {
    el.addEventListener("click", function (e) {
        const actualActive = document.querySelector("#req.active");
        const nextActive = reqs[i];
        actualActive.classList.remove("active");
        nextActive.classList.add("active");

        const newImg = nextActive.querySelector(".img img").src;
        const newTitle =
            nextActive.getElementsByClassName("title")[0].innerHTML;
        const newContent =
            nextActive.getElementsByClassName("description")[0].innerHTML;

        actualReq.querySelector(".p_img img").src = newImg;
        actualReq.getElementsByClassName("p_title")[0].innerHTML = newTitle;
        actualReq.getElementsByClassName("p_descrip")[0].innerHTML = newContent;
    });
});
