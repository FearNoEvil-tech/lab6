# Week 7 Peer Tutoring Hub (Lab 4 & 5 continuation)

Keep the Lab 4 HTML, CSS, includes, checkbox topics, radio time choices and existing validation tests. Add student name/email and persistent SQLite storage. The approved Week 6 database has only one `topic` column. This teaching version stores a JSON string in that TEXT column with `reason` and `topics` so both Lab 4 values survive without changing the ERD.

## Preferred-time values

The request form stores the Lab 4 radio-button choices: `Morning`, `Afternoon`, or `Evening`, not a clock time. The starter database includes one earlier sample record with `14:00`; it is only seed data. Requests submitted through the application use the three time-of-day choices above.

This version uses PHP 7.0-compatible syntax. It requires the PDO SQLite and mbstring extensions.

## Run in GitHub Codespaces

1. From this folder: `mkdir -p database && sqlite3 database/tutoring.db < database/setup-database.sql`
2. Run `php -S 0.0.0.0:8000` and open forwarded port 8000.
3. Visit `/` or `/index.php`; it opens the request form at `/php/request-form.php`. Use `/php/requests.php` to filter, view, edit, or cancel requests.
4. Run `php tests/integration-tests.php` in a separate terminal.
5. The Lab 4 validation checks remain in `tests/validation-tests.php`. Run them through the classroom server if desired.

**Classroom only:** no login, per-request authorization, or CSRF tokens yet. Do not deploy publicly. Router blocks direct access to internal folders only when launched as shown; a production server must have a dedicated public document root and full access controls. No real student personal information should be used in this demo.