<?php
require_once __DIR__.'/../config/db.php';require_once __DIR__.'/../services/requestService.php';
$id=filter_input(INPUT_GET,'request_id',FILTER_VALIDATE_INT);if(!$id||$id<1){http_response_code(400);exit('Invalid ID');}
$r=findRequest(openDatabase(),$id);if(!$r){http_response_code(404);exit('Not found');}
$topic=decodeTopic($r['topic']);require __DIR__.'/../includes/header.php';require __DIR__.'/../includes/nav.php';?>
<main class="container py-4"><h1>Edit request #<?=$id?></h1>
<?php if($r['status']!=='Open'):?><p>Only Open requests may be edited.</p><?php else:?>
<form method="post" action="update-request.php"><input type="hidden" name="request_id" value="<?=$id?>">
<label class="form-label" for="course">Course</label><select class="form-select mb-3" id="course" name="course"><?php foreach(['IS 6465','IS 6495','IS 6570'] as $c):?><option value="<?=escapeHtml($c)?>" <?=$c===$r['course']?'selected':''?>><?=escapeHtml($c)?></option><?php endforeach;?></select>
<label class="form-label" for="reason">What would you like help with?</label><textarea class="form-control mb-3" id="reason" name="reason" minlength="10" maxlength="500" required><?=escapeHtml($topic['reason'])?></textarea>
<label class="form-label" for="preferreddate">Preferred date</label><input class="form-control mb-3" id="preferreddate" name="preferreddate" type="date" value="<?=escapeHtml($r['preferred_date'])?>" required>
<fieldset><legend>Topics</legend><?php foreach(['Exam review','Practice problems','Study plan'] as $t):?><label class="me-3"><input type="checkbox" name="topics[]" value="<?=escapeHtml($t)?>" <?=in_array($t,$topic['topics'],true)?'checked':''?>> <?=escapeHtml($t)?></label><?php endforeach;?></fieldset>
<fieldset><legend>Preferred time</legend><?php foreach(['Morning','Afternoon','Evening'] as $t):?><label class="me-3"><input type="radio" name="preferredtime" value="<?=$t?>" <?=$t===$r['preferred_time']?'checked':''?> required> <?=$t?></label><?php endforeach;?></fieldset>
<button class="btn btn-primary mt-3">Save changes</button> <a class="btn btn-secondary mt-3" href="request-details.php?request_id=<?=$id?>">Back</a></form><?php endif;?></main><?php require __DIR__.'/../includes/footer.php';?>
