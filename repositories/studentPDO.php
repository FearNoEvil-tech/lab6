<?php
function findStudentByEmail($pdo, $email) {
    $stmt = $pdo->prepare('SELECT student_id, student_name, student_email FROM students WHERE student_email = ?');
    $stmt->execute([$email]); return $stmt->fetch();
}
function insertStudentIfAbsent($pdo, $name, $email) {
    $stmt = $pdo->prepare('INSERT OR IGNORE INTO students(student_name,student_email) VALUES(?,?)');
    $stmt->execute([$name,$email]);
}
