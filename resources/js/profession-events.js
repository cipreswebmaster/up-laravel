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

/**
 * Menú lateral
 */

(function () {
    const sections = document.querySelectorAll(".single_section");
    let sectionsPos = [];
    sections.forEach(function (sec) {
        const id = sec.id;
        const documentOffset = window.pageYOffset;
        const sectionData = sec.getBoundingClientRect();
        const absolutePos = documentOffset + sectionData.top - 150;
        sectionsPos[id] = absolutePos;
    });

    const menuSections = document.querySelectorAll(".career_menu_section");
    menuSections.forEach(function (sec) {
        sec.addEventListener("click", function () {
            const id = sec.dataset.id;
            window.scrollTo({
                top: sectionsPos[id],
            });
            changeSelected(id);
        });
    });

    const sectionPosKeys = Object.keys(sectionsPos);
    const sectionPosVals = Object.values(sectionsPos);
    window.addEventListener("scroll", function (e) {
        const index = sectionPosVals.findIndex(function (val, idx, arr) {
            const pos = window.pageYOffset + 150;
            return (
                (!idx && pos < val) ||
                (idx == sectionPosVals.length - 1 && pos > val) ||
                (pos > val && pos < arr[idx + 1])
            );
        });
        const found = this.document.querySelector(
            `[data-id=${sectionPosKeys[index]}]`
        );
        if (!found.classList.contains("active"))
            changeSelected(sectionPosKeys[index]);
    });
})();

function changeSelected(id) {
    const newSelected = document.querySelector(`[data-id=${id}]`);
    const actualSelected = document.querySelector(
        ".career_menu_section.active"
    );
    actualSelected.classList.remove("active");
    newSelected.classList.add("active");
}
