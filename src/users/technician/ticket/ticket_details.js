// JavaScript code to handle "Mark as Solution" click event
document.addEventListener('click', function (event) {
    console.log("clicked");
    if (event.target.classList.contains('solution-icon')) {
        // Get the parent comment div
        const commentDiv = event.target.closest('.comment');

        // Toggle a class to indicate it's marked as a solution
        commentDiv.classList.toggle('marked-solution');

        // You can also perform an AJAX request to update the server here
        // Example: Send a request to mark this comment as a solution in your database
        // You would need to implement the server-side logic to handle this request.
        // TODO: database add a column called "isSolution" to the comments table
    }
});
