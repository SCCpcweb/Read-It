showBoards = () => {
    // get all "boards" elements
    let boards = document.getElementsByClassName("boards");

    // foreach "boards" element toggle the visibility to be none
    for (var i = 0; i < boards.length; i++) {
        boards[i].style.display = boards[i].style.display == "none" ? "block" : "none";
    }
}
