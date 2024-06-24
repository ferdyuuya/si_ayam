document.addEventListener("DOMContentLoaded", function () {
    var startTernakModal = document.getElementById("startTernakModal");
    var endTernakModal = document.getElementById("endTernakModal");
    var startTernakBtn = document.getElementById("startTernak");
    var endTernakBtn = document.getElementById("endTernak");
    var spans = document.getElementsByClassName("close");

    // Function to open a modal
    function openModal(modal) {
        modal.style.display = "block";
    }

    // Function to close a modal
    function closeModal(modal) {
        modal.style.display = "none";
    }

    // Event listeners for buttons
    if (startTernakBtn) {
        startTernakBtn.onclick = function () {
            openModal(startTernakModal);
            console.log("Opened");
        };
    }

    // Fixed event listener for the endTernak button
    if (endTernakBtn) {
        endTernakBtn.onclick = function () {
            openModal(endTernakModal); // Open the endTernakModal
            console.log("Closed");
        };
    }

    // Event listeners for close buttons
    for (var i = 0; i < spans.length; i++) {
        spans[i].onclick = function () {
            closeModal(this.closest(".modal")); // Close the closest modal
        };
    }

    // Close modal on click outside
    window.onclick = function (event) {
        if (event.target == startTernakModal) {
            closeModal(startTernakModal);
        } else if (event.target == endTernakModal) {
            closeModal(endTernakModal);
        }
    };

    document.addEventListener("DOMContentLoaded", function () {
        const elapsedTimeElement = document.getElementById("elapsedTime");
        const createdAt =
            "{{ $latestOngoingTernak ? $latestOngoingTernak->created_at : null }}";

        if (elapsedTimeElement && createdAt) {
            updateElapsedTime(elapsedTimeElement, createdAt); // Initial update
            setInterval(
                () => updateElapsedTime(elapsedTimeElement, createdAt),
                1000
            ); // Update every second
        }

        function updateElapsedTime(element, createdAt) {
            const start = moment(createdAt);
            const now = moment();
            const duration = moment.duration(now.diff(start));

            element.textContent =
                duration.days() +
                " days " +
                duration.hours() +
                " hours " +
                duration.minutes() +
                " minutes " +
                duration.seconds() +
                " seconds";
        }
    });
});
