<script type="text/javascript">
	$(function(){
		$('#tabs').tabs();
	});
</script>
 
<form id="questionnary" name="questionnary" method="post">
	<input type="hidden" name="header" />
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
		
		
		<div id="stylized" class="myform">
			<?php
			$i=1;
			foreach($d['chooseLang'] as $l){
				printf('<div id="tabs-%d">',$i);
					printf('<h1>%s</h1>',_("Création du questionnaire"));
					printf('<p>%s</p>',_("Créer votre formulaire"));
				
				/*
				 * TITLE
				 */
				printf('<label for="title%s">%s<span class="small">%s</span></label>',
							strtoupper($l['common_abbr']),
							_("form.title"),
							_("form.help.title")
				);
				printf('<input id="title%s" name="title%s" type="text" %s />',
							strtoupper($l['common_abbr']),
							strtoupper($l['common_abbr']),
							$d['formValues'][$l['common_abbr']]['title']
				);
				
				/*
				 * THEME
				 */
				printf('<label for="theme%s">%s<span class="small">%s</span></label>',
							strtoupper($l['common_abbr']),
							_("form.theme"),
							_("form.help.theme")
				);
				printf('<input id="theme%s" name="theme%s" type="text" %s />',
							strtoupper($l['common_abbr']),
							strtoupper($l['common_abbr']),
							$d['formValues'][$l['common_abbr']]['theme']
				);
				
				/* 
				 * DESCRIPTION
				 */
				printf('<label for="description%s">%s<span class="small">%s</span></label>',
							strtoupper($l['common_abbr']),
							_("form.description"),
							_("form.help.description")
				);
				printf('<div style="clear:both;"></div>');
				printf('<div class="test"><textarea id="description%s" name="description%s">%s</textarea></div>',
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

		
		<button type="submit">Etape 3</button>
	</div>
</form>

<h1>$d</h1>
<?php
xUtil::pre($d);
?>