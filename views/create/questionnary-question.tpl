<script language="javascript">
<?php
	if(isset($d['chooseLang'])){
		printf('var chooseLang = %s', json_encode($d['chooseLang']));
	}
?>
</script>

<div id="dialog"></div>
 
<form id="questionnary" name="questionnary" method="post" class="form-horizontal">
	<input type="hidden" name="question" value="posted" />
	<legend><?php echo _('Création des questions')?></legend>
	
		<div id="question-paramedical-container" class="questionContainer">
			<legend><?php echo _('Question test paramedical')?></legend>
			<div class="control-group">
				<label for="paramedicalTest[question][<?php echo $d['chooseLang'][0]['common_abbr']?>]" class="control-label">Question</label>
				<div class="controls">
					<?php
					foreach($d['chooseLang'] as $l){
						printf('<input id="paramedicalTest[question][%s]" name="paramedicalTest[question][%s]" type="text" placeholder="Question %s" />',
							$l['common_abbr'],
							$l['common_abbr'],
							$l['common_abbr']
						);
					}
					?>
				</div>
			</div>
			
			<div class="control-group">
				<label for="paramedicalTest[remark][<?php echo $d['chooseLang'][0]['common_abbr']?>]" class="control-label"><?php echo _('Remarque')?></label>
				<div class="controls">
					<?php
					foreach($d['chooseLang'] as $l){
						printf('<input id="paramedicalTest[remark][%s]" name="paramedicalTest[remark][%s]" type="text" placeholder="Remark %s" />',
							$l['common_abbr'],
							$l['common_abbr'],
							$l['common_abbr']
						);
					}
					?>
				</div>
			</div>
			
			<div class="control-group">
				<label for="paramedicalTest[mode]" class="control-label"><?php echo _('Mode')?></label>
				<div class="controls">
					<select id="paramedicalTest[mode]" name="paramedicalTest[mode]" class="type">
						<option value="1">QCM</option>
						<option value="2">Single</option>
					</select>
				</div>
			</div>
			
			<div class="control-group">
				<div class="controls">
					<button class="btn btn-success" type="button" onclick="addParamedicalTest(this)"><?php echo _('Ajouter une réponse')?></button>
				</div>
			</div>
		</div>
		
		<div id="questions-picture-container" class="questionContainer">
			<legend><?php echo _('Question complémentaire picture')?></legend>
			<div id="complementaryTestContainer-1" class="questionContainer">
				<legend class="complementary-test"><?php echo _('Question complémentaire picture')?></legend>
				<div class="control-group">
					<label for="complementaryTest[complementaryTestContainer-1][testName][<?php echo $d['chooseLang'][0]['common_abbr']?>]" class="control-label"><?php echo _('Nom du test')?></label>
					<div class="controls">
						<?php
						foreach($d['chooseLang'] as $l){
							printf('<input id="complementaryTest[complementaryTestContainer-1][testName][%s]" name="complementaryTest[complementaryTestContainer-1][testName][%s]" type="text" />',
								$l['common_abbr'],
								$l['common_abbr']
							);
						}
						?>
					</div>
				</div>
				<div class="control-group">
					<label for="complementaryTest[complementaryTestContainer-1][question][<?php echo $d['chooseLang'][0]['common_abbr']?>]" class="control-label">Question</label>
					<div class="controls">
						<?php
						foreach($d['chooseLang'] as $l){
							printf('<input id="complementaryTest[complementaryTestContainer-1][question][%s]" name="complementaryTest[complementaryTestContainer-1][question][%s]" type="text" />',
								$l['common_abbr'],
								$l['common_abbr']
							);
						}
						?>
						
					</div>
				</div>
				<div class="control-group">
					<label for="complementaryTest[complementaryTestContainer-1][mode]" class="control-label"><?php echo _('Mode')?></label>
					<div class="controls">
						<select id="complementaryTest[complementaryTestContainer-1][mode]" name="complementaryTest[complementaryTestContainer-1][mode]" class="type">
							<option value="1">QCM</option>
							<option value="2">Single</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button class="btn btn-success" type="button" onclick="addPictureTest(this)">addAnswer</button>
					</div>
				</div>
			</div>
			
			<div id="complementaryTestContainer-2" class="questionContainer">
				<legend class="complementary-test"><?php echo _('Question complémentaire picture')?></legend>
				<div class="control-group">
					<label for="complementaryTest[complementaryTestContainer-1][testName][<?php echo $d['chooseLang'][0]['common_abbr']?>]" class="control-label"><?php echo _('Nom du test')?></label>
					<div class="controls">
						<?php
						foreach($d['chooseLang'] as $l){
							printf('<input id="complementaryTest[complementaryTestContainer-2][testName][%s]" name="complementaryTest[complementaryTestContainer-2][testName][%s]" type="text" />',
								$l['common_abbr'],
								$l['common_abbr']
							);
						}
						?>
					</div>
				</div>
				<div class="control-group">
					<label for="complementaryTest[complementaryTestContainer-2][question][<?php echo $d['chooseLang'][0]['common_abbr']?>]" class="control-label">Question</label>
					<div class="controls">
						<?php
						foreach($d['chooseLang'] as $l){
							printf('<input id="complementaryTest[complementaryTestContainer-2][question][%s]" name="complementaryTest[complementaryTestContainer-2][question][%s]" type="text" />',
								$l['common_abbr'],
								$l['common_abbr']
							);
						}
						?>
						
					</div>
				</div>
				<div class="control-group">
					<label for="complementaryTest[complementaryTestContainer-2][mode]" class="control-label"><?php echo _('Mode')?></label>
					<div class="controls">
						<select id="complementaryTest[complementaryTestContainer-2][mode]" name="complementaryTest[complementaryTestContainer-2][mode]" class="type">
							<option value="1">QCM</option>
							<option value="2">Single</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button class="btn btn-success" type="button" onclick="addPictureTest(this)">addAnswer</button>
					</div>
				</div>
			</div>
		</div>
		
	<hr />
	<button type="submit" class="btn btn-primary">Etape 3</button>
	
</form>

<h1>$d</h1>
<?php
xUtil::pre($d);
?>

<h1>$d</h1>
<?php
xUtil::pre($_SESSION['store']);
?>