document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll(".delete-booking");
    deleteButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            const bookingId = event.target.getAttribute("data-booking-id");
                // add confirmation
            if (!confirm("Are you sure you want to delete this booking?")) {
                return;
            }
            deleteBooking(bookingId, event.target);
        });
    });
});

function deleteBooking(bookingId, buttonElement) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../utility/deletebooking.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText.trim() === "success") {
                const row = buttonElement.parentElement.parentElement;
                row.parentElement.removeChild(row);
            } else {
                alert("Error: Could not delete booking.");
            }
        }
    };
    xhr.send("booking_id=" + encodeURIComponent(bookingId));
}
