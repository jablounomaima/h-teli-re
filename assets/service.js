document.addEventListener("DOMContentLoaded", () => {
    const facilitiesItems = document.querySelectorAll(".facilities_item");

    facilitiesItems.forEach(item => {
        item.addEventListener("click", () => {
            alert(`You clicked on: ${item.querySelector("h4").textContent}`);
        });
    });
});
