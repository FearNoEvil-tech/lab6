<?php
require_once __DIR__.'/../includes/header.php';
require_once __DIR__.'/../includes/nav.php';
?>

<main>
    <h1>Request a tutoring session</h1>

    <form class="tutoring-request-form" action="process-request.php" method="post">
        <input type="hidden" name="form_name" value="tutoring_request">

        <div class="form-field"><label for="student_name">Student name</label><input id="student_name" name="student_name" required maxlength="120"></div>
        <div class="form-field"><label for="student_email">Student email</label><input id="student_email" name="student_email" type="email" required maxlength="254"></div>
        <div class="form-field">
            <label for="course">Course</label>

            <select id="course" name="course" required>
                <option value="">Choose a course</option>
                <option value="IS 6465">IS 6465</option>
                <option value="IS 6495">IS 6495</option>
                <option value="IS 6570">IS 6570</option>
            </select>
        </div>

        <div class="form-field">
            <label for="preferreddate">Preferred date</label>
            <input id="preferreddate" name="preferreddate" type="date" required>
        </div>

        <div class="form-field form-field-full">
            <label for="reason">What would you like help with?</label>
            <textarea id="reason" name="reason" rows="4" maxlength="500" required></textarea>
        </div>

        <fieldset>
            <legend>Topics</legend>

            <label class="choice">
                <input type="checkbox" name="topics[]" value="Exam review">
                <span>Exam review</span>
            </label>

            <label class="choice">
                <input type="checkbox" name="topics[]" value="Practice problems">
                <span>Practice problems</span>
            </label>

            <label class="choice">
                <input type="checkbox" name="topics[]" value="Study plan">
                <span>Study plan</span>
            </label>
        </fieldset>

        <fieldset>
            <legend>Preferred time</legend>

            <label class="choice">
                <input type="radio" name="preferredtime" value="Morning" required>
                <span>Morning</span>
            </label>

            <label class="choice">
                <input type="radio" name="preferredtime" value="Afternoon">
                <span>Afternoon</span>
            </label>

            <label class="choice">
                <input type="radio" name="preferredtime" value="Evening">
                <span>Evening</span>
            </label>
        </fieldset>

        <button type="submit">Request session</button>
    </form>
</main>

<?php require_once __DIR__.'/../includes/footer.php'; ?>
