<script type="text/javascript">
	$(function(){
		$('#tabs').tabs();
	});
</script>
 
<form id="questionnary" name="questionnary" method="post" class="form-horizontal">
	<input type="hidden" name="header" value="header" />
	<div id="tabs">
		<ul>
			<?php
			$i=1;
			foreach($d['chooseLang'] as $l){
				printf('<li><a href="#tabs-%d">%s</a></li>',$i,strtoupper($l['common_abbr']));
				$i++;
			}
			?>
		</ul>
			<?php
			$i=1;
			foreach($d['chooseLang'] as $l){
				printf('<div id="tabs-%d">',$i);
					printf('<legend>%s</legend>',_("Création du questionnaire"));
				
				/*
				 * TITLE
				 */
				printf('<div class="control-group"><label for="title%s" class="control-label">%s</label>',
							strtoupper($l['common_abbr']),
							_("form.title")
				);
				printf('<div class="controls"><input id="title%s" name="title%s" placeholder="Titre" type="text" %s /></div></div>',
							strtoupper($l['common_abbr']),
							strtoupper($l['common_abbr']),
							$d['formValues'][$l['common_abbr']]['title']
				);
				/*
				 * THEME
				 */
				printf('<div class="control-group"><label for="theme%s" class="control-label">%s</label>',
							strtoupper($l['common_abbr']),
							_("form.theme")
				);
				printf('<div class="controls"><input id="theme%s" name="theme%s" placeholder="Thème" type="text" %s /></div></div>',
							strtoupper($l['common_abbr']),
							strtoupper($l['common_abbr']),
							$d['formValues'][$l['common_abbr']]['theme']
				);
				
				/* 
				 * DESCRIPTION
				 */
				printf('<div class="control-group"><label for="description%s" class="control-label">%s</label>',
							strtoupper($l['common_abbr']),
							_("form.description")
				);
				printf('<div class="controls"><textarea id="description%s" name="description%s">%s</textarea></div></div>',
							strtoupper($l['common_abbr']),
							strtoupper($l['common_abbr']),
							$d['formValues'][$l['common_abbr']]['description']
				);
			?>
					
				
		</div>
		<?php 
		$i++;
		}
		?>

		
	</div>
	<hr />
	<button type="submit" class="btn btn-primary">Etape 3</button>
</form>

<h1>$d</h1>
<?php
xUtil::pre($d);
?>