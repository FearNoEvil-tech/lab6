<?php
require_once __DIR__.'/../config/db.php';require_once __DIR__.'/../services/requestService.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit('POST required');}
if(($_POST['form_name']??'')!=='tutoring_request'){http_response_code(400);exit('Invalid form');}
try{$id=submitRequest(openDatabase(),$_POST);header('Location: request-details.php?request_id='.$id,true,303);exit;}
catch(InvalidArgumentException $e){http_response_code(422);echo '<h1>Request could not be submitted</h1><p>'.escapeHtml($e->getMessage()).'</p><a href="request-form.php">Return to form</a>';}
catch(Throwable $e){error_log($e->getMessage());http_response_code(500);exit('Unable to save request');}
