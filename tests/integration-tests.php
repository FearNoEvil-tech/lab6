<?php
require_once dirname(__DIR__).'/services/requestService.php';
$pdo=new PDO('sqlite::memory:');$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);$pdo->exec('PRAGMA foreign_keys=ON');
$pdo->exec(file_get_contents(dirname(__DIR__).'/database/setup-database.sql'));
$failed=0;function check($ok, $label){global $failed;echo ($ok?'PASS ':'FAIL ').$label.PHP_EOL;if(!$ok)$failed++;}
$sample=['student_name'=>'Jordan Lee','student_email'=>'jordan@example.edu','course'=>'IS 6465','reason'=>'Please help with PHP form validation.','topics'=>['Exam review','Study plan'],'preferreddate'=>(new DateTimeImmutable('+10 days'))->format('Y-m-d'),'preferredtime'=>'Morning'];
$id=submitRequest($pdo,$sample);$r=findRequest($pdo,$id);check($r!==false&&$r['status']==='Open','UC01 create and Open');
check(decodeTopic($r['topic'])['topics']===['Exam review','Study plan'],'Lab 4 checkbox values preserved');
$id2=submitRequest($pdo,$sample);check((int)$pdo->query('SELECT COUNT(*) FROM students')->fetchColumn()===1,'Duplicate email reuses student');
check(count(listRequests($pdo,'IS 6465','Open'))===2,'UC02 course and status filter');
$bad=$sample;$bad['reason']='short';try{submitRequest($pdo,$bad);check(false,'Invalid reason rejected');}catch(InvalidArgumentException $e){check(true,'Invalid reason rejected');}
check((int)$pdo->query('SELECT COUNT(*) FROM tutoring_requests')->fetchColumn()===2,'Invalid submission writes nothing');
$edit=$sample;$edit['reason']='Updated request reason for the exam.';check(reviseRequest($pdo,$id,$edit),'Edit Open request');
check(decodeTopic(findRequest($pdo,$id)['topic'])['reason']===$edit['reason'],'Updated reason persisted');
check(cancelOpenRequest($pdo,$id),'Cancel Open request');check(findRequest($pdo,$id)['status']==='Cancelled','Cancelled row retained');
check(!cancelOpenRequest($pdo,$id),'Second cancellation rejected');check(findRequest($pdo,$id2)['status']==='Open','Unrelated request unchanged');
try{$pdo->exec("INSERT INTO tutoring_requests(student_id,course,topic,preferred_date,preferred_time) VALUES(999,'IS 6465','x','2030-01-01','Morning')");check(false,'FK enforced');}catch(PDOException $e){check(true,'FK enforced');}
check(count(listRequests($pdo,'IS 6570',''))===0,'UC02 empty filter result');
echo $failed?'FAILURES: '.$failed.PHP_EOL:'All integration checks passed'.PHP_EOL;exit($failed?1:0);
