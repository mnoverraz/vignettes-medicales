<script>

function deleteUserInDB(userId, obj){
	$.ajax({
		url: "<?php echo xUtil::url('api/admin/deleteAction/') ?>",
		dataType: "json",
		data: {
			id: userId
		},
		success: function( data ) {
			console.log(data);
			if(data == true){
				deleteAdminRow(obj);
			}
		}
	});
}

function deleteAdminRow(obj) {
	$(obj).parent().parent().hide().show('slow').remove();
}


	$(function() {

		function putUserInDB(user){
			$.ajax({
				url: "<?php echo xUtil::url('api/admin/addAction/') ?>",
				dataType: "json",
				data: {
					id: user.id
				},
				success: function( data ) {
					if(data == true){
						addAdminRow(user);
					}
				}
			});
		}

		

		
		
		function addAdminRow(user) {
			completeName = user.firstname + ' ' + user.lastname;
			$('#administrators > tbody').append('<tr><td>' + completeName + '</td><td><button class="btn btn-danger" onclick="deleteUserInDB('+ user.id +', this)">Enlever</button></td></tr>').hide().show('slow');
		}


		$( "#city" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "http://localhost:8888/vignette/public/api/admin/searchNonAdminAction/",
					dataType: "json",
					data: {
						search: request.term
					},
					success: function( data ) {
						response( $.map( data, function( item ) {
							return {
								label: item.firstname + ' ' + item.lastname ,
								//value: item.id,
								obj: item
							}
						}));
					}
				});
			},
			minLength: 2,
			select: function( event, ui ) {
				putUserInDB(ui.item.obj);
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	});
	</script>


<h1>Administration</h1>

	<label for="city">Search user</label>
	<input id="city" type="text" />



<table id="administrators">
<thead><tr><th>User</th><th>Action</th></tr></thead>
<tbody>
<?php
foreach($d['listeAdmin'] as $user){
	printf('<tr><td>%s %s </td><td><button class="btn btn-danger" onclick="deleteUserInDB(%s, this)">Enlever</button></td></tr>',
		$user['firstname'],
		$user['lastname'],
		$user['id']
	);
}
?>
</tbody>
</table>
<h1>$d</h1>
<?php xUtil::pre($d) ?>