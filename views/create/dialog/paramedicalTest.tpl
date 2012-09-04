<script>
	$(function() {
		$( ".check" ).button();

		//$('reponse-1').next('tbody').children('input').each(function(index) {
		$('tr[testid]').each(function(index, elt) {
			$('input[name=' + $(elt).attr('testid') + ']').attr('checked', true);
		});
		$('.check').button('refresh');
	});

	function getIDs(){
		ret = '[';
		$('#paramedicalTestQuestionnary :checkbox:checked').each(function() {
			ret += $(this).attr('name') + ',';
		});
		ret += ']';
		
		return ret;
	}
	
		

	function clearAll(){
		$('.check').removeAttr('checked');
		$('.check').button('refresh');
	}
		
</script>

<form id="paramedicalTestQuestionnary" name="paramedicalTestQuestionnary" method="post">
	<div id="stylized" class="myform">
	
		<table>
			<tr>
				<?php
				for($i=0; $i<count($d['paramedicalTests']); $i++){
					if($i%5 == 0){
						echo '</tr>';
						echo '<tr>';
					}
					printf('<td><input type="checkbox" name="%d" id="check%d" class="check" /><label for="check%d">%s</label></td>',
						$d['paramedicalTests'][$i]['id'],
						$i+1,
						$i+1,
						$d['paramedicalTests'][$i]['paramedical-test-traduct_name']
					);
				}
				?>
			</tr>
		</table>
	</div>
</form>
<?php
//xUtil::pre($d);

?>