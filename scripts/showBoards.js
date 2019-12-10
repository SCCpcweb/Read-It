showBoards = () => {
    // get all "boards" elements
    let boards = document.getElementsByClassName("boards");

    // foreach "boards" element toggle the visibility to be none
    for (var i = 0; i < boards.length; i++) {
        boards[i].style.display = boards[i].style.display == "none" ? "block" : "none";
    }
}

// toggles the admin section on a subreddit page
toggleAdminSection = () => {
    // section of content that an admin can access
    let adminSection = document.getElementById("admin-section");
    adminSection.style.display = adminSection.style.display == "none" ? "block" : "none";
    // arrow icon for the toggle admin section button
    let arrow = document.getElementById("arrow");
    arrow.style.transform = arrow.style.transform == 'rotate(0deg)' ? 'rotate(180deg)' : 'rotate(0deg)';
}
