</div>
<!-- footer -->
<footer class="pt-5 pb-3  mt-auto">
    <div class="container-fluid">

        <!-- Desc -->
        <hr class="mt-6 mb-3">
        <div class="row align-items-center">
            <!-- Desc -->
            <div class="col-12">
                <span>
                    ©
                    <span id="copyright4">
                        <script>
                        document.getElementById("copyright4").appendChild(document.createTextNode(new Date()
                            .getFullYear()));
                        </script>
                    </span>
                    Lal Bahadur Shastri National Academy of Administration Mussoorie,Govt of India. All Right Reserved
                </span>
            </div>
        </div>

        <!-- Links -->
    </div>
</footer>

<!-- Scroll top -->
<div class="btn-scroll-top" tabindex="0" role="button" aria-label="Go to Top">
    <svg class="progress-square svg-content" width="100%" height="100%" viewBox="0 0 40 40">
        <path
            d="M8 1H32C35.866 1 39 4.13401 39 8V32C39 35.866 35.866 39 32 39H8C4.13401 39 1 35.866 1 32V8C1 4.13401 4.13401 1 8 1Z">
        </path>
    </svg>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let scrollButton = document.querySelector(".btn-scroll-top");

    // Show button when scrolling down
    window.addEventListener("scroll", function() {
        if (window.scrollY > 200) {
            scrollButton.classList.add("show");
        } else {
            scrollButton.classList.remove("show");
        }
    });

    // Click or Enter/Space key to scroll to top
    scrollButton.addEventListener("click", scrollToTop);
    scrollButton.addEventListener("keydown", function(event) {
        if (event.key === "Enter" || event.key === " ") {
            scrollToTop();
        }
    });

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }
});
</script>
<!-- js for micro home slider play/pause button -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    var carousel = new bootstrap.Carousel(document.getElementById('carouselExampleCaptions'), {
        interval: 3000, // Default interval
        ride: 'carousel'
    });

    var playPauseBtn = document.getElementById("playPauseBtn");
    var isPlaying = true; // Track the state of the slider

    playPauseBtn.addEventListener("click", function() {
        if (isPlaying) {
            carousel.pause();
            playPauseBtn.innerHTML = '<i class="bi bi-play-fill"></i> Play';
            playPauseBtn.classList.replace("btn-danger", "btn-success");
            playPauseBtn.setAttribute("aria-label", "Slider paused"); // Update aria-label
        } else {
            carousel.cycle();
            playPauseBtn.innerHTML = '<i class="bi bi-pause-fill"></i> Pause';
            playPauseBtn.classList.replace("btn-success", "btn-danger");
            playPauseBtn.setAttribute("aria-label", "Slider played"); // Update aria-label
        }
        isPlaying = !isPlaying; // Toggle state
    });
});
</script>

<!-- js for calender of micro site -->
<script>
$(document).ready(function() {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    /*  className colors

		className: default(transparent), important(red), chill(pink), success(green), info(blue)

		*/

    /* initialize the external events
		-----------------------------------------------------------------*/

    $("#external-events div.external-event").each(function() {
        // create an Event Object (https://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data("eventObject", eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true, // will cause the event to go back to its
            revertDuration: 0 //  original position after the drag
        });
    });

    /* initialize the calendar
		-----------------------------------------------------------------*/

    var calendar = $("#calendar").fullCalendar({
        header: {
            left: "title",
            center: "agendaDay,agendaWeek,month",
            right: "prev,next today"
        },
        editable: true,
        firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
        selectable: true,
        defaultView: "month",

        axisFormat: "h:mm",
        columnFormat: {
            month: "ddd", // Mon
            week: "ddd d", // Mon 7
            day: "dddd M/d", // Monday 9/7
            agendaDay: "dddd d"
        },
        titleFormat: {
            month: "MMMM yyyy", // September 2009
            week: "MMMM yyyy", // September 2009
            day: "MMMM yyyy" // Tuesday, Sep 8, 2009
        },
        allDaySlot: false,
        selectHelper: true,
        select: function(start, end, allDay) {
            var title = prompt("Event Title:");
            if (title) {
                calendar.fullCalendar(
                    "renderEvent", {
                        title: title,
                        start: start,
                        end: end,
                        allDay: allDay
                    },
                    true // make the event "stick"
                );
            }
            calendar.fullCalendar("unselect");
        },
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) {
            // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data("eventObject");

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (https://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $("#calendar").fullCalendar("renderEvent", copiedEventObject, true);

            // is the "remove after drop" checkbox checked?
            if ($("#drop-remove").is(":checked")) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        },

        events: [{
                title: "All Day Event",
                start: new Date(y, m, 1)
            },
            {
                id: 999,
                title: "Repeating Event",
                start: new Date(y, m, d - 3, 16, 0),
                allDay: false,
                className: "info"
            },
            {
                id: 999,
                title: "Repeating Event",
                start: new Date(y, m, d + 4, 16, 0),
                allDay: false,
                className: "info"
            },
            {
                title: "Meeting",
                start: new Date(y, m, d, 10, 30),
                allDay: false,
                className: "important"
            },
            {
                title: "Lunch",
                start: new Date(y, m, d, 12, 0),
                end: new Date(y, m, d, 14, 0),
                allDay: false,
                className: "important"
            },
            {
                title: "Birthday Party",
                start: new Date(y, m, d + 1, 19, 0),
                end: new Date(y, m, d + 1, 22, 30),
                allDay: false
            },
            {
                title: "Click for Google",
                start: new Date(y, m, 28),
                end: new Date(y, m, 29),
                url: "https://google.com/",
                className: "success"
            }
        ]
    });
});
    </script>
<!-- Scripts -->
<!-- Libs JS -->
<script src="{{ asset('assets/libs/%40popperjs/core/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>

<!-- Theme JS -->
<script src="{{ asset('assets/js/theme.min.js') }}"></script>


<script src="{{ asset('assets/libs/tippy.js/dist/tippy-bundle.umd.min.js') }}"></script>

<script src="{{ asset('assets/js/vendors/tooltip.js') }}"></script>
<script src="{{ asset('assets/libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/js/vendors/tnsSlider.js') }}"></script>
</body>

</html>