<?php
require('includes/validation-functions.php');
require('includes/process-form.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Evil Corp.&trade; Henchmen Application</title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <!-- Custom JS for Range Slider -->
    <script src="js/main.js" defer></script>
</head>

<body class="bg-black container px-3 py-5">
    <main class="row justify-content-center align-items-center min-vh-100">
        <section class="col-md-10 col-lg-9 col-xl-8 col-xxl-7 p-5 rounded border border-secondary bg-dark text-light">
            <h1 class="fw-light text-center">Evil Corp.&trade; Henchmen Application</h1>
            <p class="lead text-center">Welcome to Evil Corp.&trade;, where dastardly dreams meet career opportunities!</p>
            <p class="mb-5">We understand that being a henchperson is more than just a job - it's a calling. Whether you're a master of mischief, a pro at pushing big red buttons, or someone who just wants to look cool guarding a secret lair, we want you on our team.</p>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <section class="my-5">
                    <h2 class="fw-light">Account Creation</h2>

                    <!-- Text Input (Full Name) -->
                    <div class="mb-4">
                        <!-- If there's an error message, we'll display it right by the input the user needs to fix. -->
                        <?php if ($message_name != "") echo $message_name; ?>
                        <label for="name" class="form-label">Full Name:</label>
                        <input type="text" id="name" name="name" placeholder="Robin Banks" class="form-control" value="<?= $name; ?>">
                        <p class="form-text text-light">Enter your full name as it appears on your evil henchperson license or birth certificate. Pseudonyms (e.g., "The Crusher", "Brutal Brutus", or "Dave") can be added later.</p>
                    </div>

                    <!-- Email Input -->
                    <div class="mb-4">
                        <?php if ($message_email != "") echo $message_email; ?>
                        <label for="email" class="form-label">Email Address:</label>
                        <input type="text" id="email" name="email" placeholder="example@evilcorp.com" class="form-control" value="<?= $email; ?>">
                        <p class="form-text text-light">Enter a valid email address that you check frequently - evil plans wait for no one.</p>
                    </div>

                    <!-- Phone Input -->
                    <div class="mb-4">
                        <?php if ($message_phone != "") echo $message_phone; ?>
                        <label for="phone" class="form-label">Phone Number:</label>
                        <input type="text" id="phone" name="phone" placeholder="123 456 7890" class="form-control" value="<?= $phone; ?>">
                        <p class="form-text text-light">Provide a valid number where we can reach you. Carrier pigeons are no longer accepted after the law suit.</p>
                    </div>

                    <!-- Date Input -->
                    <div class="mb-4">
                        <?php if ($message_dob != "") echo $message_dob; ?>
                        <label for="dob" class="form-label">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" class="form-control" value="<?= $dob; ?>">
                        <p class="form-text text-light">Enter your date of birth. This helps us confirm you're old enough for hazardous henching.</p>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-4">
                        <?php if ($message_password != "") echo $message_password; ?>
                        <label for="password" class="form-label">Secret Password:</label>
                        <input type="text" id="password" name="password" class="form-control" value="<?= $password; ?>">
                        <p class="form-text text-light">Choose a strong password, with:</p>
                        <ul class="form-text text-light">
                            <li>a minimum of 8 characters</li>
                            <li>at least one lowercase letter</li>
                            <li>at least one uppercase letter</li>
                            <li>at least one number</li>
                            <li>at least one special character: !@#$%^&*</li>
                        </ul>
                        <p class="form-text text-light">Avoid using easy-to-guess passwords, like "password123" or "evil4life".</p>
                    </div>

                    <!-- Password Check -->
                    <div class="mb-4">
                        <?php if ($message_password_check != "") echo $message_password_check; ?>
                        <label for="password_check" class="form-label">Secret Password (Again):</label>
                        <input type="text" id="password_check" name="password_check" class="form-control" value="<?= $password_check; ?>">
                        <p class="form-text text-light">Re-enter your password to confirm. Even the most diabolical minds make typos sometimes.</p>
                    </div>
                </section>

                <section class="my-5">
                    <h2 class="fw-light">Qualifications</h2>

                    <!-- Number Input (Years Experience) -->
                    <div class="mb-4">
                        <?php if ($message_experience != "") echo $message_experience; ?>
                        <label for="experience" class="form-label">Years of Evil Experience:</label>
                        <input type="number" id="experience" name="experience" class="form-control" value="<?= $experience; ?>">
                        <p class="form-text text-light">Round to the nearest whole number between 0-60.</p>
                    </div>

                    <!-- 
                        Datalist 
                        
                        A <datalist> is a great form control when we want to provide suggestions for the user without limiting their input. It behaves like a combination of a text field and a dropdown menu: users can either choose from a list of suggested values or type in something completely custom.

                        Because users can submit anything (not just values from the list) we should still validate their input the same way we would for a regular <input type="text"> field.
                    -->
                    <div class="mb-4">
                        <?php if ($message_region != "") echo $message_region; ?>
                        <label for="region" class="form-label">Preferred Global Region for Assignments:</label>
                        <input type="text" id="region" name="region" class="form-control" value="<?= $region; ?>" list="region-options">

                        <datalist id="region-options">
                            <option value="Subterranean Bunkers (Europe)"></option>
                            <option value="Volcano Islands (Pacific)"></option>
                            <option value="Abandoned Arctic Labs"></option>
                            <option value="Urban Roofscapes (Night Only)"></option>
                            <option value="Anywhere With Excellent Wi-Fi"></option>
                        </datalist>

                        <p class="form-text text-light">Choose from our suggested evil deployment zones - or enter your own. We respect evil flexibility.</p>
                    </div>

                    <!-- Radio Buttons (which Department) -->
                    <fieldset class="mb-4">
                        <legend class="fs-5">Which department are you applying for?</legend>

                        <?php if ($message_department != "") echo $message_department; ?>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="traps" value="traps" name="department" <?php if (isset($department) && $department == "traps") echo "checked"; ?>>
                            <label for="traps" class="form-check-label">Trap-Setting</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="doomsday" value="doomsday" name="department" <?php if (isset($department) && $department == "doomsday") echo "checked"; ?>>
                            <label for="doomsday" class="form-check-label">Doomsday Device Maintenance</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="monologue" value="monologue" name="department" <?php if (isset($department) && $department == "monologue") echo "checked"; ?>>
                            <label for="monologue" class="form-check-label">Hero Monologue Intrustion</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="it" value="it" name="department" <?php if (isset($department) && $department == "it") echo "checked"; ?>>
                            <label for="it" class="form-check-label">IT Help Desk</label>
                        </div>
                    </fieldset>

                    <!-- Checkboxes (Occupation Hazard Training) -->
                     <fieldset class="mb-4">
                        <legend class="fs-5">Occupational Hazard Training (Optional)</legend>
                        <p>Which of the following occupational hazard training courses have you completed?</p>

                        <div class="form-check">
                            <input type="checkbox" id="lava" name="training[]" value="lava" class="form-check-input"
                                <?php if (!empty($training) && in_array("lava", $training)) echo "checked"; ?>>
                            <label for="lava" class="form-check-label">Open Lava Pits and You</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="sharks" name="training[]" value="sharks" class="form-check-input"
                                <?php if (!empty($training) && in_array("sharks", $training)) echo "checked"; ?>>
                            <label for="sharks" class="form-check-label">Shark Tank Etiquette</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="lifting" name="training[]" value="lifting" class="form-check-input"
                                <?php if (!empty($training) && in_array("lifting", $training)) echo "checked"; ?>>
                            <label for="lifting" class="form-check-label">Advanced Hench-Lifting Techniques</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="buttons" name="training[]" value="buttons" class="form-check-input"
                                <?php if (!empty($training) && in_array("buttons", $training)) echo "checked"; ?>>
                            <label for="buttons" class="form-check-label">The Art of Not Touching Big Red Buttons</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="hostages" name="training[]" value="hostages" class="form-check-input"
                                <?php if (!empty($training) && in_array("hostages", $training)) echo "checked"; ?>>
                            <label for="hostages" class="form-check-label">Hostage Handling: Do's and Don'ts</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="evacuation" name="training[]" value="evacuation" class="form-check-input"
                                <?php if (!empty($training) && in_array("evacuation", $training)) echo "checked"; ?>>
                            <label for="evacuation" class="form-check-label">Collapsing Lair Evacuation Plans</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="retention" name="training[]" value="retention" class="form-check-input"
                                <?php if (!empty($training) && in_array("retention", $training)) echo "checked"; ?>>
                            <label for="retention" class="form-check-label">Employee Retention: Surviving the Villain's Wrath</label>
                        </div>
                    </fieldset>

                    <!-- Range Slider (Likert Scale) -->

                    <fieldset class="mb-4">
                        <legend class="fs-5">Loyalty to Evil Overlord</legend>

                        <?php if ($message_loyalty != "") echo $message_loyalty; ?>

                        <label for="loyalty" class="form-label">On a scale of 0 through 10, how loyal would you say you are to the current Evil Overlord?</label>
                        <input type="range" id="loyalty" name="loyalty" step="1" min="0" max="10" class="form-range" value="<?php if ($loyalty != "") echo $loyalty; ?>" aria-describedby="loyalty-value">

                        <!-- This will let the user know what number they are choosing. It will be dynamically updated by JavaScript or on page load by PHP. -->
                        <p id="loyalty-value" class="form-text text-center text-light">
                            <span><?php echo isset($_POST['loyalty']) ? $_POST['loyalty'] : 5; ?></span>
                        </p>
                    </fieldset>

                    <!-- Select/Option (Dropdown) -->
                     <div class="mb-4">
                        
                     <?php if ($message_referral != "") echo $message_referral; ?>

                        <label for="referral" class="form-label">How did you hear about us?</label>
                        <select name="referral" id="referral" class="form-select">
                            <option value="" <?php if ($referral == "") echo "selected"; ?> >-- Please Select --</option>
                            <option value="classified-ad" <?php if ($referral == "classified-ad") echo "selected"; ?> >Craigslist (Evil Jobs Section)</option>
                            <option value="social-media" <?php if ($referral == "social-media") echo "selected"; ?> >Lava Pit Showcase on TikTok</option>
                            <option value="word-of-mouth" <?php if ($referral == "word-of-mouth") echo "selected"; ?> >Referral from Another Henchperson</option>
                            <option value="mixer" <?php if ($referral == "mixer") echo "selected"; ?> >Villain Networking Mixer</option>
                            <option value="kidnapping" <?php if ($referral == "kidnapping") echo "selected"; ?> >Kidnapped by Your Recruitment Team</option>
                            <option value="family" <?php if ($referral == "family") echo "selected"; ?> >Family Tradition</option>
                            <option value="announcement" <?php if ($referral == "announcement") echo "selected"; ?> >Villain's Death Ray Announcement</option>
                        </select>
                     </div>

                </section>

                <section class="my-5">
                    <h2 class="fw-light">Long Answer Question</h2>
                    <p>At Evil Corp.&trade;, we're not just evil doers - we're evil dreamers, too.</p>

                    <!-- Textarea -->
                    <div class="mb-4">
                        <?php if ($message_evil_plan != "") echo $message_evil_plan; ?>

                        <label for="evil-plan" class="form-label">In 255 characters or fewer, describe your most diabolical plan to date:</label>
                        <textarea name="evil-plan" id="evil-plan" rows="5" cols="30" placeholder="e.g., sharks with frickin' laser beams attached to their heads ..." class="form-control"><?php if ($evil_plan != "") echo $evil_plan; ?></textarea>
                    </div>
                </section>

                <!-- Submit -->
                <div class="my-4">
                    <input type="submit" id="submit" name="submit" value="Create Account & Apply" class="btn btn-warning">
                </div>

                <!-- Disclaimer -->
                <p class="form-text text-light">Evil Corp.&trade; prides itself on being an equal opportunity employer. All goons, mooks, minions, lackeys, grunts, and flunkies are encouraged to apply. Remember: just because we're evil doesn't mean we can't be equal.</p>
            </form>
        </section>
    </main>
</body>

</html>