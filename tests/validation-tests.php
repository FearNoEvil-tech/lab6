<?php
require_once dirname(__DIR__).'/includes/validation.php';

//test validatePreferredTime
$tests = [
    ['name' => 'Valid time', 'input' => 'Morning', 'expected' => ''],
    ['name' => 'Missing time', 'input' => '', 'expected' => 'Choose a valid preferred time.'],
    ['name' => 'Altered value', 'input' => 'Midnight', 'expected' => 'Choose a valid preferred time.'],
];
foreach ($tests as $test) {
    $actual = validatePreferredTime($test['input']);
    $passed = $actual === $test['expected'];
    echo '<p>' . htmlspecialchars($test['name'], ENT_QUOTES, 'UTF-8') . ': ';
    echo $passed ? 'PASS' : 'FAIL';
    echo '</p>';
}

//test validateTopics
$topicTests = [
    [
        'name' => 'Multiple valid topics',
        'input' => ['Exam review', 'Study plan'],
        'expected' => ''
    ],
    [
        'name' => 'Missing topics',
        'input' => [],
        'expected' => 'Select at least one valid topic.'
    ],
    [
        'name' => 'Altered topic',
        'input' => ['Free tutoring'],
        'expected' => 'Select at least one valid topic.'
    ]
];

foreach ($topicTests as $test) {
    $actual = validateTopics($test['input']);
    $passed = $actual === $test['expected'];

    echo '<p>' . htmlspecialchars($test['name'], ENT_QUOTES, 'UTF-8') . ': ';
    echo $passed ? 'PASS' : 'FAIL';
    echo '</p>';
}

//test validateReason
$reasonTests = [
    [
        'name' => 'Minimum length',
        'input' => '1234567890',
        'expected' => ''
    ],
    [
        'name' => 'Maximum length',
        'input' => str_repeat('a', 500),
        'expected' => ''
    ],
    [
        'name' => 'Too short',
        'input' => '123456789',
        'expected' => 'Describe your request using 10 to 500 characters.'
    ],
    [
        'name' => 'Too long',
        'input' => str_repeat('a', 501),
        'expected' => 'Describe your request using 10 to 500 characters.'
    ]
];

foreach ($reasonTests as $test) {
    $actual = validateReason($test['input']);
    $passed = $actual === $test['expected'];

    echo '<p>' . htmlspecialchars($test['name'], ENT_QUOTES, 'UTF-8') . ': ';
    echo $passed ? 'PASS' : 'FAIL';
    echo '</p>';
}
