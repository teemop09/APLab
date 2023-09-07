$(document).ready(function () {
    const startSolvingForm = document.getElementById("new-comment-form");
    if (startSolvingForm != null)
        startSolvingForm.style.display = "none";

    const startSolvingButton = document.getElementById("start-solving-button");
    if (startSolvingForm != null)
        startSolvingButton.addEventListener('click', function (event) {
            startSolvingForm.style.display = "block";
            startSolvingButton.style.display = "none";
            //TODO: notify user

        });
    // remove all solution buttons if one of them found to be solution
    const comments = document.querySelectorAll('.comment');
    for (let i = 0; i < comments.length; i++) {
        if (comments[i].classList.contains('marked-solution')) {
            removeSolutionButtons();
            break;
        }
    }

    // Add event listener to all solution buttons
    var solutionButtons = document.querySelectorAll(".mark-solution-button");
    solutionButtons.forEach(element => {

        element.addEventListener('click', function (event) {

            const commentDiv = event.target.closest('.comment');
            const solutionDiv = commentDiv.querySelector('.solution-header');
            // send POST request to mark_as_solution.php
            const commentId = commentDiv.dataset.commentId;
            console.log(commentId);
            const url = 'mark_as_solution.php';
            const data = {
                commentId: commentId
            };
            $.post(url, data, function (response) {
                if (response.toLowerCase() == '1') {
                    // Toggle a class to indicate it's marked as a solution
                    commentDiv.classList.add('marked-solution');
                    solutionDiv.classList.add('marked-solution');
                    removeSolutionButtons();
                    location.reload();
                } else {
                    alert('Failed to mark as solution. Please try again later');
                }
            });

            // You can also perform an AJAX request to update the server here
            // Example: Send a request to mark this comment as a solution in your database
            // You would need to implement the server-side logic to handle this request.
            // TODO: database add a column called "isSolution" to the comments table

        });
    });

});

function removeSolutionButtons() {
    // Remove all solution buttons

    const solutionButtons = document.querySelectorAll('.mark-solution');
    console.log(solutionButtons);
    for (let i = 0; i < solutionButtons.length; i++) {
        solutionButtons[i].remove();
    }

}