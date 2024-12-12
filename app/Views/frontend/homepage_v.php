<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Sharasa - Team Planner</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="assets/js/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/css/style.css" />
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header green" id="logo">
                    <a href="index.html" class="logo">
                        <img src="assets/frontend/img/ShaRaSa-logo.png" alt="sharasa logo" class="navbar-brand" height="40" />
                    </a>
                </div>
                <!-- End Logo Header -->
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel green" id="level">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header green" id="logo">
                        <!-- <a href="index.html" class="logo">
                            <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                                height="20" />
                        </a> -->
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="page-header text-center text-white">
                        <div class="px-2 border-dashed pb-3 col-md-12">
                            <h3>Team Planner -<span id="current-month"></span> <span id="current-year"></span></h3>

                        </div>

                    </div>


                    <div class="row mt-3 justify-content-center">
                        <div class="col-md-3 col-sm-12 text-center">
                            <label for="plannerdate" class="form-label text-white">
                                <h5>Select Date:</h5>
                            </label>
                            <input type="date" class="form-control" id="plannerdate">
                        </div>
                    </div>


                    <div class="team-planner">
                        <div class="mt-2 col-md-12">
                            <!-- <label for="successInput">Levels</label> -->
                            <select class="form-select form-control mb-3" id="levelDropdown">
                                <option value="" disabled selected>-- Select a Level --</option>
                                <?php foreach ($levels as $level) {
                                    // Get the first word as the color
                                    $color = strtolower(explode(' ', $level->level_name)[0]);
                                ?>
                                    <option value="<?= $level->id ?>" data-color="<?= $color ?>">
                                        Level - <?= $level->id ?> : <?= $level->level_name ?>
                                    </option>
                                <?php } ?>
                            </select>

                        </div>
                        <div class="parent-card">
                            <div class="card card-round">
                                <div class="card-body" id="plannerContent">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright text-center">
                        Copyright &copy; 2024 <a href="http://www.sharasa.in">Sharasa</a>
                        <i class="fa fa-heart heart text-danger"></i>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>assets/frontend/js/jquery-3.7.1.min.js"></script>
    <script src="<?= base_url() ?>assets/frontend/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/frontend/js/bootstrap.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="<?= base_url() ?>assets/frontend/js/scripts.js"></script>
    <!-- Kaiadmin JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentYear = new Date().getFullYear();
            const currentMonth = new Date().toLocaleString('default', {
                month: 'long'
            }); // Get full month name
            document.getElementById("current-year").textContent = currentYear;
            document.getElementById("current-month").textContent = currentMonth;
        });

        $('#levelDropdown').change(function() {

            var selectedDate = $('#plannerdate').val(); // Get the value of the input
            var level = $(this).val();
            if (!selectedDate) {
                Swal.fire({
                    title: 'No Date Selected',
                    text: 'Please select a date before proceeding.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then(() => {
                    $(this).val(''); // Reset the dropdown to its default state
                });
                return; // Exit the function
            } else {
                $.ajax({
                    url: '<?= base_url() ?>get-content/' + selectedDate + '/' + level,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#plannerContent').html(data.content);

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }

        });


        $(document).ready(function() {
            $('#levelDropdown, #plannerdate').on('change', function() {
                const selectedLevel = $('#levelDropdown').val(); // Get the selected level
                const selectedDate = $('#plannerdate').val(); // Get the selected date
                if (selectedLevel && selectedDate) {
                    $('.parent-card').fadeIn(); // Show the card if both are selected
                } else {
                    $('.parent-card').fadeOut(); // Hide the card if either is not selected
                }
            });
        });

        $(document).ready(function() {
            // Set the current date by default in the date input
            var today = new Date().toISOString().split('T')[0];
            $('#plannerdate').val(today);

            // Set level 1 (green level) as default
            $('#levelDropdown').val('1'); // Assuming level 1 has ID '1'

            // Trigger the change events on page load to display content based on the current date and level
            $('#plannerdate').trigger('change');
            $('#levelDropdown').trigger('change');

            $('#levelDropdown').on('change', function() {
                const selectedLevel = $(this).val(); // Get selected level value
                const selectedDate = $('#plannerdate').val(); // Get selected date

                if (selectedLevel && selectedDate) {
                    // Show the card if both are selected
                    $('.parent-card').fadeIn();

                    // Get the color based on the selected level
                    const selectedOption = $('#levelDropdown option:selected');
                    const color = selectedOption.data('color'); // Get color from data-color attribute

                    // Change the background color of the main panel and the logo background
                    $('.main-panel').css('background-color', getColorByName(color));
                    $('#logo').css('background-color', getColorByName(color)); // Change logo background color
                } else {
                    // Hide the card if any selection is missing
                    $('.parent-card').fadeOut();
                }
            });

            // Function to return color based on the level name
            function getColorByName(level) {
                const colors = {
                    green: '#6AC259',
                    red: '#FF0000',
                    blue: '#0000FF',
                    yellow: '#FFD700', // Added yellow
                };
                return colors[level] || '#000000'; // Default to black if no match
            }
        });
    </script> -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Set the current year and month on the page
            const currentYear = new Date().getFullYear();
            const currentMonth = new Date().toLocaleString('default', {
                month: 'long'
            }); // Get full month name
            document.getElementById("current-year").textContent = currentYear;
            document.getElementById("current-month").textContent = currentMonth;
        });

        $(document).ready(function() {
            // Set default date and level
            const today = new Date().toISOString().split('T')[0];
            $('#plannerdate').val(today); // Set current date
            $('#levelDropdown').val('');
            $('.parent-card').hide();

            // Trigger initial UI update
            updateUI();

            // Event listener for level dropdown
            $('#levelDropdown').change(function() {
                const selectedLevel = $(this).val();
                const selectedDate = $('#plannerdate').val();
                // Clear the content area when level changes
                $('#plannerContent').html('');

                // Validate if a date is selected
                if (!selectedDate) {
                    Swal.fire({
                        title: 'No Date Selected',
                        text: 'Please select a date before proceeding.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $(this).val(''); // Reset the dropdown to its default state
                    });
                    return;
                }

                // Fetch content for the selected date and level
                fetchContent();
            });

            // Event listener for date input
            $('#plannerdate').change(function() {
                const selectedDate = $(this).val();
                const selectedLevel = $('#levelDropdown').val();

                // Fetch content only if both date and level are selected
                if (selectedDate && selectedLevel) {
                    fetchContent();
                }
            });

            // Show or hide UI elements based on selections
            $('#levelDropdown, #plannerdate').on('change', function() {
                updateUI();
            });

            /**
             * Fetch content for the selected date and level
             */
            function fetchContent() {
                const selectedDate = $('#plannerdate').val();
                const selectedLevel = $('#levelDropdown').val();

                $.ajax({
                    url: `<?= base_url() ?>get-content/${selectedDate}/${selectedLevel}`,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#plannerContent').html(data.content || 'No content available.');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Failed to load content.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }

            /**
             * Update the UI based on the selected level and date
             */
            function updateUI() {
                const selectedDate = $('#plannerdate').val();
                const selectedLevel = $('#levelDropdown').val();

                if (selectedDate && selectedLevel) {
                    $('.parent-card').fadeIn(); // Show the card
                    updateBackgroundColor();
                } else {
                    $('.parent-card').fadeOut(); // Hide the card
                }
            }

            /**
             * Update the background colors based on the selected level
             */
            function updateBackgroundColor() {
                const selectedOption = $('#levelDropdown option:selected');
                const color = selectedOption.data('color'); // Get color from the `data-color` attribute

                if (color) {
                    $('.main-panel').css('background-color', getColorByName(color));
                    $('#logo').css('background-color', getColorByName(color));
                }
            }

            /**
             * Map level names to colors
             * @param {string} level - The level name
             * @returns {string} - The corresponding color
             */
            function getColorByName(level) {
                const colors = {
                    green: '#6AC259',
                    red: '#FF0000',
                    blue: '#0000FF',
                    yellow: '#FFD700' // Added yellow for completeness
                };
                return colors[level] || '#000000'; // Default to black if no match
            }
        });
    </script>

</body>
</body>

</html>