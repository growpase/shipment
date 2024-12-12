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
    <script src="<?= base_url() ?>assets/frontend/js/webfont.min.js"></script>
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
                urls: ["assets/frontend/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&display=swap" rel="stylesheet">

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
                <div class="logo-header green">
                    <a href="index.html" class="logo">
                        <img src="<?= base_url() ?>assets/frontend/img/ShaRaSa-logo.png" alt="sharasa logo" class="navbar-brand" height="40" />
                    </a>
                </div>
                <!-- End Logo Header -->
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel green">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header green">
                        <!-- <a href="index.html" class="logo">
                            <img src="<?= base_url() ?>assets/frontend/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
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
                    <div class="page-header text-center">
                        <div class="px-2 border-dashed pb-3 col-md-12">
                            <h5 class="fw-bold mb-3 text-white">Team Planner - December 2024</h5>
                            <!--<h6 class="mb-2 text-white"><span class="fw-bold">Name of the kid</span> - Piyush Joshi</h6>
                            <h6 class="text-white"><span class="fw-bold">Age</span> - 2 years</h6>-->
                        </div>
                    </div>

                    <div class="mt-3 col-md-12">
                        <a id="topDate" class="text-white text-center date-click">13th Friday</a>
                        <div id="dateList">
                            <div class="card-list pb-4">
                                <div class="item-list">
                                    <div class="date-list" data-link="9th-dec.html">
                                        <div class="date-div">9th <span class="status fw-bold">Dec</span></div>
                                        <div class="status text-right">Monday</div>
                                    </div>
                                </div>
                                <div class="item-list">
                                    <div class="date-list" data-link="10th-dec.html">
                                        <div class="date-div">10th <span class="status fw-bold">Dec</span></div>
                                        <div class="status text-right">Tuesday</div>
                                    </div>
                                </div>
                                <div class="item-list">
                                    <div class="date-list" data-link="11th-dec.html">
                                        <div class="date-div">11th <span class="status fw-bold">Dec</span></div>
                                        <div class="status text-right">Wednesday</div>
                                    </div>
                                </div>
                                <div class="item-list">
                                    <div class="date-list" data-link="12th-dec.html">
                                        <div class="date-div">12th <span class="status fw-bold">Dec</span></div>
                                        <div class="status text-right">Thursday</div>
                                    </div>
                                </div>
                                <div class="item-list">
                                    <div class="date-list" data-link="13th-dec.html">
                                        <div class="date-div">13th <span class="status fw-bold">Dec</span></div>
                                        <div class="status text-right">Friday</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="team-planner">
                        <div class="mt-2 col-md-12">
                            <!-- <label for="successInput">Levels</label> -->
                            <select class="form-select form-control mb-3" id="parent-level">
                                <!-- <option value="" >Select Level</option> -->
                                <option value="level-1" selected="selected">Level 1 - Green Wings</option>
                                <option value="level-2">Level 2 - Red Wings</option>
                                <option value="level-3">Level 3 - Blue Wings</option>
                                <option value="level-4">Level 4 - Blue Wings</option>
                                <option value="level-5">Level 5 - Yellow Wings</option>
                                <option value="level-6">Level 6 - Yellow Wings</option>
                            </select>
                        </div>
                        <div class="parent-card green" data-value="level-1">
                            <div class="card card-round">
                                <div class="card-body">
                                    <div class="session-1">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2">
                                            <div class="card-title">Welcome Session - Revision</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold">Welcome Session: Yoga for Kids (Up to 6 Years)</h6>

                                            <h6 class="fw-bold mt-3"><b>Duration:</b>30 minutes</h6>
                                            <h6 class="fw-bold mt-3"><b>Focus:</b> Flexibility, stamina, and enjoyment</h6>
                                            <h6 class="fw-bold mt-3"><b>Session Plan</b></h6>
                                            <ol>
                                                <li>Welcome & Warm-Up (5 minutes)</li>
                                                <ol>
                                                    <li>Greeting:</li>
                                                    <ul>
                                                        <li>Begin with a cheerful "Namaste" or "Hello Yoga Stars!"</li>
                                                        <li>Introduce the session theme: "Let’s stretch like animals, fly like birds, and grow stronger together!"</li>
                                                    </ul>
                                                    <li>Warm-Up Poses:</li>
                                                    <ul>
                                                        <li><b>Sun Stretch:</b> Stand tall, stretch arms up, and gently sway side to side like a tree.</li>
                                                        <li><b>Marching:</b> March in place while swinging arms.</li>
                                                    </ul>
                                                </ol>
                                                <li>Fun Yoga Poses (15 minutes)</li>
                                                <div>Incorporate playful yoga poses to keep children engaged.</div>
                                                <ol>
                                                    <li>Animal Poses:</li>
                                                    <ul>
                                                        <li><b>Cat-Cow Pose:</b> On hands and knees, alternate arching and rounding the back.</li>
                                                        <li><b>Frog Jump:</b> Squat like a frog and hop forward.</li>
                                                    </ul>
                                                    <li>Bird Poses:</li>
                                                    <ul>
                                                        <li><b>Butterfly Pose:</b> Sit with feet together, flapping knees like butterfly wings.</li>
                                                        <li><b>Flamingo Balance: </b>Stand on one leg and flap "wings."</li>
                                                    </ul>
                                                    <li>Stretching Poses:</li>
                                                    <ul>
                                                        <li><b>Cobra Pose:</b> Lie on the tummy, lift chest, and hiss like a snake.</li>
                                                        <li><b>Downward Dog: </b>Form an inverted "V" shape, pretending to bark like a puppy.</li>
                                                    </ul>
                                                </ol>
                                                <li>Stamina-Building Game (5 minutes)</li>
                                                <ol>
                                                    <li>Yoga Adventure:</li>
                                                    <ul>
                                                        <li>Create a story with movements (e.g., climbing mountains, swimming rivers, jumping over rocks).</li>
                                                        <li>Incorporate yoga poses as part of the adventure.</li>
                                                    </ul>
                                                </ol>
                                                <li>Cool-Down & Relaxation (5 minutes)</li>
                                                <ol>
                                                    <li><b>Star Pose:</b> Lie down with arms and legs stretched wide, imagining being a shining star in the sky</li>
                                                    <li><b>Bubble Breathing:</b> Pretend to blow bubbles slowly while taking deep breaths in and out.</li>
                                                </ol>
                                                <li>Closing (1 minute)</li>
                                                <ul>
                                                    <li>End with a fun chant: "Yoga is fun, we’re strong, and we’re done!"</li>
                                                    <li>Thank the kids for their energy and smiles.</li>
                                                </ul>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="session-2">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2">
                                            <div class="card-title">Play Session - Revision</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold mt-3">1. Warm-Up (3 minutes)</h6>
                                            <ul>
                                                <li>Begin with a cheerful greeting and clapping.</li>
                                                <li>Ask the kids if they know the ABC song and let them hum it once together.</li>
                                            </ul>
                                            <h6 class="fw-bold mt-3">2.Main Activity (10 minutes)</h6>
                                            <ul>
                                                <li><b>First Round (3 minutes):</b> Sing the ABC song together slowly, pointing to large flashcards or a visual chart of the letters for visual reinforcement.</li>
                                                <li><b>Second Round (3 minutes):</b> Add actions or props:</li>
                                                <ul>
                                                    <li>Clap hands for vowels (A, E, I, O, U)</li>
                                                    <li>Stomp feet for consonants.</li>
                                                </ul>
                                                <li>Third Round (4 minutes):</li>
                                                <ul>
                                                    <li>Sing the ABC song at a faster pace for fun.</li>
                                                    <li>Split kids into two groups, where one group sings the first half (A-M) and the other sings the second half (N-Z).</li>
                                                </ul>
                                            </ul>
                                            <h6 class="fw-bold mt-3">3. Cool Down (2 minutes)</h6>
                                            <ul>
                                                <li>Ask kids their favorite letter and why.</li>
                                                <li>End with a cheerful goodbye song that includes the alphabet, like “Goodbye with ABCs.”</li>
                                            </ul>

                                            <h6 class="fw-bold mt-3">Materials Needed:</h6>
                                            <ul>
                                                <li>Alphabet flashcards or charts.</li>
                                                <li>Small props (like flags or sticks) for actions.</li>
                                            </ul>
                                            <h6 class="fw-bold mt-3">Outcome:</h6>
                                            <div>Kids will improve their alphabet familiarity while engaging in an energetic, rhythmic activity</div>
                                        </div>
                                    </div>
                                    <div class="session-3">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Q & A Session - Imagination and Creativity</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold mt-3">1. Can you pretend to be a superhero? What would your superpower be?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>

                                            <h6 class="fw-bold mt-3">2. Can you draw a picture of your favorite animal?</h6>
                                            <div><span class="fw-bold">Ans -</span>Demonstration</div>

                                            <h6 class="fw-bold mt-3">3. If you could be any character from a story, who would you be?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>
                                            <h6 class="fw-bold mt-3">4. Can you make up a short story about a dragon?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>

                                            <h6 class="fw-bold mt-3">5. What would you build if you had a lot of Lego bricks?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>

                                        </div>
                                    </div>
                                    <div class="session-4">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Skill Session - Twirling Tots</div>
                                        </div>
                                        <h6 class="mt-3">Day 5: Twirling Tots - Obstacle Course Adventure (Revision Day)</h6>

                                        <h6 class="fw-bold">Activity Goal:</h6>
                                        <div>Revisit and reinforce hand-eye coordination skills through an active obstacle course.
                                        </div>
                                        <h6 class="fw-bold mt-3">Materials Needed:</h6>
                                        <div>-Soft, brightly colored cones</div>
                                        <div>-Tunnels</div>
                                        <div>-Soft play mat</div>

                                        <h6 class="fw-bold mt-3">Activity Guidelines:</h6>
                                        <ol>
                                            <li>Create a mini obstacle course using cones and tunnels.</li>
                                            <li>Guide infants through the course, encouraging reaching and interaction with cones.</li>
                                            <li>Celebrate their progress and participation.</li>
                                        </ol>
                                        <h6 class="fw-bold mt-3">Instructions for Trainers:</h6>
                                        <div>-Monitor and guide infants through the course.</div>
                                        <div>-Use positive reinforcement to motivate them.</div>
                                        <div>-Prioritize safety and ensure a fun experience.</div>
                                        <h6 class="fw-bold mt-3">Note to Teachers:</h6>
                                        <div>-Always prioritize the safety and comfort of the infants during the activities.</div>
                                        <div>-Adapt the activities based on the infants' individual developmental levels.</div>
                                        <div>-Encourage communication and interaction between teachers and infants during each activity.</div>
                                        <div>-Document observations and progress to track developmental milestones.</div>
                                        <div>Remember, the key is to create a positive and engaging learning environment where infants can explore, learn, and have fun!</div>
                                    </div>

                                    <div class="session-5">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Food Session - Tale of the Coconut</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold">नारळाची गोष्ट (The Tale of the Coconut)</h6>
                                            <div><b>Summary:</b> नारळ कसा पिकतो, त्याचे पाणी, आणि खवलेला नारळ कसा खायचा याची गोष्ट.<b> Moral: </b>नारळाच्या विविध उपयोगांबद्दल माहिती.</div>
                                        </div>
                                    </div>
                                    <div class="session-6">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Good Bye Session - Ocean Life Puzzle</div>
                                        </div>
                                        <h6 class="fw-bold mt-3">Ocean Life Puzzle</h6>
                                        <ul>
                                            <li><b>Activity:</b>Puzzles featuring various ocean creatures (fish, octopus, starfish, etc.).</li>
                                            <li><b>Goal:</b>Kids complete the puzzles and identify each ocean creature.</li>
                                            <li><b>Instructions:</b>Enhance knowledge of marine life and improve fine motor skills.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="parent-card red" data-value="level-2" style="display: none;">
                            <div class="card card-round">
                                <div class="card-body">
                                    <div class="session-1">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2">
                                            <div class="card-title">Welcome Session - Revision</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold">Welcome Session: Yoga for Kids (Up to 6 Years)</h6>

                                            <h6 class="fw-bold mt-3"><b>Duration:</b>30 minutes</h6>
                                            <h6 class="fw-bold mt-3"><b>Focus:</b> Flexibility, stamina, and enjoyment</h6>
                                            <h6 class="fw-bold mt-3"><b>Session Plan</b></h6>
                                            <ol>
                                                <li>Welcome & Warm-Up (5 minutes)</li>
                                                <ol>
                                                    <li>Greeting:</li>
                                                    <ul>
                                                        <li>Begin with a cheerful "Namaste" or "Hello Yoga Stars!"</li>
                                                        <li>Introduce the session theme: "Let’s stretch like animals, fly like birds, and grow stronger together!"</li>
                                                    </ul>
                                                    <li>Warm-Up Poses:</li>
                                                    <ul>
                                                        <li><b>Sun Stretch:</b> Stand tall, stretch arms up, and gently sway side to side like a tree.</li>
                                                        <li><b>Marching:</b> March in place while swinging arms.</li>
                                                    </ul>
                                                </ol>
                                                <li>Fun Yoga Poses (15 minutes)</li>
                                                <div>Incorporate playful yoga poses to keep children engaged.</div>
                                                <ol>
                                                    <li>Animal Poses:</li>
                                                    <ul>
                                                        <li><b>Cat-Cow Pose:</b> On hands and knees, alternate arching and rounding the back.</li>
                                                        <li><b>Frog Jump:</b> Squat like a frog and hop forward.</li>
                                                    </ul>
                                                    <li>Bird Poses:</li>
                                                    <ul>
                                                        <li><b>Butterfly Pose:</b> Sit with feet together, flapping knees like butterfly wings.</li>
                                                        <li><b>Flamingo Balance: </b>Stand on one leg and flap "wings."</li>
                                                    </ul>
                                                    <li>Stretching Poses:</li>
                                                    <ul>
                                                        <li><b>Cobra Pose:</b> Lie on the tummy, lift chest, and hiss like a snake.</li>
                                                        <li><b>Downward Dog: </b>Form an inverted "V" shape, pretending to bark like a puppy.</li>
                                                    </ul>
                                                </ol>
                                                <li>Stamina-Building Game (5 minutes)</li>
                                                <ol>
                                                    <li>Yoga Adventure:</li>
                                                    <ul>
                                                        <li>Create a story with movements (e.g., climbing mountains, swimming rivers, jumping over rocks).</li>
                                                        <li>Incorporate yoga poses as part of the adventure.</li>
                                                    </ul>
                                                </ol>
                                                <li>Cool-Down & Relaxation (5 minutes)</li>
                                                <ol>
                                                    <li><b>Star Pose:</b> Lie down with arms and legs stretched wide, imagining being a shining star in the sky</li>
                                                    <li><b>Bubble Breathing:</b> Pretend to blow bubbles slowly while taking deep breaths in and out.</li>
                                                </ol>
                                                <li>Closing (1 minute)</li>
                                                <ul>
                                                    <li>End with a fun chant: "Yoga is fun, we’re strong, and we’re done!"</li>
                                                    <li>Thank the kids for their energy and smiles.</li>
                                                </ul>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="session-2">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2">
                                            <div class="card-title">Play Session - Revision</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold mt-3">1. Warm-Up (3 minutes)</h6>

                                            <ul>
                                                <li>Begin with a cheerful greeting and clapping.</li>
                                                <li>Ask the kids if they know the ABC song and let them hum it once together.</li>

                                            </ul>

                                            <h6 class="fw-bold mt-3">2.Main Activity (10 minutes)</h6>
                                            <ul>
                                                <li><b>First Round (3 minutes):</b> Sing the ABC song together slowly, pointing to large flashcards or a visual chart of the letters for visual reinforcement.</li>
                                                <li><b>Second Round (3 minutes):</b> Add actions or props:</li>
                                                <ul>
                                                    <li>Clap hands for vowels (A, E, I, O, U)</li>
                                                    <li>Stomp feet for consonants.</li>
                                                </ul>
                                                <li>Third Round (4 minutes):</li>
                                                <ul>
                                                    <li>Sing the ABC song at a faster pace for fun.</li>
                                                    <li>Split kids into two groups, where one group sings the first half (A-M) and the other sings the second half (N-Z).</li>
                                                </ul>
                                            </ul>
                                            <h6 class="fw-bold mt-3">3. Cool Down (2 minutes)</h6>
                                            <ul>
                                                <li>Ask kids their favorite letter and why.</li>
                                                <li>End with a cheerful goodbye song that includes the alphabet, like “Goodbye with ABCs.”</li>
                                            </ul>

                                            <h6 class="fw-bold mt-3">Materials Needed:</h6>
                                            <ul>
                                                <li>Alphabet flashcards or charts.</li>
                                                <li>Small props (like flags or sticks) for actions.</li>
                                            </ul>
                                            <h6 class="fw-bold mt-3">Outcome:</h6>
                                            <div>Kids will improve their alphabet familiarity while engaging in an energetic, rhythmic activity</div>
                                        </div>
                                    </div>
                                    <div class="session-3">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Q & A Session - Imagination and Creativity</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold mt-3">1. Can you pretend to be a superhero? What would your superpower be?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>

                                            <h6 class="fw-bold mt-3">2. Can you draw a picture of your favorite animal?</h6>
                                            <div><span class="fw-bold">Ans -</span>Demonstration</div>

                                            <h6 class="fw-bold mt-3">3. If you could be any character from a story, who would you be?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>
                                            <h6 class="fw-bold mt-3">4. Can you make up a short story about a dragon?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>

                                            <h6 class="fw-bold mt-3">5. What would you build if you had a lot of Lego bricks?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>
                                        </div>
                                    </div>
                                    <div class="session-4">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Skill Session - Memory Maze Challenge</div>
                                        </div>
                                        <h6 class="fw-bold ">Activity 5: Object Permanence Obstacle Course - "Memory Maze Challenge" (Revision)</h6>
                                        <h6 class="fw-bold mt-3">Activity Goal:</h6>
                                        <div>Consolidate understanding of Object Permanence through an interactive challenge.</div>
                                        <h6 class="fw-bold mt-3">Materials Needed:</h6>
                                        <div>Objects from previous activities, obstacles (e.g., pillows, cones), clues.
                                        </div>
                                        <h6 class="fw-bold mt-3">Activity Guidelines:</h6>
                                        <ol>
                                            <li>Set up an obstacle course using household items.</li>
                                            <li>Place hidden objects along the course, and provide clues and challenges.</li>
                                            <li>Encourage children to navigate the course, find the hidden objects, and complete the challenges..</li>

                                        </ol>
                                        <h6 class="fw-bold mt-3">Instructions for Trainers:</h6>
                                        <div>-Design the obstacle course and prepare the hidden objects and challenges.</div>
                                        <div>-Explain the purpose of the revision activity to reinforce Object Permanence.</div>
                                        <div>-Ensure a safe and engaging course for children to explore.</div>
                                        <h6 class="fw-bold mt-3">Preparation Before a Week:</h6>
                                        <ol>
                                            <li>Gather all necessary materials for each activity.</li>
                                            <li>Test and ensure that all materials are safe and age-appropriate.</li>
                                            <li>Create written clues for Activity 2 (Treasure Hunt Adventure) and prepare the boxes for Activity 3 (DIY Mystery Box).</li>
                                            <li>Set up the obstacle course for Activity 5 (Object Permanence Obstacle Course) in the designated space.</li>
                                        </ol>
                                        <div>Remember to maintain a positive and supportive atmosphere throughout these activities, fostering intellectual development while having fun with the children.</div>
                                    </div>
                                    <div class="session-5">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Food Session - Tale of the Coconut</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold">नारळाची गोष्ट (The Tale of the Coconut)</h6>
                                            <div><b>Summary:</b> नारळ कसा पिकतो, त्याचे पाणी, आणि खवलेला नारळ कसा खायचा याची गोष्ट.<b> Moral: </b>नारळाच्या विविध उपयोगांबद्दल माहिती.</div>
                                        </div>
                                    </div>
                                    <div class="session-6">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Good Bye Session - Ocean Life Puzzle</div>
                                        </div>
                                        <h6 class="fw-bold mt-3">Ocean Life Puzzle</h6>
                                        <ul>
                                            <li><b>Activity:</b>Puzzles featuring various ocean creatures (fish, octopus, starfish, etc.).</li>
                                            <li><b>Goal:</b>Kids complete the puzzles and identify each ocean creature.</li>
                                            <li><b>Instructions:</b>Enhance knowledge of marine life and improve fine motor skills.</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="parent-card blue" data-value="level-3" style="display: none;">
                            <div class="card card-round">
                                <div class="card-body">
                                    <div class="session-1">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2">
                                            <div class="card-title">Welcome Session - Revision</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold">Welcome Session: Yoga for Kids (Up to 6 Years)</h6>

                                            <h6 class="fw-bold mt-3"><b>Duration:</b>30 minutes</h6>
                                            <h6 class="fw-bold mt-3"><b>Focus:</b> Flexibility, stamina, and enjoyment</h6>
                                            <h6 class="fw-bold mt-3"><b>Session Plan</b></h6>
                                            <ol>
                                                <li>Welcome & Warm-Up (5 minutes)</li>
                                                <ol>
                                                    <li>Greeting:</li>
                                                    <ul>
                                                        <li>Begin with a cheerful "Namaste" or "Hello Yoga Stars!"</li>
                                                        <li>Introduce the session theme: "Let’s stretch like animals, fly like birds, and grow stronger together!"</li>
                                                    </ul>
                                                    <li>Warm-Up Poses:</li>
                                                    <ul>
                                                        <li><b>Sun Stretch:</b> Stand tall, stretch arms up, and gently sway side to side like a tree.</li>
                                                        <li><b>Marching:</b> March in place while swinging arms.</li>
                                                    </ul>
                                                </ol>
                                                <li>Fun Yoga Poses (15 minutes)</li>
                                                <div>Incorporate playful yoga poses to keep children engaged.</div>
                                                <ol>
                                                    <li>Animal Poses:</li>
                                                    <ul>
                                                        <li><b>Cat-Cow Pose:</b> On hands and knees, alternate arching and rounding the back.</li>
                                                        <li><b>Frog Jump:</b> Squat like a frog and hop forward.</li>
                                                    </ul>
                                                    <li>Bird Poses:</li>
                                                    <ul>
                                                        <li><b>Butterfly Pose:</b> Sit with feet together, flapping knees like butterfly wings.</li>
                                                        <li><b>Flamingo Balance: </b>Stand on one leg and flap "wings."</li>
                                                    </ul>
                                                    <li>Stretching Poses:</li>
                                                    <ul>
                                                        <li><b>Cobra Pose:</b> Lie on the tummy, lift chest, and hiss like a snake.</li>
                                                        <li><b>Downward Dog: </b>Form an inverted "V" shape, pretending to bark like a puppy.</li>
                                                    </ul>
                                                </ol>
                                                <li>Stamina-Building Game (5 minutes)</li>
                                                <ol>
                                                    <li>Yoga Adventure:</li>
                                                    <ul>
                                                        <li>Create a story with movements (e.g., climbing mountains, swimming rivers, jumping over rocks).</li>
                                                        <li>Incorporate yoga poses as part of the adventure.</li>
                                                    </ul>
                                                </ol>
                                                <li>Cool-Down & Relaxation (5 minutes)</li>
                                                <ol>
                                                    <li><b>Star Pose:</b> Lie down with arms and legs stretched wide, imagining being a shining star in the sky</li>
                                                    <li><b>Bubble Breathing:</b> Pretend to blow bubbles slowly while taking deep breaths in and out.</li>
                                                </ol>
                                                <li>Closing (1 minute)</li>
                                                <ul>
                                                    <li>End with a fun chant: "Yoga is fun, we’re strong, and we’re done!"</li>
                                                    <li>Thank the kids for their energy and smiles.</li>
                                                </ul>
                                            </ol>

                                        </div>
                                    </div>
                                    <div class="session-2">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2">
                                            <div class="card-title">Play Session - Revision</div>

                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold mt-3">1. Warm-Up (3 minutes)</h6>
                                            <ul>
                                                <li>Begin with a cheerful greeting and clapping.</li>
                                                <li>Ask the kids if they know the ABC song and let them hum it once together.</li>
                                            </ul>
                                            <h6 class="fw-bold mt-3">2.Main Activity (10 minutes)</h6>
                                            <ul>
                                                <li><b>First Round (3 minutes):</b> Sing the ABC song together slowly, pointing to large flashcards or a visual chart of the letters for visual reinforcement.</li>
                                                <li><b>Second Round (3 minutes):</b> Add actions or props:</li>
                                                <ul>
                                                    <li>Clap hands for vowels (A, E, I, O, U)</li>
                                                    <li>Stomp feet for consonants.</li>
                                                </ul>
                                                <li>Third Round (4 minutes):</li>
                                                <ul>
                                                    <li>Sing the ABC song at a faster pace for fun.</li>
                                                    <li>Split kids into two groups, where one group sings the first half (A-M) and the other sings the second half (N-Z).</li>
                                                </ul>
                                            </ul>
                                            <h6 class="fw-bold mt-3">3. Cool Down (2 minutes)</h6>
                                            <ul>
                                                <li>Ask kids their favorite letter and why.</li>
                                                <li>End with a cheerful goodbye song that includes the alphabet, like “Goodbye with ABCs.”</li>
                                            </ul>

                                            <h6 class="fw-bold mt-3">Materials Needed:</h6>
                                            <ul>
                                                <li>Alphabet flashcards or charts.</li>
                                                <li>Small props (like flags or sticks) for actions.</li>
                                            </ul>
                                            <h6 class="fw-bold mt-3">Outcome:</h6>
                                            <div>Kids will improve their alphabet familiarity while engaging in an energetic, rhythmic activity</div>
                                        </div>
                                    </div>
                                    <div class="session-3">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Q & A Session - Imagination and Creativity</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold mt-3">1. Can you pretend to be a superhero? What would your superpower be?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>

                                            <h6 class="fw-bold mt-3">2. Can you draw a picture of your favorite animal?</h6>
                                            <div><span class="fw-bold">Ans -</span>Demonstration</div>

                                            <h6 class="fw-bold mt-3">3. If you could be any character from a story, who would you be?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>
                                            <h6 class="fw-bold mt-3">4. Can you make up a short story about a dragon?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>

                                            <h6 class="fw-bold mt-3">5. What would you build if you had a lot of Lego bricks?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>
                                        </div>
                                    </div>
                                    <div class="session-4">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Skill Session - Intellectual Olympics</div>
                                        </div>
                                        <h6 class="fw-bold mt-3">Activity 5: Intellectual Olympics (Revision Day)
                                        </h6>
                                        <h6 class="fw-bold mt-3">Activity Goal:</h6>
                                        <div>Comprehensive revision of all pre-literacy skills activities in a fun and interactive way.
                                        </div>
                                        <h6 class="fw-bold mt-3">Materials Needed:</h6>
                                        <ol>
                                            <li>Stations for each activity.</li>
                                            <li>Necessary materials for each activity</li>
                                        </ol>

                                        <h6 class="fw-bold mt-3">Activity Guidelines:</h6>
                                        <ol>
                                            <li>Preparation (To Be Done Before the Week):</li>
                                            <div>-Set up different stations representing each of the previous activities.</div>
                                            <li>Instructions for Trainers:</li>
                                            <div>-Rotate the children through each station, revisiting ImagiTales Express, RhymeCraft Challenge, Sensory Letter Safari, and Yogaphabet Expedition.</div>
                                            <div>-Reinforce the skills learned during the week.</div>
                                            <div>-Foster a positive and enjoyable learning experience.</div>
                                        </ol>
                                        <div>Ensure that the activities are adapted based on the children's individual needs and interests. Encourage creativity, participation, and positive interactions throughout the week.</div>
                                    </div>
                                    <div class="session-5">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Food Session - Tale of the Coconut</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold">नारळाची गोष्ट (The Tale of the Coconut)</h6>
                                            <div><b>Summary:</b> नारळ कसा पिकतो, त्याचे पाणी, आणि खवलेला नारळ कसा खायचा याची गोष्ट.<b> Moral: </b>नारळाच्या विविध उपयोगांबद्दल माहिती.</div>
                                        </div>
                                    </div>
                                    <div class="session-6">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Good Bye Session - Ocean Life Puzzle</div>
                                        </div>
                                        <h6 class="fw-bold mt-3">Ocean Life Puzzle</h6>
                                        <ul>
                                            <li><b>Activity:</b>Puzzles featuring various ocean creatures (fish, octopus, starfish, etc.).</li>
                                            <li><b>Goal:</b>Kids complete the puzzles and identify each ocean creature.</li>
                                            <li><b>Instructions:</b>Enhance knowledge of marine life and improve fine motor skills.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="parent-card blue" data-value="level-4" style="display: none;">
                            <div class="card card-round">
                                <div class="card-body">
                                    <div class="session-1">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2">
                                            <div class="card-title">Welcome Session - Revision</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold">Welcome Session: Yoga for Kids (Up to 6 Years)</h6>

                                            <h6 class="fw-bold mt-3"><b>Duration:</b>30 minutes</h6>
                                            <h6 class="fw-bold mt-3"><b>Focus:</b> Flexibility, stamina, and enjoyment</h6>
                                            <h6 class="fw-bold mt-3"><b>Session Plan</b></h6>
                                            <ol>
                                                <li>Welcome & Warm-Up (5 minutes)</li>
                                                <ol>
                                                    <li>Greeting:</li>
                                                    <ul>
                                                        <li>Begin with a cheerful "Namaste" or "Hello Yoga Stars!"</li>
                                                        <li>Introduce the session theme: "Let’s stretch like animals, fly like birds, and grow stronger together!"</li>
                                                    </ul>
                                                    <li>Warm-Up Poses:</li>
                                                    <ul>
                                                        <li><b>Sun Stretch:</b> Stand tall, stretch arms up, and gently sway side to side like a tree.</li>
                                                        <li><b>Marching:</b> March in place while swinging arms.</li>
                                                    </ul>
                                                </ol>
                                                <li>Fun Yoga Poses (15 minutes)</li>
                                                <div>Incorporate playful yoga poses to keep children engaged.</div>
                                                <ol>
                                                    <li>Animal Poses:</li>
                                                    <ul>
                                                        <li><b>Cat-Cow Pose:</b> On hands and knees, alternate arching and rounding the back.</li>
                                                        <li><b>Frog Jump:</b> Squat like a frog and hop forward.</li>
                                                    </ul>
                                                    <li>Bird Poses:</li>
                                                    <ul>
                                                        <li><b>Butterfly Pose:</b> Sit with feet together, flapping knees like butterfly wings.</li>
                                                        <li><b>Flamingo Balance: </b>Stand on one leg and flap "wings."</li>
                                                    </ul>
                                                    <li>Stretching Poses:</li>
                                                    <ul>
                                                        <li><b>Cobra Pose:</b> Lie on the tummy, lift chest, and hiss like a snake.</li>
                                                        <li><b>Downward Dog: </b>Form an inverted "V" shape, pretending to bark like a puppy.</li>
                                                    </ul>
                                                </ol>
                                                <li>Stamina-Building Game (5 minutes)</li>
                                                <ol>
                                                    <li>Yoga Adventure:</li>
                                                    <ul>
                                                        <li>Create a story with movements (e.g., climbing mountains, swimming rivers, jumping over rocks).</li>
                                                        <li>Incorporate yoga poses as part of the adventure.</li>
                                                    </ul>
                                                </ol>
                                                <li>Cool-Down & Relaxation (5 minutes)</li>
                                                <ol>
                                                    <li><b>Star Pose:</b> Lie down with arms and legs stretched wide, imagining being a shining star in the sky</li>
                                                    <li><b>Bubble Breathing:</b> Pretend to blow bubbles slowly while taking deep breaths in and out.</li>
                                                </ol>
                                                <li>Closing (1 minute)</li>
                                                <ul>
                                                    <li>End with a fun chant: "Yoga is fun, we’re strong, and we’re done!"</li>
                                                    <li>Thank the kids for their energy and smiles.</li>
                                                </ul>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="session-2">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2">
                                            <div class="card-title">Play Session - Singing ABCs</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold mt-3">1. Warm-Up (3 minutes)</h6>
                                            <ul>
                                                <li>Begin with a cheerful greeting and clapping.</li>
                                                <li>Ask the kids if they know the ABC song and let them hum it once together.</li>
                                            </ul>
                                            <h6 class="fw-bold mt-3">2.Main Activity (10 minutes)</h6>
                                            <ul>
                                                <li><b>First Round (3 minutes):</b> Sing the ABC song together slowly, pointing to large flashcards or a visual chart of the letters for visual reinforcement.</li>
                                                <li><b>Second Round (3 minutes):</b> Add actions or props:</li>
                                                <ul>
                                                    <li>Clap hands for vowels (A, E, I, O, U)</li>
                                                    <li>Stomp feet for consonants.</li>
                                                </ul>
                                                <li>Third Round (4 minutes):</li>
                                                <ul>
                                                    <li>Sing the ABC song at a faster pace for fun.</li>
                                                    <li>Split kids into two groups, where one group sings the first half (A-M) and the other sings the second half (N-Z).</li>
                                                </ul>
                                            </ul>
                                            <h6 class="fw-bold mt-3">3. Cool Down (2 minutes)</h6>
                                            <ul>
                                                <li>Ask kids their favorite letter and why.</li>
                                                <li>End with a cheerful goodbye song that includes the alphabet, like “Goodbye with ABCs.”</li>
                                            </ul>

                                            <h6 class="fw-bold mt-3">Materials Needed:</h6>
                                            <ul>
                                                <li>Alphabet flashcards or charts.</li>
                                                <li>Small props (like flags or sticks) for actions.</li>
                                            </ul>
                                            <h6 class="fw-bold mt-3">Outcome:</h6>
                                            <div>Kids will improve their alphabet familiarity while engaging in an energetic, rhythmic activity</div>
                                        </div>
                                    </div>
                                    <div class="session-3">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Q & A Session - Imagination and Creativity</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold mt-3">1. Can you pretend to be a superhero? What would your superpower be?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>

                                            <h6 class="fw-bold mt-3">2. Can you draw a picture of your favorite animal?</h6>
                                            <div><span class="fw-bold">Ans -</span>Demonstration</div>

                                            <h6 class="fw-bold mt-3">3. If you could be any character from a story, who would you be?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>
                                            <h6 class="fw-bold mt-3">4. Can you make up a short story about a dragon?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>

                                            <h6 class="fw-bold mt-3">5. What would you build if you had a lot of Lego bricks?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>
                                        </div>
                                    </div>
                                    <div class="session-4">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Skill Session : Shape Review Extravaganza</div>
                                        </div>
                                        <h6 class="fw-bold mt-3">Day 5: Shape Review Extravaganza
                                        </h6>
                                        <h6 class="fw-bold mt-3">Activity Goal:</h6>
                                        <div>Review and reinforce the concepts learned throughout the week through a fun and interactive game.
                                        </div>
                                        <h6 class="fw-bold mt-3">Needed Materials:</h6>
                                        <div>-Shape puzzles or matching games</div>
                                        <div>-Completed shape sculptures from Day 4</div>
                                        <div>-Review quiz cards or questions</div>

                                        <h6 class="fw-bold mt-3">Activity Guidelines:
                                        </h6>
                                        <ol>
                                            <li><b>Review Game:</b>Play a game where children match shapes with their names or objects.</li>
                                            <li><b>Quiz:</b> Conduct a quick, fun quiz to recap the week’s learning.</li>
                                            <li><b>Showcase:</b> Let children show their shape sculptures and discuss what they learned.</li>
                                        </ol>
                                        <h6 class="fw-bold mt-3">Instructions for Trainers:</h6>
                                        <div>-Prepare shape puzzles or matching games.</div>
                                        <div>- Organize the review quiz and ensure it’s engaging.</div>
                                        <div>-Create a positive atmosphere to celebrate the children’s achievements.</div>
                                        <h6 class="fw-bold mt-3">Preparation Before a Week:</h6>
                                        <div>-Set up review materials and games.</div>
                                        <div>-Prepare quiz questions or cards.</div>
                                        <div>This manual should help teachers effectively guide children through a week of engaging activities designed to enhance their spatial awareness and intellectual development.</div>
                                    </div>
                                    <div class="session-5">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Food Session - Tale of the Coconut</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold">नारळाची गोष्ट (The Tale of the Coconut)</h6>
                                            <div><b>Summary:</b> नारळ कसा पिकतो, त्याचे पाणी, आणि खवलेला नारळ कसा खायचा याची गोष्ट.<b> Moral: </b>नारळाच्या विविध उपयोगांबद्दल माहिती.</div>

                                        </div>
                                    </div>
                                    <div class="session-6">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Good Bye Session - Ocean Life Puzzle</div>
                                        </div>
                                        <h6 class="fw-bold mt-3">Ocean Life Puzzle</h6>
                                        <ul>
                                            <li><b>Activity:</b>Puzzles featuring various ocean creatures (fish, octopus, starfish, etc.).</li>
                                            <li><b>Goal:</b>Kids complete the puzzles and identify each ocean creature.</li>
                                            <li><b>Instructions:</b>Enhance knowledge of marine life and improve fine motor skills.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="parent-card yellow" data-value="level-5" style="display: none;">
                            <div class="card card-round">
                                <div class="card-body">
                                    <div class="session-1">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2">
                                            <div class="card-title">Welcome Session - Revision</div>
                                        </div>

                                        <div class="card-list">
                                            <h6 class="fw-bold">Welcome Session: Yoga for Kids (Up to 6 Years)</h6>

                                            <h6 class="fw-bold mt-3"><b>Duration:</b>30 minutes</h6>
                                            <h6 class="fw-bold mt-3"><b>Focus:</b> Flexibility, stamina, and enjoyment</h6>
                                            <h6 class="fw-bold mt-3"><b>Session Plan</b></h6>
                                            <ol>
                                                <li>Welcome & Warm-Up (5 minutes)</li>
                                                <ol>
                                                    <li>Greeting:</li>
                                                    <ul>
                                                        <li>Begin with a cheerful "Namaste" or "Hello Yoga Stars!"</li>
                                                        <li>Introduce the session theme: "Let’s stretch like animals, fly like birds, and grow stronger together!"</li>
                                                    </ul>
                                                    <li>Warm-Up Poses:</li>
                                                    <ul>
                                                        <li><b>Sun Stretch:</b> Stand tall, stretch arms up, and gently sway side to side like a tree.</li>
                                                        <li><b>Marching:</b> March in place while swinging arms.</li>
                                                    </ul>
                                                </ol>
                                                <li>Fun Yoga Poses (15 minutes)</li>
                                                <div>Incorporate playful yoga poses to keep children engaged.</div>
                                                <ol>
                                                    <li>Animal Poses:</li>
                                                    <ul>
                                                        <li><b>Cat-Cow Pose:</b> On hands and knees, alternate arching and rounding the back.</li>
                                                        <li><b>Frog Jump:</b> Squat like a frog and hop forward.</li>
                                                    </ul>
                                                    <li>Bird Poses:</li>
                                                    <ul>
                                                        <li><b>Butterfly Pose:</b> Sit with feet together, flapping knees like butterfly wings.</li>
                                                        <li><b>Flamingo Balance: </b>Stand on one leg and flap "wings."</li>
                                                    </ul>
                                                    <li>Stretching Poses:</li>
                                                    <ul>
                                                        <li><b>Cobra Pose:</b> Lie on the tummy, lift chest, and hiss like a snake.</li>
                                                        <li><b>Downward Dog: </b>Form an inverted "V" shape, pretending to bark like a puppy.</li>
                                                    </ul>
                                                </ol>
                                                <li>Stamina-Building Game (5 minutes)</li>
                                                <ol>
                                                    <li>Yoga Adventure:</li>
                                                    <ul>
                                                        <li>Create a story with movements (e.g., climbing mountains, swimming rivers, jumping over rocks).</li>
                                                        <li>Incorporate yoga poses as part of the adventure.</li>
                                                    </ul>
                                                </ol>
                                                <li>Cool-Down & Relaxation (5 minutes)</li>
                                                <ol>
                                                    <li><b>Star Pose:</b> Lie down with arms and legs stretched wide, imagining being a shining star in the sky</li>
                                                    <li><b>Bubble Breathing:</b> Pretend to blow bubbles slowly while taking deep breaths in and out.</li>
                                                </ol>
                                                <li>Closing (1 minute)</li>
                                                <ul>
                                                    <li>End with a fun chant: "Yoga is fun, we’re strong, and we’re done!"</li>
                                                    <li>Thank the kids for their energy and smiles.</li>
                                                </ul>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="session-2">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2">
                                            <div class="card-title">Play Session - Singing ABCs
                                            </div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold mt-3">1. Warm-Up (3 minutes)</h6>
                                            <ul>
                                                <li>Begin with a cheerful greeting and clapping.</li>
                                                <li>Ask the kids if they know the ABC song and let them hum it once together.</li>
                                            </ul>
                                            <h6 class="fw-bold mt-3">2.Main Activity (10 minutes)</h6>
                                            <ul>
                                                <li><b>First Round (3 minutes):</b> Sing the ABC song together slowly, pointing to large flashcards or a visual chart of the letters for visual reinforcement.</li>
                                                <li><b>Second Round (3 minutes):</b> Add actions or props:</li>
                                                <ul>
                                                    <li>Clap hands for vowels (A, E, I, O, U)</li>
                                                    <li>Stomp feet for consonants.</li>
                                                </ul>
                                                <li>Third Round (4 minutes):</li>
                                                <ul>
                                                    <li>Sing the ABC song at a faster pace for fun.</li>
                                                    <li>Split kids into two groups, where one group sings the first half (A-M) and the other sings the second half (N-Z).</li>
                                                </ul>
                                            </ul>
                                            <h6 class="fw-bold mt-3">3. Cool Down (2 minutes)</h6>
                                            <ul>
                                                <li>Ask kids their favorite letter and why.</li>
                                                <li>End with a cheerful goodbye song that includes the alphabet, like “Goodbye with ABCs.”</li>
                                            </ul>

                                            <h6 class="fw-bold mt-3">Materials Needed:</h6>
                                            <ul>
                                                <li>Alphabet flashcards or charts.</li>
                                                <li>Small props (like flags or sticks) for actions.</li>
                                            </ul>
                                            <h6 class="fw-bold mt-3">Outcome:</h6>
                                            <div>Kids will improve their alphabet familiarity while engaging in an energetic, rhythmic activity</div>
                                        </div>
                                    </div>
                                    <div class="session-3">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Q & A Session - Imagination and Creativity</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold mt-3">1. Can you pretend to be a superhero? What would your superpower be?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>
                                            <h6 class="fw-bold mt-3">2. Can you draw a picture of your favorite animal?</h6>
                                            <div><span class="fw-bold">Ans -</span>Demonstration</div>
                                            <h6 class="fw-bold mt-3">3. If you could be any character from a story, who would you be?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>
                                            <h6 class="fw-bold mt-3">4. Can you make up a short story about a dragon?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>
                                            <h6 class="fw-bold mt-3">5. What would you build if you had a lot of Lego bricks?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>
                                        </div>
                                    </div>
                                    <div class="session-4">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Skill Session - Revision Rendezvous</div>
                                        </div>
                                        <h6 class="fw-bold mt-3">Day 5: Revision Rendezvous (Manners Masterclass Review)</h6>

                                        <div><strong>Activity Goal -</strong>Review and reinforce the concepts of good manners through a series of fun and interactive mini-games.
                                        </div>
                                        <h6 class="fw-bold mt-3">Needed Materials:</h6>
                                        <div>-Stopwatch or timer</div>
                                        <div>-Small prizes or stickers for participation</div>
                                        <div>-Game props (optional)</div>
                                        <h6 class="fw-bold mt-3">Activity Guidelines:</h6>
                                        <ol>
                                            <li>Organize mini-games focusing on different manners concepts (Please and Thank You race, table-setting challenge, etc.).</li>
                                            <li>Allow children to participate and showcase their manners prowess.</li>
                                            <li>Conclude with a brief recap of the week's activities and their importance.</li>
                                        </ol>
                                        <h6 class="fw-bold mt-3">Instructions for Trainers:</h6>
                                        <div>-Plan and set up the mini-games in advance.</div>
                                        <div>-Have a system for awarding small prizes or stickers for participation</div>
                                        <div>- Optional: Gather props or costumes for added fun during role-playing.</div>
                                        <h6 class="fw-bold mt-3">Conclusion:</h6>
                                        <div>This activity manual serves as a guide for teachers to effectively implement a week-long program focused on understanding and practicing good manners with 4 to 5-year-old children. The goal is to create a positive and engaging learning environment that instills essential social skills in young learners.</div>
                                    </div>
                                    <div class="session-5">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Food Session - Tale of the Coconut</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold">नारळाची गोष्ट (The Tale of the Coconut)</h6>
                                            <div><b>Summary:</b> नारळ कसा पिकतो, त्याचे पाणी, आणि खवलेला नारळ कसा खायचा याची गोष्ट.<b> Moral: </b>नारळाच्या विविध उपयोगांबद्दल माहिती.</div>
                                        </div>
                                    </div>
                                    <div class="session-6">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Good Bye Session - Ocean Life Puzzle</div>
                                        </div>
                                        <h6 class="fw-bold mt-3">Ocean Life Puzzle</h6>
                                        <ul>
                                            <li><b>Activity:</b>Puzzles featuring various ocean creatures (fish, octopus, starfish, etc.).</li>
                                            <li><b>Goal:</b>Kids complete the puzzles and identify each ocean creature.</li>
                                            <li><b>Instructions:</b>Enhance knowledge of marine life and improve fine motor skills.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="parent-card yellow" data-value="level-6" style="display: none;">
                            <div class="card card-round">
                                <div class="card-body">
                                    <div class="session-1">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2">
                                            <div class="card-title">Welcome Session - Revision</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold">Welcome Session: Yoga for Kids (Up to 6 Years)</h6>

                                            <h6 class="fw-bold mt-3"><b>Duration:</b>30 minutes</h6>
                                            <h6 class="fw-bold mt-3"><b>Focus:</b> Flexibility, stamina, and enjoyment</h6>
                                            <h6 class="fw-bold mt-3"><b>Session Plan</b></h6>
                                            <ol>
                                                <li>Welcome & Warm-Up (5 minutes)</li>
                                                <ol>
                                                    <li>Greeting:</li>
                                                    <ul>
                                                        <li>Begin with a cheerful "Namaste" or "Hello Yoga Stars!"</li>
                                                        <li>Introduce the session theme: "Let’s stretch like animals, fly like birds, and grow stronger together!"</li>
                                                    </ul>
                                                    <li>Warm-Up Poses:</li>
                                                    <ul>
                                                        <li><b>Sun Stretch:</b> Stand tall, stretch arms up, and gently sway side to side like a tree.</li>
                                                        <li><b>Marching:</b> March in place while swinging arms.</li>
                                                    </ul>
                                                </ol>
                                                <li>Fun Yoga Poses (15 minutes)</li>
                                                <div>Incorporate playful yoga poses to keep children engaged.</div>
                                                <ol>
                                                    <li>Animal Poses:</li>
                                                    <ul>
                                                        <li><b>Cat-Cow Pose:</b> On hands and knees, alternate arching and rounding the back.</li>
                                                        <li><b>Frog Jump:</b> Squat like a frog and hop forward.</li>
                                                    </ul>
                                                    <li>Bird Poses:</li>
                                                    <ul>
                                                        <li><b>Butterfly Pose:</b> Sit with feet together, flapping knees like butterfly wings.</li>
                                                        <li><b>Flamingo Balance: </b>Stand on one leg and flap "wings."</li>
                                                    </ul>
                                                    <li>Stretching Poses:</li>
                                                    <ul>
                                                        <li><b>Cobra Pose:</b> Lie on the tummy, lift chest, and hiss like a snake.</li>
                                                        <li><b>Downward Dog: </b>Form an inverted "V" shape, pretending to bark like a puppy.</li>
                                                    </ul>
                                                </ol>
                                                <li>Stamina-Building Game (5 minutes)</li>
                                                <ol>
                                                    <li>Yoga Adventure:</li>
                                                    <ul>
                                                        <li>Create a story with movements (e.g., climbing mountains, swimming rivers, jumping over rocks).</li>
                                                        <li>Incorporate yoga poses as part of the adventure.</li>
                                                    </ul>
                                                </ol>
                                                <li>Cool-Down & Relaxation (5 minutes)</li>
                                                <ol>
                                                    <li><b>Star Pose:</b> Lie down with arms and legs stretched wide, imagining being a shining star in the sky</li>
                                                    <li><b>Bubble Breathing:</b> Pretend to blow bubbles slowly while taking deep breaths in and out.</li>
                                                </ol>
                                                <li>Closing (1 minute)</li>
                                                <ul>
                                                    <li>End with a fun chant: "Yoga is fun, we’re strong, and we’re done!"</li>
                                                    <li>Thank the kids for their energy and smiles.</li>
                                                </ul>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="session-2">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2">
                                            <div class="card-title">Play Session - Singing ABCs</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold mt-3">1. Warm-Up (3 minutes)</h6>
                                            <ul>
                                                <li>Begin with a cheerful greeting and clapping.</li>
                                                <li>Ask the kids if they know the ABC song and let them hum it once together.</li>
                                            </ul>
                                            <h6 class="fw-bold mt-3">2.Main Activity (10 minutes)</h6>
                                            <ul>
                                                <li><b>First Round (3 minutes):</b> Sing the ABC song together slowly, pointing to large flashcards or a visual chart of the letters for visual reinforcement.</li>
                                                <li><b>Second Round (3 minutes):</b> Add actions or props:</li>
                                                <ul>
                                                    <li>Clap hands for vowels (A, E, I, O, U)</li>
                                                    <li>Stomp feet for consonants.</li>
                                                </ul>
                                                <li>Third Round (4 minutes):</li>
                                                <ul>
                                                    <li>Sing the ABC song at a faster pace for fun.</li>
                                                    <li>Split kids into two groups, where one group sings the first half (A-M) and the other sings the second half (N-Z).</li>
                                                </ul>
                                            </ul>
                                            <h6 class="fw-bold mt-3">3. Cool Down (2 minutes)</h6>
                                            <ul>
                                                <li>Ask kids their favorite letter and why.</li>
                                                <li>End with a cheerful goodbye song that includes the alphabet, like “Goodbye with ABCs.”</li>
                                            </ul>

                                            <h6 class="fw-bold mt-3">Materials Needed:</h6>
                                            <ul>
                                                <li>Alphabet flashcards or charts.</li>
                                                <li>Small props (like flags or sticks) for actions.</li>
                                            </ul>
                                            <h6 class="fw-bold mt-3">Outcome:</h6>
                                            <div>Kids will improve their alphabet familiarity while engaging in an energetic, rhythmic activity</div>
                                        </div>
                                    </div>
                                    <div class="session-3">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Q & A Session - Imagination and Creativity</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold mt-3">1. Can you pretend to be a superhero? What would your superpower be?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>

                                            <h6 class="fw-bold mt-3">2. Can you draw a picture of your favorite animal?</h6>
                                            <div><span class="fw-bold">Ans -</span>Demonstration</div>

                                            <h6 class="fw-bold mt-3">3. If you could be any character from a story, who would you be?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>
                                            <h6 class="fw-bold mt-3">4. Can you make up a short story about a dragon?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>

                                            <h6 class="fw-bold mt-3">5. What would you build if you had a lot of Lego bricks?</h6>
                                            <div><span class="fw-bold">Ans -</span>Answers will vary</div>
                                        </div>
                                    </div>
                                    <div class="session-4">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Skill Session - Feelings Fiesta</div>
                                        </div>
                                        <h6 class="fw-bold mt-3">Day 5: "Feelings Fiesta" (Revision and Review)</h6>
                                        <h6 class="fw-bold mt-3">Activity Goal:</h6>
                                        <div class="border-solid">Review all concepts learned throughout the week and reinforce emotional awareness.</div>
                                        <h6 class="fw-bold mt-3">Materials Needed:</h6>
                                        <ul>
                                            <li>Emotion cards or flashcards.</li>
                                            <li>Children’s “Mood Maps” and “Emotion Potions” from previous days.</li>
                                            <li>Space for dancing.</li>
                                        </ul>
                                        <h6 class="fw-bold mt-3">Activity Guidelines:</h6>
                                        <ul>
                                            <li>Begin with a group discussion where children share what they learned about emotions during the week.</li>
                                            <li>Use the emotion cards to play a “Guess the Emotion” game.</li>
                                            <li>Review the “Mood Maps” and “Emotion Potions” created in earlier activities.</li>
                                            <li>End with an “Emotion Dance Party” where kids dance to music representing different emotions (e.g., slow music for calm, fast beats for excitement).</li>
                                        </ul>
                                        <h6 class="fw-bold mt-3">Instructions for Trainers:</h6>
                                        <ol>
                                            <li>Preparation (Before Activity):</li>
                                            <ul>
                                                <li>Gather all the materials (emotion cards, children’s creations).</li>
                                                <li>Set up a space where kids can move freely and safely.</li>
                                            </ul>
                                            <li>During the Activity:</li>
                                            <ul>
                                                <li>Begin with a recap of the week’s activities, asking children to share their favorite part.</li>
                                                <li>Play the “Guess the Emotion” game, encouraging children to describe how the emotions feel in their bodies.</li>
                                                <li>Finish with the “Emotion Dance Party,” letting kids dance out their emotions.</li>
                                            </ul>
                                            <li>Wrap-Up:</li>
                                            <ul>
                                                <li>Celebrate the children’s learning, highlighting how they’ve become more aware of their emotions and how to express them in healthy ways.</li>
                                            </ul>
                                        </ol>
                                        <h6 class="fw-bold mt-3">Preparation Before the Week:</h6>
                                        <ol>
                                            <li>Gather materials listed for each day.</li>
                                            <li>Print out worksheets for Day 3.</li>
                                            <li>Prepare jars and coloring supplies for Day 4.</li>
                                        </ol>

                                    </div>
                                    <div class="session-5">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Food Session - Tale of the Coconut</div>
                                        </div>
                                        <div class="card-list">
                                            <h6 class="fw-bold">नारळाची गोष्ट (The Tale of the Coconut)</h6>
                                            <div><b>Summary:</b> नारळ कसा पिकतो, त्याचे पाणी, आणि खवलेला नारळ कसा खायचा याची गोष्ट.<b> Moral: </b>नारळाच्या विविध उपयोगांबद्दल माहिती.</div>

                                        </div>
                                    </div>
                                    <div class="session-6">
                                        <div class="card-head-row card-tools-still-right border-solid pb-2 mt-3">
                                            <div class="card-title">Good Bye Session - Ocean Life Puzzle</div>
                                        </div>
                                        <h6 class="fw-bold mt-3">Ocean Life Puzzle</h6>
                                        <ul>
                                            <li><b>Activity:</b>Puzzles featuring various ocean creatures (fish, octopus, starfish, etc.).</li>
                                            <li><b>Goal:</b>Kids complete the puzzles and identify each ocean creature.</li>
                                            <li><b>Instructions:</b>Enhance knowledge of marine life and improve fine motor skills.</li>
                                        </ul>
                                    </div>
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

</body>

</html>