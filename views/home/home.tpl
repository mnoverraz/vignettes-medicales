<table>
	<caption><?php echo _("Liste des vignettes médicales"); ?></caption>
	<thead>
		<tr>
			<th><?php echo _("Module"); ?></th>
			<th><?php echo _("Titre"); ?></th>
			<th><?php echo _("Auteur"); ?></th>
			<th><?php echo _("Faire d'ici le"); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>3.1 - text</td>
			<td>titre</td>
			<td>auteur</td>
			<td>12.08.2012</td>
		</tr>
	</tbody>
</table>



<?php
echo '<h1>$d</h1>';
xUtil::pre($d);
echo '<h1>xContext</h1>';
xUtil::pre(xContext::dump());
?>