

document.addEventListener('DOMContentLoaded', function() {
    var clickCount = 0;
    var keypressCount = 0;
    $('body').bind('click keypress', function(event) {
        if (event.type === 'click') {
            clickCount++;
        } else if (event.type === 'keypress') {
            keypressCount++;
        }

        if (clickCount >= 2 || keypressCount >= 2) {
            clickCount = 0;
            keypressCount = 0;
			$.active = true;
        }
    });

	checkActivity(600000, 12000, 0, 0);
	
	
	
	/* CLEAR ALL DEVICES ON */
	$('.clear_all_devices').on('click', function() {
		var dataId = $(this).data('id');
		var result = 'logout_all_devices';
		$.post(site_domain + '/execute/action.php', { result: result, data_id: dataId }, function(response) {
			var jsonData = JSON.parse(response);
			if (jsonData.type != 'success') {
				location.reload();
			}
			swal(jsonData.title, jsonData.subtitle, jsonData.type);
		});
	});
	
	$('.clear_all_request').on('click', function() {
		removeCache();
		var dataId = $(this).data('id');
		var result = 'clear_all_request';
		$.post(site_domain + '/execute/action.php', { result: result, data_id: dataId }, function(response) {
			var jsonData = JSON.parse(response);
			if (jsonData.type != 'success') {
				updateChart();
			}
			swal(jsonData.title, jsonData.subtitle, jsonData.type);
		});
	});
	
	/* CLEAR ALL DEVICES OFF */
    
	
	window.removeCache = function() {	
		$.post(site_domain + '/execute/action.php', { result: 'cache_reset' }, function(response) { console.log(response); });
	}
	window.removeCaches = function(type) {	
		$.post(site_domain + '/execute/action.php', { result: 'cache_reset_type', type: type }, function(response) {  });
	}
	$('.languages').on('click', function(e) {
		e.preventDefault();
		var dataId = $(this).data('id');
		var result = 'change_lang';
		removeCache();
		$.post(site_domain + '/execute/action.php', { result: result, data_id: dataId }, function(response) {
			var jsonData = JSON.parse(response);
			if (jsonData.type == 'success') {
				location.reload();
			}
			swal(jsonData.title, jsonData.subtitle, jsonData.type);
		});
	});
	
	if (cached == true) {
		if (getCookie('sidebar_toggle') == 1) {
			$('.sidebar_toggle').addClass('active');
			$('.sidebar').addClass('show');
			$('.content').addClass('show');
		} else {
			$('.sidebar_toggle').removeClass('active');
			$('.sidebar').removeClass('show');
			$('.content').removeClass('show');
		}
	}
	
	$(document).on('click', '.sidebar_toggle', function() {
		removeCache();
		$(this).toggleClass('active');
		$('.sidebar').toggleClass('show');
		$('.content').toggleClass('show');
		if ($('.sidebar_toggle').hasClass('active')) {
			setPermanentCookie('sidebar_toggle', 1);
		} else {
			setPermanentCookie('sidebar_toggle', 0);
		}
	});
	
	window.toggleTheme = function(e, theme) {		
		e.preventDefault();
		removeCache();
		var nav_icon = $('#theme_icon');
		var buttons = $('.theme_select');
		buttons.removeClass('ib-active');
		if (theme === 'auto') {
			if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
				document.documentElement.setAttribute('data-dbb-page', 'dark');
				document.documentElement.setAttribute('data-bs-theme', 'dark');
				nav_icon.html(isThemeDarkIcon);
				setPermanentCookie('theme', 'dark');
			} else {
				document.documentElement.setAttribute('data-dbb-page', 'light');
				document.documentElement.setAttribute('data-bs-theme', 'light');
				nav_icon.html(isThemeLightIcon);
				setPermanentCookie('theme', 'light');
			}
		} else {
			document.documentElement.setAttribute('data-dbb-page', theme);
			document.documentElement.setAttribute('data-bs-theme', theme);
			setPermanentCookie('theme', theme);
			if (theme == 'dark') {
				nav_icon.html(isThemeDarkIcon);
			} else {
				nav_icon.html(isThemeLightIcon);
			}
		}
		$(e.target).addClass('ib-active');
		setPermanentCookie('theme_button', theme);
	}
	
	
	$('#theme_icon').on('click', function(e) {	
		e.preventDefault();
		removeCache();
		var nav_icon = $('#theme_icon');
		if (document.documentElement.getAttribute('data-bs-theme') === 'dark') {
			document.documentElement.setAttribute('data-dbb-page', 'light');
			document.documentElement.setAttribute('data-bs-theme', 'light');
			nav_icon.html(isThemeLightIcon);
			setPermanentCookie('theme', 'light');
		} else {
			document.documentElement.setAttribute('data-dbb-page', 'dark');
			document.documentElement.setAttribute('data-bs-theme', 'dark');
			nav_icon.html(isThemeDarkIcon);
			setPermanentCookie('theme', 'dark');
		}
	});
	
	$('#toggle_theme').on('click', function(e) {	
		e.preventDefault();
		removeCache();
		var nav_icon = $('#theme_icon');
		if (document.documentElement.getAttribute('data-bs-theme') === 'dark') {
			document.documentElement.setAttribute('data-dbb-page', 'light');
			document.documentElement.setAttribute('data-bs-theme', 'light');
			nav_icon.html(isThemeLightIcon);
			setPermanentCookie('theme', 'light');
		} else {
			document.documentElement.setAttribute('data-dbb-page', 'dark');
			document.documentElement.setAttribute('data-bs-theme', 'dark');
			nav_icon.html(isThemeDarkIcon);
			setPermanentCookie('theme', 'dark');
		}
	});
	
    var totalList = $('#total');
    var searchBox = $('#search');
    var pageIn = $('#paginationID');
    var optionIn = $('#option');
    var viewType = $('#view_list_type');

	window.codeCall = function() {
        var result = 'code';
        var total = totalList.val();
        var search = searchBox.val();
        var page = pageIn.val();
        var options = optionIn.val();
		
		var icon = $('.icon_select');
        var results = getCookie('column_user_selected');

        $.post(site_domain + '/execute/table.php', { result: result, total: total, search: search, pag: page, options : options },
            function(response) {
                $(function () { $('[data-toggle="tooltip"]').tooltip() })
				$(document).ready(function() {
					/* ERASE LICENSE JS */
					$('.license').on('click', '.erase', function(e) {
						e.preventDefault();
						
						var dataType = $(this).closest('.erase').data('type');
						var dataId = $(this).closest('.erase').data('id');
						
						swal({
							title: langSystem_erase_secure_title,
							text: langSystem_erase_secure_subtitle,
							showCancelButton: true,
							showLoaderOnConfirm: true,
							confirmButtonText: langSystem_erase_secure_button,
							type: langSystem_erase_secure_type,
						}).then(() => {
							var result = 'erase';
							$.post( site_domain + '/execute/action.php', { result : result, data_id : dataId, data_type : dataType }, function( response ) {
								var jsonData = JSON.parse(response);
								if (jsonData.type == 'success') {
									codeCall();
								}
								swal(jsonData.title, jsonData.subtitle, jsonData.type);
							});
						});

					});
				});
	
                $('#load_index_result').html(response);
            }
        );
    }
	
	// ==================================== GROUPS ACTIONS ==================================== //
	// ==================================== GROUPS ACTIONS ==================================== //
	// ==================================== GROUPS ACTIONS ==================================== //
	// ==================================== GROUPS ACTIONS ==================================== //
	// ==================================== GROUPS ACTIONS ==================================== //
	// ==================================== GROUPS ACTIONS ==================================== //
	// ==================================== GROUPS ACTIONS ==================================== //
	// ==================================== GROUPS ACTIONS ==================================== //
	// ==================================== GROUPS ACTIONS ==================================== //
	// ==================================== GROUPS ACTIONS ==================================== //
	
	window.updateGroups = function(e) {
        var result = 'group_select_user';
		var userId = $(e).data('id');
        $.post(site_domain + '/execute/table.php', { result: result, iduser: userId },
            function(response) {
				var miModal = $('#groupListAdd');
				var modal = new bootstrap.Modal(miModal);
				modal.show();
				$(function () { $('[data-toggle="tooltip"]').tooltip() })
				$(document).ready(function() {
					$('.group_list_user').on('click', '.group-checkbox', function() {
						var dataId = $(this).data('id');
						var dataUser = $(this).data('user');
						var isChecked = $(this).prop('checked');
						var dataType = isChecked ? '1' : '0';
						
						var result = 'modifiedUserGroup';
						$.post(site_domain + '/execute/action.php', { result: result, data_id: dataId, data_type: dataType, data_user: dataUser }, function(response) {
						  var jsonData = JSON.parse(response);
						  if (jsonData.type != 'success') {
						  swal(jsonData.title, jsonData.subtitle, jsonData.type);
						  }
						  viewListOfUser(userId);
						});
					});
				});
                $('#groups_list').html(response);
            }
        );
    }
	
    $('#groupss-list').on('click', '.create-group', function(e) {
        e.preventDefault();
		var dataIdToDelete = $(this).closest('li').data('id');
		var liToDelete = $('li[data-id="' + dataIdToDelete + '"]');
		var valueGroupName = $('li[data-id="' + dataIdToDelete + '"] #new_group_name').val();
		var digitCount = valueGroupName.replace(/\s/g, '').length;
		var minLength = 3;
		var maxLength = 64;
		
		if (valueGroupName.trim() === "") {
			swal('Unknown Value.', 'Not has been completed the fields required.', 'error');
		} else if (valueGroupName.length > maxLength) {
			swal('Too many characters.', 'The value cannot be longer than 64 characters. Shorten the group name to continue.', 'warning');
		} else if (digitCount < minLength) {
			swal('Very few characters.', 'You need at least 3 letters to create the group.', 'warning');
		} else {
			liToDelete.remove();
			var remainingLiCount = $('#groupss-list > li').length;
			
			if (remainingLiCount === 0) {
				$('#new-groups-list').attr('hidden', true);
			}
			
			var result = 'add-group';
			$.post( site_domain + '/execute/action.php', { result : result, new_group_name : valueGroupName }, function( response ) {
				var jsonData = JSON.parse(response);
				groupCall();
			});
		}
    });
	
    $('#groupss-list').on('click', '.delete-group', function(e) {
        e.preventDefault();
		var dataIdToDelete = $(this).closest('li').data('id');
		var liToDelete = $('li[data-id="' + dataIdToDelete + '"]');
		
		liToDelete.remove();
		var remainingLiCount = $('#groupss-list > li').length;
		if (remainingLiCount === 0) {
			$('#new-groups-list').attr('hidden', true);
		}
    });
	$('#generate_new_group').on('click', function(e) {
        e.preventDefault();
		var newGroupId = generateUniqueId();

        var newLi = $('<li>', {
                'class': 'border-top-0',
                'data-id': newGroupId,
                'html': '<div class="row d-flex align-items-center">' +
                            '<div class="col-9 passive-link">' +
                                '<i class="fa fa-circle-half-stroke p-2 d-inline-block"></i>' +
                                '<div class="package-name d-inline-block ml-6">' +
                                    '<h6 class="mb-0"><input type="text" class="form-control" name="new_group_name" placeholder="Name for the new Group." id="new_group_name"></h6>' + 
                                '</div>' +
                            '</div>' +
                            '<div class="col-3 text-right d-flex align-items-center justify-content-end">' +
								'<a href="#" width="16" height="16" class="btn-a mr-2 create-group"><i class="fa fa-check"></i></a>' +
								'<a href="#" width="16" height="16" class="btn-a mr-2 delete-group"><i class="fa fa-xmark"></i></a>' +
                            '</div>' +
                        '</div>'
        });

        $('#groupss-list').append(newLi);
        $('#new-groups-list').removeAttr('hidden');
		var remainingLiCount = $('#groups-list > li').length;
		
    });
	
    function generateUniqueId() {
        return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
    }
	
	$('#change_to_edit').on('click', function(e) {
		e.preventDefault();
		var edit_form = $('#edit_the_group');

		edit_form.toggle();

		if (edit_form.is(':visible')) {
			$(this).html('<i class="fa fa-xmark"></i> Cancel Edit');
		} else {
			$(this).html('<i class="fa-regular fa-pen-to-square"></i> Edit');
		}
	});

	
	$('#modifiedGroup').submit(function(e) {
        e.preventDefault();
		var group_name_field = $('#group_name').val();
		var digitCount = group_name_field.replace(/\s/g, '').length;
		if (group_name_field.trim() === "") {
			swal('Unknown Value.', 'Not has been completed the fields required.', 'error');
		} else if (group_name_field.length > 64) {
			swal('Too many characters.', 'The value cannot be longer than 64 characters. Shorten the permission to continue.', 'warning');
		} else if (digitCount < 3) {
			swal('Very few characters.', 'You need at least 3 letters to create the permission.', 'warning');
		} else {
			swal({
				title: 'Sure about the changes?',
				text: 'Click \'save\' to save the changes and \'cancel\' to cancel the change!',
				showCancelButton: true,
				showLoaderOnConfirm: true,
				confirmButtonText: "Save",
				type: 'info',
			}).then(() => {
				$.ajax({
					type: "POST",
					url: site_domain + '/execute/action.php',
					data: $(this).serialize(),
					success: function(response) {
						var jsonData = JSON.parse(response);
						swal({
							title: jsonData.title,
							text: jsonData.subtitle,
							showCancelButton: true,
							showLoaderOnConfirm: true,
							confirmButtonText: "Ok",
							type: jsonData.type,
						}).then(() => {
							if (jsonData.type === 'success') {
								location.reload();
							}
						});
					}
				});
			});
		}
    });
	
	window.groupCall = function() {
        var result = 'group';
        var total = totalList.val();
        var search = searchBox.val();
        var page = pageIn.val();
        var options = optionIn.val();
		
		var icon = $('.icon_select');
        var results = getCookie('column_user_selected');

        $.post(site_domain + '/execute/table.php', { result: result, total: total, search: search, pag: page, options : options },
            function(response) {
                $(function () { $('[data-toggle="tooltip"]').tooltip() })
				$(document).ready(function() {
					/* ERASE LICENSE JS */
					$('.remove_this_group').on('click', function(e) {
						e.preventDefault();
						
						var dataId = $(this).data('id');
						
						swal({
							title: langSystem_erase_secure_title,
							text: langSystem_erase_secure_subtitle,
							showCancelButton: true,
							showLoaderOnConfirm: true,
							confirmButtonText: langSystem_erase_secure_button,
							type: langSystem_erase_secure_type,
						}).then(() => {
							var result = 'erase_group';
							$.post( site_domain + '/execute/action.php', { result : result, data_id : dataId }, function( response ) {
								var jsonData = JSON.parse(response);
								if (jsonData.type == 'success') {
									groupCall();
								}
								swal(jsonData.title, jsonData.subtitle, jsonData.type);
							});
						});

					});
				});
	
                $('#load_index_result').html(response);
            }
        );
    }
	
	window.groupPermissionCall = function() {
        var result = 'group_permission';
        var total = totalList.val();
        var search = searchBox.val();
        var page = pageIn.val();
        var options = optionIn.val();
        var dataId = $('#groupId').val();

        $.post(site_domain + '/execute/table.php', { result: result, total: total, search: search, pag: page, options : options, data_id: dataId },
            function(response) {
                $(function () { $('[data-toggle="tooltip"]').tooltip() })
				$('.hidden_permission_list').on('click', function(e) {
					e.preventDefault();
					var edit_form = $('.permission_in_list');

					edit_form.toggle();

					if (edit_form.is(':visible')) {
						$(this).html('<i class="fa fa-chevron-down"></i>');
						setPermanentCookie('hidden_permission_list', '0');
					} else {
						$(this).html('<i class="fa fa-chevron-up"></i>');
						setPermanentCookie('hidden_permission_list', '1');
					}
				});
				$(document).ready(function() {
					$('.start-edit-perms').on('click', function(e) {
						e.preventDefault();
						var dataid = $(this).data('id');
						var dataperm = $(this).data('perm');
						var datatype = $(this).data('type');
						var datagroup = $(this).data('group');
						var labelid = $('.label-for-edit[data-label="' + dataid + '"]');
						if (datatype === 0) {
							labelid.html('<input type="text" class="form-control" placeholder="dbb.admin.example" value="' + dataperm + '" id="new_permission_' + dataid +  '">');
							$(this).data('type', 1);
							$(this).html('<i class="fa fa-check"></i>');
						} else {
							var value = $('#new_permission_' + dataid).val();
							labelid.html('<h6 class="mb-0">' + value + '</h6>');
							$(this).data('type', 0);
							$(this).data('perm', value);
							$('.start-erase-perms').data('perm', value);
							$(this).html('<i class="fa-regular fa-pen-to-square"></i>');
							$.post(site_domain + '/execute/action.php', { result: 'edit_perm', olddata: dataperm, dataid: dataid, value: value, group: datagroup }, function(response) { var jsonData = JSON.parse(response); if (jsonData.type != 'success') { swal(jsonData.title, jsonData.subtitle, jsonData.type); } });
						}
						$('.start-erase-perms[data-id="' + dataid + '"]').toggle();
					});
					$('.start-erase-perms').on('click', function(e) {
						e.preventDefault();
						var dataid = $(this).data('id');
						var dataperm = $(this).data('perm');
						$.post(site_domain + '/execute/action.php', { result: 'erase_perm', dataid: dataid, experm: dataperm }, function(response) { var jsonData = JSON.parse(response); if (jsonData.type != 'success') { swal(jsonData.title, jsonData.subtitle, jsonData.type); } });
						var count_perm = $('#permission_count_list');
						var count_perm_count = $('#permission_count_list').data('id');
						count_perm.text(count_perm_count - 1);
						$('#permission_count_list').data('id', count_perm_count - 1);
						groupPermissionCall();
					});
				});
				$('#load_permission_list').html(response);
            }
        );
    }
	$('.start-add-perm').on('click', function(e) {
		e.preventDefault();
		var dataid = $(this).data('id');
		var uniqueId = generateUniqueId();
		var section = $('.permission_list_group > li[data-id="' + dataid + '"]');
		var section_count = $('#permission_list_group > li');
		var liCount = section_count.length - 1;
        var newLi = $('<li>', {
                'class': 'border-top-0',
                'data-id': uniqueId,
                'html': '<div class="row d-flex align-items-center">' +
                            '<div class="col-9 passive-link">' +
                                '<div class="package-name d-inline-block ml-6">' +
                                    '<input type="text" class="form-control" placeholder="dbb.admin.example" id="new_permission_' + uniqueId +  '">' + 
                                '</div>' +
                            '</div>' +
                            '<div class="col-3 text-right d-flex align-items-center justify-content-end">' +
								'<a href="#" width="16" height="16" data-id="' + uniqueId + '" class="btn-a mr-2 add-perm-group"><i class="fa fa-check"></i></a>' +
								'<a href="#" width="16" height="16" data-id="' + uniqueId + '" class="btn-a mr-2 erase-perm-group"><i class="fa fa-xmark"></i></a>' +
                            '</div>' +
                        '</div>'
        });
		if (liCount == 0) {
			var section = $('.permission_list_group > li[data-id=":id:"]');
			section.remove();
		}
		$('#permission_list_group').prepend(newLi);
	});
	$(document).on('click', '.erase-perm-group-new', function(e) {
		e.preventDefault();
		var dataid = $(this).data('id');
		var dataperm = $(this).data('perm');
		$.post(site_domain + '/execute/action.php', { result: 'erase_perm', dataid: dataid, experm: dataperm }, 
		function(response) { 
			var jsonData = JSON.parse(response); 
			if (jsonData.type == 'success') { 
				var count_perm = $('#permission_count_list');
				var count_perm_count = $('#permission_count_list').data('id');
				count_perm.text(count_perm_count - 1);
				$('#permission_count_list').data('id', count_perm_count - 1);
				var section = $('#permission_list_group > li[data-id="' + dataid + '"]');
				section.remove();
			}
			if (jsonData.type != 'success') { 
				swal(jsonData.title, jsonData.subtitle, jsonData.type); 
			}
		});
	});
	
	$(document).on('click', '.edit-perm-group-new', function(e) {
		e.preventDefault();
		var dataid = $(this).data('id');
		var dataperm = $(this).data('perm');
		var datatype = $(this).data('type');
		var datagroup = $(this).data('group');
		var labelid = $('.label-for-edit[data-label="' + dataid + '"]');
		if (datatype === 0) {
			labelid.html('<input type="text" class="form-control" placeholder="dbb.admin.example" value="' + dataperm + '" id="new_permission_' + dataid +  '">');
			$(this).data('type', 1);
			$(this).html('<i class="fa fa-check"></i>');
		} else {
			var value = $('#new_permission_' + dataid).val();
			labelid.html('<h6 class="mb-0">' + value + '</h6>');
			$(this).data('type', 0);
			$(this).data('perm', value);
			$('.erase-perm-group-new').data('perm', value);
			$(this).html('<i class="fa-regular fa-pen-to-square"></i>');
			$.post(site_domain + '/execute/action.php', { result: 'edit_perm', olddata: dataperm, dataid: dataid, value: value, group: datagroup }, function(response) { var jsonData = JSON.parse(response); if (jsonData.type != 'success') { swal(jsonData.title, jsonData.subtitle, jsonData.type); } });
		}
		$('.erase-perm-group-new[data-id="' + dataid + '"]').toggle();
	});
	
	$(document).on('click', '.add-perm-group', function(e) {
		e.preventDefault();
		var group = $('#groupId').val();
		var dataid = $(this).data('id');
		var value = $('#new_permission_' + dataid).val();
		$.post(site_domain + '/execute/action.php', { result: 'add_perm', group: group, value: value }, 
		function(response) { 
			var jsonData = JSON.parse(response); 
			if (jsonData.type == 'success') { 
				var section = $('#permission_list_group > li[data-id="' + dataid + '"]');
				section.remove();
				var count_perm = $('#permission_count_list');
				var count_perm_count = $('#permission_count_list').data('id');
				count_perm.text(count_perm_count + 1);
				$('#permission_count_list').data('id', count_perm_count + 1);
				var newLi = $('<li>', {
                'class': 'border-top-0',
                'data-id': jsonData.dataid,
                'html': '<div class="row d-flex align-items-center">' +
                            '<div class="col-9 passive-link">' +
                                '<div class="package-name d-inline-block ml-6 label-for-edit" data-label="' + jsonData.dataid + '">' +
                                    '<h6>' + value + '</h6>' + 
                                '</div>' +
                            '</div>' +
                            '<div class="col-3 text-right d-flex align-items-center justify-content-end">' +
								'<a href="#" width="16" height="16" data-group="' + group + '" data-type="0" data-perm="' + value + '" data-id="' + jsonData.dataid + '" class="btn-a mr-2 edit-perm-group-new"><i class="fa-regular fa-pen-to-square"></i></a>' +
								'<a href="#" width="16" height="16" data-perm="' + value + '" data-id="' + jsonData.dataid + '" class="btn-a mr-2 erase-perm-group-new"><i class="fa-regular fa-circle-xmark"></i></a>' +
                            '</div>' +
                        '</div>'
				});
				$('#permission_list_group').prepend(newLi);
			} 
			if (jsonData.type != 'success') { 
				swal(jsonData.title, jsonData.subtitle, jsonData.type); 
			}
		});
		
	});
	
	$(document).on('click', '.erase-perm-group', function(e) {
		e.preventDefault();
		var dataid = $(this).data('id');
		var uniqueId = generateUniqueId();
		var section = $('#permission_list_group > li[data-id="' + dataid + '"]');
		var section_count = $('#permission_list_group > li');
		section.remove();
		var liCount = section_count.length -1;
		if (liCount === 0) {
			var newLi = $('<li>', {
					'class': 'border-top-0',
					'data-id': ':id:',
					'html': '<h5>No results found.</h5>'
			});
			$('#permission_list_group').prepend(newLi);
		}
	});
	window.groupUserCall = function() {
        var result = 'group_users';
        var total = $('#totals').val();
        var search = $('#searchs').val();
        var page = $('#paginationIDs').val();
        var options = $('#options').val();
        var dataId = $('#groupId').val();

        $.post(site_domain + '/execute/table.php', { result: result, total: total, search: search, pag: page, options : options, data_id: dataId },
            function(response) {
                $(function () { $('[data-toggle="tooltip"]').tooltip() })
				$('.hidden_user_list').on('click', function(e) {
					e.preventDefault();
					var edit_form = $('.users_in_list');

					edit_form.toggle();

					if (edit_form.is(':visible')) {
						$(this).html('<i class="fa fa-chevron-down"></i>');
						setPermanentCookie('hidden_user_list', '0');
					} else {
						$(this).html('<i class="fa fa-chevron-up"></i>');
						setPermanentCookie('hidden_user_list', '1');
					}
				});
	
				$(document).on('click', '.erase-user-group', function(e) {
					e.preventDefault();
					var dataid = $(this).data('id');
					$.post(site_domain + '/execute/action.php', { result: 'erase_user', dataid: dataid }, 
					function(response) { 
						var jsonData = JSON.parse(response); 
						if (jsonData.type == 'success') { 
							var count_perm = $('#users_count_list');
							var count_perm_count = $('#users_count_list').data('id');
							count_perm.text(count_perm_count - 1);
							$('#users_count_list').data('id', count_perm_count - 1);
							var section = $('#users_list_group > li[data-id="' + dataid + '"]');
							section.remove();
						}
						if (jsonData.type != 'success') { 
							swal(jsonData.title, jsonData.subtitle, jsonData.type); 
						}
					});
				});
				
				
                $('#load_user_list').html(response);
            }
        );
    }
	
	$('.start-add-user').on('click', function(e) {
		e.preventDefault();
		var dataid = $(this).data('id');
		var uniqueId = generateUniqueId();
		var section = $('.users_list_group > li[data-id="' + dataid + '"]');
		var section_count = $('#users_list_group > li');
		var liCount = section_count.length - 1;
        var newLi = $('<li>', {
                'class': 'border-top-0',
                'data-id': uniqueId,
                'html': '<div class="row d-flex align-items-center">' +
                            '<div class="col-9 passive-link">' +
                                '<div class="package-name d-inline-block ml-6 search-container">' +
                                    '<input type="text" class="form-control client_adds" name="client_add" placeholder="ID" id="new_user_' + uniqueId +  '">' + 
                                    '<input type="hidden" class="form-control" id="new_user_name_' + uniqueId +  '">' + 
                                    '<input type="hidden" class="form-control" id="new_user_avatar_' + uniqueId +  '">' + 
									'<ul id="clientResultsAdd" class="search-results" data-val="' + uniqueId + '"></ul>' + 
								'</div>' +
                            '</div>' +
                            '<div class="col-3 text-right d-flex align-items-center justify-content-end">' +
								'<a href="#" width="16" height="16" data-id="' + uniqueId + '" class="btn-a mr-2 add-user-group"><i class="fa fa-check"></i></a>' +
								'<a href="#" width="16" height="16" data-id="' + uniqueId + '" class="btn-a mr-2 erase-user-group"><i class="fa fa-xmark"></i></a>' +
                            '</div>' +
                        '</div>'
        });
		if (liCount == 0) {
			var section = $('.users_list_group > li[data-id=":id:"]');
			section.remove();
		}
		$('#users_list_group').prepend(newLi);
	});
	
	$(document).on('click', '.add-user-group', function(e) {
		e.preventDefault();
		var group = $('#groupId').val();
		var dataid = $(this).data('id');
		var value = $('#new_user_' + dataid).val();
		var avatar = $('#new_user_avatar_' + dataid).val();
		var username = $('#new_user_name_' + dataid).val();
		$.post(site_domain + '/execute/action.php', { result: 'add_user', group: group, value: value }, 
		function(response) { 
			var jsonData = JSON.parse(response); 
			if (jsonData.type == 'success') { 
				var section = $('#users_list_group > li[data-id="' + dataid + '"]');
				section.remove();
				var count_perm = $('#users_count_list');
				var count_perm_count = $('#users_count_list').data('id');
				count_perm.text(count_perm_count + 1);
				$('#users_count_list').data('id', count_perm_count + 1);
				var newLi = $('<li>', {
                'class': 'border-top-0',
                'data-id': jsonData.dataid,
                'html': '<div class="row d-flex align-items-center">' +
                            '<div class="col-9 passive-link">' +
                                '<div class="package-name d-inline-block ml-6 label-for-edit" data-label="' + jsonData.dataid + '">' +
									'<h6 class="mb-0">' + 
                                    '<a href="' + site_domain + '/user/' + value + '" class="d-flex justify-content-left align-items-center lh-1 text-reset p-0" style="text-decoration: none;">' + 
										'<img src="' + avatar + '" style="border-radius: 5px; width: 40px;" />' + 
										'<div class="d-none d-xl-block ps-2">' + 
											'<div>' + username + '</div>' + 
											'<div class="mt-1 small text-muted" style=""></div>' + 
										'</div>' + 
									'</a>' + 
									'</h6>' + 
                                '</div>' +
                            '</div>' +
                            '<div class="col-3 text-right d-flex align-items-center justify-content-end">' +
								'<a href="#" width="16" height="16" data-id="' + jsonData.dataid + '" class="btn-a mr-2 erase-perm-group-new"><i class="fa-regular fa-circle-xmark"></i></a>' +
                            '</div>' +
                        '</div>'
				});
				$('#users_list_group').prepend(newLi);
			} 
			if (jsonData.type != 'success') { 
				swal(jsonData.title, jsonData.subtitle, jsonData.type); 
			}
		});
		
	});
	
	$(document).on('click', '.erase-user-group-new', function(e) {
		e.preventDefault();
		var dataid = $(this).data('id');
		$.post(site_domain + '/execute/action.php', { result: 'erase_user', dataid: dataid }, 
		function(response) { 
			var jsonData = JSON.parse(response); 
			if (jsonData.type == 'success') { 
				var count_perm = $('#users_count_list');
				var count_perm_count = $('#users_count_list').data('id');
				count_perm.text(count_perm_count - 1);
				$('#users_count_list').data('id', count_perm_count - 1);
				var section = $('#users_list_group > li[data-id="' + dataid + '"]');
				section.remove();
			}
			if (jsonData.type != 'success') { 
				swal(jsonData.title, jsonData.subtitle, jsonData.type); 
			}
		});
	});
	
	$(document).on('click', '.erase-user-group', function(e) {
		e.preventDefault();
		var dataid = $(this).data('id');
		var uniqueId = generateUniqueId();
		var section = $('#users_list_group > li[data-id="' + dataid + '"]');
		var section_count = $('#users_list_group > li');
		section.remove();
		var liCount = section_count.length -1;
		if (liCount === 0) {
			var newLi = $('<li>', {
					'class': 'border-top-0',
					'data-id': ':id:',
					'html': '<h5>No results found.</h5>'
			});
			$('#users_list_group').prepend(newLi);
		}
	});
	
	$(document).on('input', '.client_adds', function() {
		var result = 'sub_search_client_add';
		var query = $(this).val();
		var clientResultsAdd = $(this).siblings('.search-results');

		if (query.length >= 1) {
			$.ajax({
				url: site_domain + '/execute/table.php',
				type: 'POST',
				data: { result: result, query: query },
				dataType: 'json',
				success: function(data) {
					displayResultsAdd(data, clientResultsAdd);
					clientResultsAdd.show();
				},
				error: function(error) {
					console.error('Error:', error);
				}
			});
		} else {
			clientResultsAdd.hide();
		}
	});

	function displayResultsAdd(results, resultList) {
		resultList.empty();

		$.each(results, function(index, result) {
			var listItem = $('<li>').text(result.name).data('id', result.id).data('avatar', result.avatar);
			resultList.append(listItem);
		});
	}

	$(document).on('click', '#clientResultsAdd li', function() {
		var selectedName = $(this).text();
		var selectedId = $(this).data('id');
		var selectedAvatar = $(this).data('avatar');
		var uniqueId = $(this).closest('.row').find('.client_adds').attr('id').replace('new_user_', ''); 
		var inputField = $(this).closest('.row').find('.client_adds');
		var inputFieldName = $(this).closest('.row').find('#new_user_name_' + uniqueId);
		var inputFieldAvatar = $(this).closest('.row').find('#new_user_avatar_' + uniqueId); 

		inputField.val(selectedId);
		inputFieldName.val(selectedName);
		inputFieldAvatar.val(selectedAvatar);

		$(this).parent().empty().hide();
	});


	
	// ==================================== USER ACTIONS ==================================== //
	// ==================================== USER ACTIONS ==================================== //
	// ==================================== USER ACTIONS ==================================== //
	// ==================================== USER ACTIONS ==================================== //
	// ==================================== USER ACTIONS ==================================== //
	// ==================================== USER ACTIONS ==================================== //
	// ==================================== USER ACTIONS ==================================== //
	// ==================================== USER ACTIONS ==================================== //
	// ==================================== USER ACTIONS ==================================== //
	// ==================================== USER ACTIONS ==================================== //
	
	$('#save_edit_account').on('click', function(e) {
		e.preventDefault();
		updateElementData();
        $('#edit_account').submit();
    });
	$('#edit_account').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serializeArray();
		
		$.ajax({
			type: "POST",
			url: site_domain + '/execute/action.php',
			data: formData,
			success: function(response) {
				var jsonData = JSON.parse(response);
				if (jsonData.type === 'success') {
					history.back(-1);
				}
				swal(jsonData.title, jsonData.subtitle, jsonData.type);
			}
		});
	});
	window.userCall = function() {
        var result = 'user';
        var total = totalList.val();
        var search = searchBox.val();
        var page = pageIn.val();
        var options = optionIn.val();

        $.post(site_domain + '/execute/table.php', { result: result, total: total, search: search, pag: page, options : options },
            function(response) {
                $(function () { $('[data-toggle="tooltip"]').tooltip() })
	
                $('#load_index_result').html(response);
            }
        );
    }
	
	window.userHistoryCall = function() {
        var result = 'user_ip_history';
        var total = totalList.val();
        var search = searchBox.val();
        var page = pageIn.val();
        var options = optionIn.val();
        var userId = $('#userId').val();

        $.post(site_domain + '/execute/table.php', { result: result, total: total, search: search, pag: page, options : options, user: userId },
            function(response) {
                $(function () { $('[data-toggle="tooltip"]').tooltip() })
	
                $('#load_ip_history_list').html(response);
            }
        );
    }
	
	// ==================================== PRODUCT ACTIONS ==================================== //
	// ==================================== PRODUCT ACTIONS ==================================== //
	// ==================================== PRODUCT ACTIONS ==================================== //
	// ==================================== PRODUCT ACTIONS ==================================== //
	// ==================================== PRODUCT ACTIONS ==================================== //
	// ==================================== PRODUCT ACTIONS ==================================== //
	// ==================================== PRODUCT ACTIONS ==================================== //
	// ==================================== PRODUCT ACTIONS ==================================== //
	// ==================================== PRODUCT ACTIONS ==================================== //
	// ==================================== PRODUCT ACTIONS ==================================== //
	
	$('.cancel_update').on('click', function(e) {
		e.preventDefault();
		$('.create_update').html('<i class="fa fa-file-arrow-up"></i> <b>Update</b>');
		$('.form_update').attr('hidden', true);
		$('.cancel_update').attr('hidden', true);
	});
	$('.create_update').on('click', function(e) {
		e.preventDefault();
		if (!$('.form_update').is(':visible')) {
			$('.create_update').html('<i class="fa fa-check"></i> <b>Save</b>');
			$('.form_update').removeAttr('hidden');
			$('.cancel_update').removeAttr('hidden');
			let options = {
				selector: '#new_message',
				plugins: [
				  'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
				  'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
				  'media', 'table', 'emoticons', 'template', 'help'
				],
				toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
				  'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
				  'forecolor backcolor emoticons | help',
				menu: {
				  favs: { title: 'DevByBit', items: 'code visualaid | searchreplace | emoticons' }
				},
				menubar: 'favs file edit view insert format tools table help',
				height: '350px',
				toolbar_sticky: true,
				icons: 'thin',
				autosave_restore_when_empty: true,
				images_upload_url: site_domain + '/execute/upload.php',
				automatic_uploads: true,
				images_file_types: 'png,jpg,svg,webp',
				content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
			}
			if ($('html').attr('data-bs-theme') === 'dark') {
			  options.skin = 'oxide-dark';
			  options.content_css = 'dark';
			}
			tinyMCE.init(options);
		} else {
			$('.form_update').submit();
			$('#form_update').addClass('loading');
			$('#loaders').css('display', 'block');
		}
	});
	
	$('.form_update').submit(function(e) {
		e.preventDefault();
		var content = tinymce.get('new_message').getContent();
		$('#new_message_hidden').val(content);
		var formData = new FormData($(this)[0]);
		$.ajax({
			type: "POST",
			url: site_domain + '/execute/action.php',
			data: formData,
			contentType: false,
			processData: false,
			success: function(response) {
				var jsonData = JSON.parse(response);
				if (jsonData.type == 'success') {
					$('.create_update').html('<i class="fa fa-file-arrow-up"></i> <b>Update</b>');
					$('.form_update').attr('hidden', true);
					location.reload();
				}
				swal(jsonData.title, jsonData.subtitle, jsonData.type);
				$('#form_update').removeClass('loading');
				$('#loaders').css('display', 'none');
			}
		});
	});
	
	var productActionsCookie = getCookies('product_actions');

	var productActions = productActionsCookie ? JSON.parse(productActionsCookie) : {
		"file_download": [],
		"license": [],
		"group": []
	};
	

	window.updateData = function(data) {
		var newData = JSON.parse(data);
		Object.keys(newData).forEach(function(key) {
			productActions[key] = newData[key];
		});
	}
	
	
	window.countActionsArray = function() {
		$('#quantFiles').text(productActions.file_download.length);
		$('#quantKeys').text(productActions.license.length);
		$('#quantChecked').text(productActions.group.length);
		
		productActions.file_download.forEach(function(file) {
			var newLi = $('<li>', {
				'class': 'border-top-0',
				'data-id': file.id,
				'html': '<div class="row d-flex align-items-center">' +
						'<div class="col-9 passive-link">' +
						'<i class="fa fa-circle-half-stroke p-2 d-inline-block"></i>' +
						'<div class="package-name d-inline-block ml-6">' +
						'<h6 class="mb-0">' + file.name + '</h6>' + 
						'</div>' +
						'</div>' +
						'<div class="col-3 text-right d-flex align-items-center justify-content-end">' +
						'<a href="#" width="16" height="16" class="btn-a mr-2" id="del_file" data-id="' + file.id + '"><i class="fa fa-xmark"></i></a>' +
						'</div>' +
						'</div>'
			});
			$('#file_uploaded').append(newLi);
		});
		
    productActions.license.forEach(function(licenseData) {
        var licenseSection = $('<section>', {
            'class': 'article mb-2',
            'data-id': licenseData.id
        });

        var sectionContent = '<div class="article-header"><div class="d-flex justify-content-between align-items-lg-center"><h3>Configuration for license generation #' + licenseData.id + '</h3><span><a href="#" class="btn-a" id="preview-erase" data-id="' + licenseData.id + '"><i class="fa fa-xmark"></i></a><a href="#" class="btn-a" id="preview-list" data-id="' + licenseData.id + '"><i class="fa fa-chevron-down"></i></a></span></div></div>' +
            '<div class="article-body" data-id="' + licenseData.id + '" style="display: none;"><div class="mb-3"><div class="row d-flex align-items-center"><div class="col-md-6 col-sm-12 mb-3">' +
            '<label for="ips" class="d-flex justify-content-between align-items-lg-center mb-2"><span>IP Cap</span> <span><i class="text-primary fa fa-question-circle" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="License overuse limiter, Limiting up to * ips in the license."></i> </span></label><input type="number" class="form-control" placeholder="5" value="' + licenseData.ips + '" id="ips" name="ips"></div>' +
            '<div class="col-md-6 col-sm-12 mb-3"><label for="expire" class="d-flex justify-content-between align-items-lg-center mb-2"><span>Expiration <a href="#" class="expire_time_text' + licenseData.id + '" data-id="' + licenseData.id + '">' + licenseData.expire_time + '</a></span> <div role="group"><a href="#" width="16" height="16" class="" data-bs-toggle="dropdown" aria-expanded="false"><i class="text-warning fa fa-gear"></i></a><div class="dropdown-menu"><a href="#" class="dropdown-item change-time-expire" data-id="' + licenseData.id + '" data-type="Seconds">Seconds</a><a href="#" class="dropdown-item change-time-expire" data-id="' + licenseData.id + '" data-type="Minutes">Minutes</a><a href="#" class="dropdown-item change-time-expire" data-id="' + licenseData.id + '" data-type="Hours">Hours</a><a href="#" class="dropdown-item change-time-expire" data-id="' + licenseData.id + '" data-type="Days">Days</a><a href="#" class="dropdown-item change-time-expire" data-id="' + licenseData.id + '" data-type="Months">Months</a><a href="#" class="dropdown-item change-time-expire" data-id="' + licenseData.id + '" data-type="Years">Years</a><a href="#" class="dropdown-item change-time-expire" data-id="' + licenseData.id + '" data-type="Never">Never</a></div></div></label>' +
            '<div class="input-group"><button type="button" style="border-radius: 3px 0px 0px 3px;"><i class="fa fa-calendar"></i></button><input type="text" hidden value="' + licenseData.expire_time + '" id="expire_time' + licenseData.id + '" name="expire_time" data-id="' + licenseData.id + '"><input type="number" class="form-control" value="' + licenseData.expire + '" autocomplete="expiration" style="border-radius: 0px 3px 3px 0px !important;" placeholder="Expiration" id="expire" name="expire"></div></div></div></div>' +
            '<div class="mb-3">' +
            '<div class="row d-flex align-items-center"><div class="col-md-8"><label for="addons" class="mb-2">Custom Addons</label></div><div class="col-md-4" align="right">Addons <span id="quantAddons' + licenseData.id + '">0</span> of <span id="maxQuantAddons">5</span></div>' +
            '</div><section class="custom-addons"></section><div class="custom-addons-add"><i class="fa fa-plus" style="margin-right: 7px;"></i> Custom Addons</div></div>' +
            '<div class="mb-3">' +
            '<label for="addons" class="mb-2">Addons</label>' +
            '<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="bound" name="bound" type="checkbox" value="1" ' + (licenseData.checkboxes.bound ? 'checked' : '') + ' /><label class="cbx" for="bound"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Only accept the type of product placed. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="If you try to use the license with another product, This action will not accept that request."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' +
            '<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="ip_log" name="ip_log" type="checkbox" value="1" ' + (licenseData.checkboxes.ip_log ? 'checked' : '') + ' /><label class="cbx" for="ip_log"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Obtain and save the IP\'s that use this license.</span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' +
            '<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="logs" name="logs" type="checkbox" value="1" ' + (licenseData.checkboxes.logs ? 'checked' : '') + ' /><label class="cbx" for="logs"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Save any type of logs. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="IP log does not count in this option."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' +
			'<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="delete_ips" name="delete_ips" type="checkbox" value="1" ' + (licenseData.checkboxes.delete_ips ? 'checked' : '') + ' /><label class="cbx" for="delete_ips"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Delete the IPs used every so often after making another request. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="It will delete all the IPs used and that an exact time has passed since their last use."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' +
			'<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="limit" name="limit" type="checkbox" value="1" ' + (licenseData.checkboxes.limit ? 'checked' : '') + ' /><label class="cbx" for="limit"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Set frozen status if the license has 100 requests in 1 hour. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="When the license has more than 100 requests in less than 1 hour, freeze it for 1 day. This could help you maintain very high security. It is recommended if the requests are not made by the server."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' +
			'<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="product_verify" name="product_verify" type="checkbox" value="1" ' + (licenseData.checkboxes.product_verify ? 'checked' : '') + ' /><label class="cbx" for="product_verify"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>The product has to be in the products category. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="If you activate this, if the product is not found in the product category, it will automatically deny the requests. Unless it exists. With this you will also get the latest version of the product in case you want to make an update message."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' +
			'<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="require_version" name="require_version" type="checkbox" value="1" ' + (licenseData.checkboxes.require_version ? 'checked' : '') + ' /><label class="cbx" for="require_version"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>The version of the request must be the same as that of the mandatory product. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="If you want to make the key require that the version of the request be the same as the current version of the product, you can enable this option."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' +
			'<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="expire_erase" name="expire_erase" type="checkbox" value="1" ' + (licenseData.checkboxes.expire_erase ? 'checked' : '') + ' /><label class="cbx" for="expire_erase"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Delete the key if it is expired.</span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' +
			'<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="send_discord" name="send_discord" type="checkbox" value="1" ' + (licenseData.checkboxes.send_discord ? 'checked' : '') + ' /><label class="cbx" for="send_discord"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Send message to the client\'s private message on discord. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="For this function, the bot token, secret key and client id must be configured. By activating this function, it may take 1-5 seconds for creation."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' +
			'<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="send_webhook" name="send_webhook" type="checkbox" value="1" ' + (licenseData.checkboxes.send_webhook ? 'checked' : '') + ' checked /><label class="cbx" for="send_webhook"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Send a message to the discord webhook, When creating the license. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="It is necessary to have configured the webhook url for this function to work."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' +
            '</div></div>';

        licenseSection.html(sectionContent);

        $('.article_list').append(licenseSection);

		if (licenseData.custom_addons && licenseData.custom_addons.length > 0) {
			var customAddonsContainer = licenseSection.find('.custom-addons');
			licenseData.custom_addons.forEach(function(addonName) {
				var escapedAddonName = $('<div>').text(addonName.val).html(); 
				var newAddonInput = $('<div>', {
					'class': 'input-container',
					'data-id': addonName.id,
					'html': '<input type="text" class="form-control input-with-icon" data-id="' + addonName.id + '" placeholder="Name of the addons." name="newAddons' + addonName.id + '" id="newAddons' + addonName.id + '" value="' + escapedAddonName + '"><div class="icon-input"><i class="divcloser bi opacity-50 theme-icon fa-regular fa-circle-xmark fa-flip-both" data-id="' + addonName.id + '" data-type="' + addonName.type + '" aria-hidden="true"></i></div>'
				});
				customAddonsContainer.append(newAddonInput);
			});
			$('#quantAddons' + licenseData.id).text(licenseData.custom_addons.length);
		}
    });
	}
	
	$('.group-checkbox').on('change', function() {
		var checkedId = $(this).data('id');
		
		if (addons_cache == 0) {
			productActions.group = [];
		}
		
		if (this.checked) {
			productActions.group.push({ "id": checkedId });
		} else {
			productActions.group = productActions.group.filter(function(item) {
				return item.id !== checkedId;
			});
		}
		if (addons_cache == 0) {
			$('.group-checkbox').not(this).prop('checked', false);
		}
		
		var count = productActions.group.length;
		var newDataJson = JSON.stringify(productActions);
		$('#quantChecked').text(count);
		setPermanentCookie('product_actions', newDataJson);
	});
    
	$('.article_list').on('click', '.change-time-expire', function(e) {
		e.preventDefault();
		var dataId = $(this).data('id');
		var dataType = $(this).data('type');
		$('#expire_time' + dataId).val(dataType);
		$('.expire_time_text' + dataId).text(dataType);
		updateProductActions();
	});
	
	$('.add_more_license').on('click', function(e) {
		e.preventDefault();
		var section = $('.article_list');
		var section_count = $('.article_list > section');

		var remainingLiCount = section_count.length;
		if (remainingLiCount >= 1 && addons_cache == 0) {
			swal('You have reached the limit.', 'Acquire the Unlimited addon for your software!', 'error');
			return;
		}
		$.post(site_domain + '/execute/table.php', { result: 'keys_list_actions' },
		function(response) {
			$(function () { $('[data-toggle="tooltip"]').tooltip() })
			section.prepend(response);
			updateProductActions(); 
		});
		$('#quantKeys').text(remainingLiCount + 1);
	});

	$(document).on('click', '#preview-erase', function(e) {
		e.preventDefault();
		var dataId = $(this).data('id');
		var section = $('.article_list > section[data-id="' + dataId + '"]');
		var index = section.index();
		var section_count = $('.article_list > section');
		var remainingLiCount = section_count.length - 1;
		$('#quantKeys').text(remainingLiCount);
		productActions.license = productActions.license.filter(function(item) {
			return item.id !== dataId;
		});
		if (index in productActions) {
			delete productActions[index];
		}
		section.remove();
		updateProductActions();
	});

	function updateProductActions() {
		productActions.license = [];

		$('.article_list > section').each(function(index) {
			var dataId = $(this).data('id');
			var section = $(this);

			var ips = section.find('input[id="ips"]').val();
			var expire = section.find('input[id="expire"]').val();
			var expire_time = section.find('input[id="expire_time' + dataId + '"]').val();

			var checkboxes = {};
			section.find('input[type="checkbox"]').each(function() {
				checkboxes[$(this).attr('id')] = $(this).prop('checked') ? 1 : 0;
			});

			var customAddons = [];
			section.find('.custom-addons > div').each(function() {
				var customAddonName = $(this).find('input[type="text"]').val();
				var customAddonId = $(this).find('input[type="text"]').data('id');
				customAddons.push({"id": customAddonId, "val": customAddonName, "type": dataId});
			});

			var sectionData = {
				"id": dataId,
				"expire_time": expire_time,
				"ips": ips,
				"expire": expire,
				"checkboxes": checkboxes,
				"custom_addons": customAddons 
			};

			productActions.license.push(sectionData);
		});

		var productActionsJSON = JSON.stringify(productActions);
		setPermanentCookie('product_actions', productActionsJSON);
	}


$('.article_list').on('click', '.custom-addons-add', function(e) {
    e.preventDefault();
    var dataId = $(this).closest('.article').data('id');
    var section = $('section[data-id="' + dataId + '"]');
    var customAddonsContainer = section.find('.custom-addons');
    var customAddonCount = customAddonsContainer.find('.input-container').length;

    var remainingLiCount = customAddonCount + 1;
    if (remainingLiCount > 5 && addons_cache == 0) {
        swal('You have reached the limit.', 'Acquire the Unlimited addon for your software!', 'error');
        return;
    }
	
	var dataIdGen = generateUniqueId();

    var newBox = $('<div>', {
        'class': 'input-container',
        'data-id': dataIdGen,
        'html': '<input type="text" class="form-control input-with-icon" placeholder="Name of the addons." data-id="' + dataIdGen + '" name="newAddons' + dataIdGen + '" id="newAddons' + dataIdGen + '" value=""><div class="icon-input"><i class="divcloser bi opacity-50 theme-icon fa-regular fa-circle-xmark fa-flip-both" data-id="' + dataIdGen + '" data-type="' + dataId + '" aria-hidden="true"></i></div>'
    });

    customAddonsContainer.append(newBox);
    $('#quantAddons' + dataId).text(remainingLiCount);
    updateLicenseData(section);
});

$('.article_list').on('click', '.divcloser', function(e) {
    e.preventDefault();
    var dataSId = $(this).data('id');
    var dataId = $(this).closest('.article').data('id');
    var section = $('section[data-id="' + dataId + '"]');
    var customAddonsContainer = section.find('.custom-addons');
	var customAddonCount = customAddonsContainer.find('.input-container').length;
    
    var customAddonToRemove = $('.input-container[data-id="' + dataSId + '"]');
    customAddonToRemove.remove();
    $('#quantAddons' + dataId).text(customAddonCount - 1);
    updateLicenseData(section);
});

function updateLicenseData(section) {
    var customAddonsContainer = section.find('.custom-addons');
    var addonsData = [];

    customAddonsContainer.find('.input-container').each(function(index) {
        var input = $(this).find('input[type="text"]');
        if (input) {
            addonsData.push(input.val());
        }
    });

    updateProductActions();
}






	$(document).on('click', '#preview-list', function(e) {
		e.preventDefault();
		var dataId = $(this).data('id');

		var preview_list = $('.article-body[data-id="' + dataId + '"]');
		preview_list.toggle();

		if (preview_list.is(':visible')) {
			$(this).html('<i class="fa fa-chevron-up"></i>');
		} else {
			$(this).html('<i class="fa fa-chevron-down"></i>');
		}
	});
	
	
	$('.file_tab').on('click', function() {
		$(this).addClass('active');
		$('.license_tab').removeClass('active');
		$('.group_tab').removeClass('active');
		
		$('.file_tabview').removeAttr('hidden');
		$('.license_tabview').attr('hidden', true);
		$('.group_tabview').attr('hidden', true);
	});
	
	$('.license_tab').on('click', function() {
		$(this).addClass('active');
		$('.file_tab').removeClass('active');
		$('.group_tab').removeClass('active');
		
		$('.license_tabview').removeAttr('hidden');
		$('.file_tabview').attr('hidden', true);
		$('.group_tabview').attr('hidden', true);
	});
	
	$('.group_tab').on('click', function() {
		$(this).addClass('active');
		$('.license_tab').removeClass('active');
		$('.file_tab').removeClass('active');
		
		$('.group_tabview').removeAttr('hidden');
		$('.file_tabview').attr('hidden', true);
		$('.license_tabview').attr('hidden', true);
	});
	
	$('.add_more_files').on('click', function() {
		var section_count = $('#file_uploaded > li');
		var remainingLiCount = section_count.length;
		if (remainingLiCount >= 1 && addons_cache == 0) {
			swal('You have reached the limit.', 'Acquire the Unlimited addon for your software!', 'error');
			return;
		}
		$('#file_upload').click();
	});
	
	window.fileSelected = function(input) {
		var file = input.files[0];
		if (file) {
			fileUpload(file);
			var section_count = $('#file_uploaded > li');
			var remainingLiCount = section_count.length;
			$('#quantFiles').text(remainingLiCount + 1);
			$('.add_more_files').html('<i class="fa-brands fa-cloudscale fa-spin"></i>');
			$('.add_more_files').prop('disabled', true);
		}
	}

	window.fileUpload = function(file) {
		var formData = new FormData();
		formData.append('file', file);
		formData.append('result', 'file_upload');

		$.ajax({
			url: site_domain + '/execute/action.php',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				var jsonData = JSON.parse(response);
				if (jsonData.type == 'success') {
					var newFileDownload = {
						"id": jsonData.unique_name,
						"name": jsonData.name,
						"path": jsonData.path,
						"size": jsonData.size
					};
					productActions.file_download.push(newFileDownload);
					var newDataJson = JSON.stringify(productActions);

					var newLi = $('<li>', {
							'class': 'border-top-0',
							'data-id': jsonData.unique_name,
							'html': '<div class="row d-flex align-items-center">' +
										'<div class="col-9 passive-link">' +
											'<i class="fa fa-circle-half-stroke p-2 d-inline-block"></i>' +
											'<div class="package-name d-inline-block ml-6">' +
												'<h6 class="mb-0">' + jsonData.name + '</h6>' + 
											'</div>' +
										'</div>' +
										'<div class="col-3 text-right d-flex align-items-center justify-content-end">' +
											'<a href="#" width="16" height="16" class="btn-a mr-2" id="del_file" data-id="' + jsonData.unique_name + '"><i class="fa fa-xmark"></i></a>' +
										'</div>' +
									'</div>'
					});
					setPermanentCookie('product_actions', newDataJson);

					$('#file_uploaded').append(newLi);
				} else {
					swal(jsonData.title, jsonData.subtitle, jsonData.type);
				}
				$('.add_more_files').html('<i class="fa fa-plus" style="margin-right: 7px;"></i> Upload new file');
				$('.add_more_files').prop('disabled', false);
			},
			error: function(xhr, status, error) {
				console.error('Error:', error);
			}
		});
	}
	
	window.deleteFileFromDownload = function(id) {
		for (var i = 0; i < productActions.file_download.length; i++) {
			if (productActions.file_download[i].id === id) {
				productActions.file_download.splice(i, 1);
				break; 
			}
		}
	}

	$('#file_uploaded').on('click', '#del_file', function(e) {
		e.preventDefault();
		var result = 'erase_file_uploaded';
		var unique = $(this).data('id');
		
		$.post(site_domain + '/execute/action.php', { result: result, unique: unique },function(response) {
			var jsonData = JSON.parse(response);
			if (jsonData.type == 'success') {
				var section_count = $('#file_uploaded > li');
				var remainingLiCount = section_count.length;
				var box = $('#file_uploaded > li[data-id="' + unique + '"]');
				box.remove();
				$('#quantFiles').text(remainingLiCount - 1);
				deleteFileFromDownload(unique);
				var newDataJson = JSON.stringify(productActions);

				setPermanentCookie('product_actions', newDataJson);
			} else {
				swal(jsonData.title, jsonData.subtitle, jsonData.type);
			}
		});
	});
	
	window.productCall = function() {
        var result = 'product';
        var total = totalList.val();
        var search = searchBox.val();
        var page = pageIn.val();
        var options = optionIn.val();
		
		var icon = $('.icon_select');
        var results = getCookie('column_product_selected');

        $.post(site_domain + '/execute/table.php', { result: result, total: total, search: search, pag: page, options : options },
            function(response) {
                $(function () { $('[data-toggle="tooltip"]').tooltip() })
				$(document).ready(function() {
					/* ERASE LICENSE JS */
					$('.product').on('click', '.erase', function(e) {
						e.preventDefault();
						
						var dataId = $(this).closest('.erase').data('id');
						
						swal({
							title: langSystem_erase_secure_title,
							text: langSystem_erase_secure_subtitle,
							showCancelButton: true,
							showLoaderOnConfirm: true,
							confirmButtonText: langSystem_erase_secure_button,
							type: langSystem_erase_secure_type,
						}).then(() => {
							var result = 'erase_product';
							$.post( site_domain + '/execute/action.php', { result : result, data_id : dataId }, function( response ) {
								var jsonData = JSON.parse(response);
								if (jsonData.type == 'success') {
									productCall();
								}
								swal(jsonData.title, jsonData.subtitle, jsonData.type);
							});
						});

					});
					
					/* CLONE PRODUCT JS */
					$('.product').on('click', '.productClonation', function(e) {
						e.preventDefault();
						var dataId = $(this).closest('.productClonation').data('id');
						swal({
							title: langSystem_clone_secure_title,
							text: langSystem_clone_secure_subtitle,
							showCancelButton: true,
							showLoaderOnConfirm: true,
							confirmButtonText: langSystem_clone_secure_button,
							type: langSystem_clone_secure_type,
						}).then(() => {
							var result = 'clonProduct';
							$.post( site_domain + '/execute/action.php', { result : result, data_id : dataId }, function( response ) {
								var jsonData = JSON.parse(response);
								if (jsonData.type == 'success') {
									location.href = site_domain + '/product/' + jsonData.id;
								}
								swal(jsonData.title, jsonData.subtitle, jsonData.type);
							});
						});
					});
					
					$('.add_to_cart').on('click', function() {
						var dataId = $(this).data('id');
						var result = 'add_to_cart';
						$.post(site_domain + '/execute/action.php', { result: result, data_id: dataId }, function(response) {
							removeCaches('basket.html');
							var jsonData = JSON.parse(response);
							swal(jsonData.title, jsonData.subtitle, jsonData.type);
						});
					});
				});
	
                $('#load_index_result').html(response);
            }
        );
    }
	
	
	var productResults = $('#productResults');
	$('#product').on('input', function() {
		var result = 'sub_search_product';
		var query = $(this).val();

		if (query.length >= 2) {
		  $.ajax({
			url: site_domain + '/execute/table.php',
			type: 'POST',
			data: { result: result, query: query },
			dataType: 'json',
			success: function(data) {
			  productResult(data);
			  productResults.show();
			},
			error: function(error) {
			  console.error('Error:', error);
			}
		  });
		} else {
			productResults.hide();
		}
	});
	$(document).on('click', function(e) {
		if (!productResults.is(e.target) && productResults.has(e.target).length === 0) {
		  productResults.hide();
		}
	});

	$('#productResults').on('click', 'li', function() {
		var selectedName = $(this).text();
		var selectedUdid = $(this).data('id');

		$('#product').val(selectedUdid);

		$('#productResults').empty();
	});


	function productResult(results) {
		var resultList = $('#productResults');
		resultList.empty();

		$.each(results, function(index, result) {
		  var listItem = $('<li>').text(result.name).data('id', result.id);
		  resultList.append(listItem);
		});
	}
	// PRODUCT ACTIONS
	$('.submit_product_create').on('click', function() {
		$('#productCreate').submit();
	});
	$('.product_create').submit(function(e) {
		e.preventDefault();
		updateProductActions();
		$.ajax({
			type: "POST",
			url: site_domain + '/execute/action.php',
			data: $(this).serialize(),
			success: function(response) {
				var jsonData = JSON.parse(response);
				if (jsonData.type === 'success') {
					location.href = site_domain + '/product/' + jsonData.id;
				}
				swal(jsonData.title, jsonData.subtitle, jsonData.type);
			}
		});
	});
	$('#productEdit').submit(function(e) {
		e.preventDefault();
		updateProductActions();
		$.ajax({
			type: "POST",
			url: site_domain + '/execute/action.php',
			data: $(this).serialize(),
			success: function(response) {
				var jsonData = JSON.parse(response);
				if (jsonData.type === 'success') {
					location.href = site_domain + '/product/' + jsonData.id;
				}
				swal(jsonData.title, jsonData.subtitle, jsonData.type);
			}
		});
	});
	
	
	// ==================================== BASKET ACTIONS ==================================== //
	// ==================================== BASKET ACTIONS ==================================== //
	// ==================================== BASKET ACTIONS ==================================== //
	// ==================================== BASKET ACTIONS ==================================== //
	// ==================================== BASKET ACTIONS ==================================== //
	// ==================================== BASKET ACTIONS ==================================== //
	// ==================================== BASKET ACTIONS ==================================== //
	// ==================================== BASKET ACTIONS ==================================== //
	// ==================================== BASKET ACTIONS ==================================== //
	// ==================================== BASKET ACTIONS ==================================== //
	
	window.totalBasket = function() {
		var result = 'total_price_in_basket';
		$.post(site_domain + '/execute/action.php', { result: result },
        function(response) {
			$('#total_price_in_basket').text(response);
		});
	}
	
	$('#create_basket_tebex').on('click', function(e) {
		e.preventDefault();
		var result = 'create_basket_tebex';
		$.post(site_domain + '/execute/action.php', { result: result }, function(response) {
			var jsonData = JSON.parse(response);
			if (jsonData.type == 'success') {
				location.href = jsonData.redirrect;
				removeCache();
			} else {
				swal(jsonData.title, jsonData.subtitle, jsonData.type);
			}
		});
	});
	
	$('#puchase_items').on('click', function(e) {
		e.preventDefault();
		var result = 'go_to_pay';
		$.post(site_domain + '/execute/action.php', { result: result }, function(response) {
			var jsonData = JSON.parse(response);
			if (jsonData.type == 'success') {
				location.href = jsonData.redirrect;
			} else {
				swal(jsonData.title, jsonData.subtitle, jsonData.type);
			}
		});
	});
	
	window.basketCall = function() {
        var result = 'basket';
        var total = totalList.val();
        var search = searchBox.val();
        var page = pageIn.val();
        var options = optionIn.val();

        $.post(site_domain + '/execute/table.php', { result: result, total: total, search: search, pag: page, options : options },
            function(response) {
                $(function () { $('[data-toggle="tooltip"]').tooltip() })
				$(document).ready(function() {
					$('.remove_of_basket').on('click', function(e) {
						e.preventDefault();
						var dataId = $(this).data('id');
						var result = 'remove_of_basket';
						$.post(site_domain + '/execute/action.php', { result: result, data_id: dataId }, function(response) {
							var jsonData = JSON.parse(response);
							basketCall();
							totalBasket();
							swal(jsonData.title, jsonData.subtitle, jsonData.type);
						});
					});
					
					$('.up_quantity_update').on('click', function(e) {
						e.preventDefault();
						var dataId = $(this).data('id');
						var result = 'up_quantity_update';
						$.post(site_domain + '/execute/action.php', { result: result, data_id: dataId }, function(response) {
							var jsonData = JSON.parse(response);
							if (jsonData.type == 'success') {
								$('#quantity_' + dataId).text(jsonData.quantity);
								$('#price_art_' + dataId).text('$' + jsonData.price + ' USD');
								totalBasket();
							} else {
								swal(jsonData.title, jsonData.subtitle, jsonData.type);
							}
						});
					});
					
					$('.down_quantity_update').on('click', function(e) {
						e.preventDefault();
						var dataId = $(this).data('id');
						var result = 'down_quantity_update';
						$.post(site_domain + '/execute/action.php', { result: result, data_id: dataId }, function(response) {
							var jsonData = JSON.parse(response);
							if (jsonData.type == 'success') {
								$('#quantity_' + dataId).text(jsonData.quantity);
								$('#price_art_' + dataId).text('$' + jsonData.price + ' USD');
								totalBasket();
							} else {
								swal(jsonData.title, jsonData.subtitle, jsonData.type);
							}
						});
					});
				});
				
                $('#load_index_result').html(response);
            }
        );
    }
	
	
	// ==================================== LICENSE ACTIONS ==================================== //
	// ==================================== LICENSE ACTIONS ==================================== //
	// ==================================== LICENSE ACTIONS ==================================== //
	// ==================================== LICENSE ACTIONS ==================================== //
	// ==================================== LICENSE ACTIONS ==================================== //
	// ==================================== LICENSE ACTIONS ==================================== //
	// ==================================== LICENSE ACTIONS ==================================== //
	// ==================================== LICENSE ACTIONS ==================================== //
	// ==================================== LICENSE ACTIONS ==================================== //
	// ==================================== LICENSE ACTIONS ==================================== //
	
	window.statusLicense = function(id, type) {
		var result = 'keys_status';
		$.post(site_domain + '/execute/action.php', { result: result, type: type },
        function(response) { $('#' + id).text(response); });
	}
	
	window.licenseCall = function() {
        var result = 'license';
        var total = totalList.val();
        var search = searchBox.val();
        var page = pageIn.val();
        var options = optionIn.val();
        var view_type_list = viewType.val();
		
		var icon = $('.icon_select');
        var results = getCookie('column_license_selected');
		
        $.post(site_domain + '/execute/table.php', { result: result, total: total, search: search, pag: page, options : options, view_type : view_type_list },
            function(response) {
                $(function () { $('[data-toggle="tooltip"]').tooltip() })
				$(document).ready(function() {
					/* ERASE LICENSE JS */
					$('.change_mode_type').on('click', '.user_mode_change', function(e) {
						e.preventDefault();
						viewType.val('user');
						licenseCall();
						setPermanentCookie('view_list_type', 'user');
					});
					$('.change_mode_type').on('click', '.admin_mode_change', function(e) {
						e.preventDefault();
						viewType.val('admin');
						licenseCall();
						setPermanentCookie('view_list_type', 'admin');
					});
					$('.license').on('click', '.erase', function(e) {
						e.preventDefault();
						
						var dataId = $(this).closest('.erase').data('id');
						
						swal({
							title: langSystem_erase_secure_title,
							text: langSystem_erase_secure_subtitle,
							showCancelButton: true,
							showLoaderOnConfirm: true,
							confirmButtonText: langSystem_erase_secure_button,
							type: langSystem_erase_secure_type,
						}).then(() => {
							var result = 'erase_license';
							$.post( site_domain + '/execute/action.php', { result : result, data_id : dataId }, function( response ) {
								var jsonData = JSON.parse(response);
								if (jsonData.type == 'success') {
									licenseCall();
								}
								swal(jsonData.title, jsonData.subtitle, jsonData.type);
							});
						});

					});
					
					/* CLONE LICENSE JS */
					$('.license').on('click', '.licenseClonation', function(e) {
						e.preventDefault();
						
						var dataId = $(this).closest('.licenseClonation').data('id');
						
						swal({
							title: langSystem_clone_secure_title,
							text: langSystem_clone_secure_subtitle,
							showCancelButton: true,
							showLoaderOnConfirm: true,
							confirmButtonText: langSystem_clone_secure_button,
							type: langSystem_clone_secure_type,
						}).then(() => {
							var result = 'clonLicense';
							$.post( site_domain + '/execute/action.php', { result : result, data_id : dataId }, function( response ) {
								var jsonData = JSON.parse(response);
								if (jsonData.type == 'success') {
									swal({
										title: jsonData.title,
										text: jsonData.subtitle,
										showCancelButton: true,
										showLoaderOnConfirm: true,
										confirmButtonText: 'Edit',
										type: jsonData.type,
									}).then(() => {
										location.href = site_domain + '/license/' + jsonData.id;
									});
									licenseCall();
								} else {
									swal(jsonData.title, jsonData.subtitle, jsonData.type);
								}
							});
						});

					});
					/* REFRESH KEY LICENSE JS */
					$('.license').on('click', '.licenseRefreshKey', function(e) {
						e.preventDefault();
						
						var dataId = $(this).closest('.licenseRefreshKey').data('id');
						
						var result = 'refresh_key_license';
						$.post( site_domain + '/execute/action.php', { result : result, data_id : dataId }, function( response ) {
							var jsonData = JSON.parse(response);
							if (jsonData.type == 'success') {
								swal({
									title: jsonData.title,
									text: jsonData.subtitle,
									showCancelButton: true,
									showLoaderOnConfirm: true,
									confirmButtonText: 'Copy',
									type: jsonData.type,
								}).then(() => {
									copyText(jsonData.newkey);
								});
								licenseCall();
							} else {
								swal(jsonData.title, jsonData.subtitle, jsonData.type);
							}
						});

					});
					$('.license').on('click', '.licenseResetIps', function(e) {
						e.preventDefault();
						
						var dataId = $(this).closest('.licenseResetIps').data('id');
						
						var result = 'reset_ips_key_license';
						$.post( site_domain + '/execute/action.php', { result : result, data_id : dataId }, function( response ) {
							var jsonData = JSON.parse(response);
							if (jsonData.type === 'success') {
								licenseCall();
							}
							swal(jsonData.title, jsonData.subtitle, jsonData.type);
						});

					});
					$('.license').on('click', '.licenseResetLogs', function(e) {
						e.preventDefault();
						var dataId = $(this).closest('.licenseResetLogs').data('id');
						
						var result = 'reset_logs_key_license';
						$.post( site_domain + '/execute/action.php', { result : result, license : dataId }, function( response ) {
							var jsonData = JSON.parse(response);
							if (jsonData.type === 'success') {
								licenseCall();
							}
							swal(jsonData.title, jsonData.subtitle, jsonData.type);
						});
					});
					
					/* CLAIMS CODE JS */
					$('.license').on('click', '.claim_gift_addons', function(e) {
						e.preventDefault();
						var dataId = $(this).closest('.claim_gift_addons').data('id');
						
						var miModal = $('#reclaimCodeGiftAddons');
						var modal = new bootstrap.Modal(miModal);
						modal.show();
						$('#license_id').val(dataId);
					});
					$('#reclaim_addons_for_license').on('click', '#place_claim', function(e) {
						e.preventDefault();
						var license_id = $('#license_id').val();
						var gift_code = $('#code_gift').val();
						var result = 'reclaim_my_gift_addons';
						$.post( site_domain + '/execute/action.php', { result : result, license : license_id, code: gift_code }, function( response ) {
							var jsonData = JSON.parse(response);
							if (jsonData.type === 'success') {
								licenseCall();
							}
							swal(jsonData.title, jsonData.subtitle, jsonData.type);
						});
						
					});
					$('#reclaim_my_gift_license').on('click', '#place_claim_license', function(e) {
						e.preventDefault();
						var gift_code = $('#gift').val();
						var result = 'reclaim_my_gift_license';
						$.post( site_domain + '/execute/action.php', { result : result, code: gift_code }, function( response ) {
							var jsonData = JSON.parse(response);
							if (jsonData.type === 'success') {
								licenseCall();
							}
							swal(jsonData.title, jsonData.subtitle, jsonData.type);
						});
						
					});
				});
	
                $('#load_index_result').html(response);
            }
        );
    }
	var elementsData = {};
	$('.create_license_btn').on('click', function(e) {
		e.preventDefault();
		updateElementData();
        $('#create_license_key').submit();
    });
	$('#create_license_key').submit(function(e) {
        e.preventDefault();
		
		var section_count = $('.custom-addons > div');
		var remainingLiCount = section_count.length;
		if (remainingLiCount == 0) {
			elementsData = {};
			
		}
		
        var formData = $(this).serializeArray();

        formData.push(
            {
                name: 'custom_addons', 
                value: JSON.stringify(elementsData)
            }, {
                name: 'quant_addons', 
                value: remainingLiCount
            }
        );
		
		$.ajax({
			type: "POST",
			url: site_domain + '/execute/action.php',
			data: formData,
			success: function(response) {
				var jsonData = JSON.parse(response);
				if (jsonData.type === 'success' && jsonData.back === 1) {
					history.back(-1);
				}
				swal(jsonData.title, jsonData.subtitle, jsonData.type);
				verifyExistKey();
			updateElementData();
			}
		});
	});
	var key_license = $('#key');
    key_license.change(function() { verifyExistKey(); });
    key_license.on('input', function() { verifyExistKey(); });
	
	window.verifyExistKey = function() {
        var result = 'verify_exist_key';
        var key = key_license.val();
        $.post(site_domain + '/execute/action.php', { result: result, key: key },
            function(response) {
				var jsonData = JSON.parse(response);
				if (jsonData.type === 'exist') {
					$('.create_license_btn').html('Save <i class="fa fa-check"></i>');
					$('.key_exist_alert').removeAttr('hidden');
				} else {
					$('.create_license_btn').html('Create <i class="fa fa-plus"></i>');
					$('.key_exist_alert').attr('hidden', true);
				}
            }
        );
	}
	
	window.changeExpireTime = function(type, message) {
        $('#expire_time').val(type);
        $('.expire_time_text').text(message);
	}
	
	window.viewListOfUser = function(userId) {
        var result = 'user_groups_list';
        $.post(site_domain + '/execute/table.php', { result: result, iduser: userId },
            function(response) {
				$(function () { $('[data-toggle="tooltip"]').tooltip() })
                $('#user_groups_list').html(response);
            }
        );
    }
		
	window.selectClient = function(e) {
        var result = 'select_client_license';
		//var userId = $(e).data('id');
        $.post(site_domain + '/execute/table.php', { result: result },
            function(response) {
				var miModal = $('#selectUserList');
				var modal = new bootstrap.Modal(miModal);
				modal.show();
				$(function () { $('[data-toggle="tooltip"]').tooltip() })
                $('#client_list').html(response);
				updateElementData();
            }
        );
    }
	$('.custom-addons-add').on('click', function(e) {
		e.preventDefault();
		var dataId = $(this).data('id');
		var section = $('.custom-addons');
		var section_count = $('.custom-addons > div');

		var dataIdGen = generateUniqueId();

		var remainingLiCount = section_count.length + 1;
		if (remainingLiCount > 5 && addons_cache == 0) {
			swal('You have reached the limit.', 'Acquire the Unlimited addon for your software!', 'error');
			return;
		}
		var newBox = $('<div>', {
			'class': 'input-container',
			'data-id': dataIdGen,
			'html': '<input type="text" class="form-control input-with-icon" placeholder="" name="newAddons' + remainingLiCount + '" id="newAddons' + remainingLiCount + '" value=""><div class="icon-input"><i class="divclose bi opacity-50 theme-icon fa-regular fa-circle-xmark fa-flip-both" id="token_icon" data-id="' + dataIdGen + '" aria-hidden="true"></i></div>'
		});
		section.prepend(newBox);
		$('#quantAddons').text(remainingLiCount);
		updateElementData();
	});

	$('.custom-addons').on('click', '.divclose', function(e) {
		e.preventDefault();
		var dataId = $(this).data('id');
		var section_count = $('.custom-addons > div');
		var remainingLiCount = section_count.length - 1;
		var box = $('.custom-addons > div[data-id="' + dataId + '"]');
		box.remove();
		$('#quantAddons').text(remainingLiCount);
		var index = section_count.index(box);
		if (index in elementsData) {
			delete elementsData[index];
		}
	});

	function updateElementData() {
		$('.custom-addons .input-container').each(function(index) {
			var input = $(this).find('input[type="text"]');
			if (input) {
				elementsData[index] = {
					addonName: input.val()
				};
			}
		});
	}
	
	var clientResults = $('#clientResults');
	$('#client').on('input', function() {
		var result = 'sub_search_client';
		var query = $(this).val();

		if (query.length >= 2) {
		  $.ajax({
			url: site_domain + '/execute/table.php',
			type: 'POST',
			data: { result: result, query: query },
			dataType: 'json',
			success: function(data) {
			  displayResults(data);
			  clientResults.show();
			},
			error: function(error) {
			  console.error('Error en la solicitud AJAX:', error);
			}
		  });
		} else {
			clientResults.hide();
		}
	});
	$(document).on('click', function(e) {
		if (!clientResults.is(e.target) && clientResults.has(e.target).length === 0) {
		  clientResults.hide();
		}
	});
	$('#clientResults').on('click', 'li', function() {
		var selectedName = $(this).text();
		var selectedUdid = $(this).data('udid');

		$('#client').val(selectedUdid);

		$('#clientResults').empty();
	});

	function displayResults(results) {
		var resultList = $('#clientResults');
		resultList.empty();

		$.each(results, function(index, result) {
		  var listItem = $('<li>').text(result.name).data('udid', result.udid);
		  resultList.append(listItem);
		});
	}
	

	$('.reclaim-code').on('click', function(e) {
		e.preventDefault();
		var miModal = $('#reclaimCodeGift');
		var modal = new bootstrap.Modal(miModal);
		modal.show();
	});
    totalList.change(function() { callByType(window.activeTab); });
    optionIn.change(function() { callByType(window.activeTab); });
    viewType.change(function() { callByType(window.activeTab); });
    searchBox.change(function() { callByType(window.activeTab); });
    searchBox.on('input', function() { callByType(window.activeTab); });


    window.updatePage = function(type, id) {
        $('#paginationID').val(id);
        callByType(type);
    };
	
    window.updateOption = function(event, type, result) {
		event.preventDefault();
		var optionInput = $('#option');
		var icon = $(event.currentTarget).find('.icon_select');
		var hasSuffix = result.includes('#');
		if (optionInput.val() === result) {
			var currentOrder = hasSuffix ? result.split('#')[1] : 'ASC';
			var newOrder = (currentOrder === 'ASC') ? 'DESC' : 'ASC';
			result = result.split('#')[0] + (newOrder === 'ASC' ? '' : '#' + newOrder);
            setPermanentCookie('column_' + type + '_selected_icon', newOrder);
            var columnCookie = getCookie('column_' + type + '_selected');
		}
		setPermanentCookie('column_' + type + '_selected', result);
		optionInput.val(result);
		callByType(type);
	};

    function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length === 2) return parts.pop().split(";").shift();
    }
	
	function getCookies(name) {
		var cookieName = name + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var cookieArray = decodedCookie.split(';');
		for (var i = 0; i < cookieArray.length; i++) {
			var cookie = cookieArray[i].trim();
			if (cookie.indexOf(cookieName) === 0) {
				return cookie.substring(cookieName.length, cookie.length);
			}
		}
		return null;
	}

    function setPermanentCookie(name, value) {
        var d = new Date();
        d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000)); // 365 días
        var expires = "expires=" + d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }
	// download
	
	window.downloadCall = function() {
        var result = 'download';
        var total = totalList.val();
        var search = searchBox.val();
        var page = pageIn.val();
        var options = optionIn.val();
        var view_type_list = viewType.val();
		
		var icon = $('.icon_select');
        var results = getCookie('column_download_selected');
		
        $.post(site_domain + '/execute/table.php', { result: result, total: total, search: search, pag: page, options : options, view_type : view_type_list },
            function(response) {
                $(function () { $('[data-toggle="tooltip"]').tooltip() })
				$(document).ready(function() {
					$('.change_mode_type').on('click', '.user_mode_change', function(e) {
						e.preventDefault();
						viewType.val('user');
						downloadCall();
						setPermanentCookie('view_list_type', 'user');
					});
					$('.change_mode_type').on('click', '.admin_mode_change', function(e) {
						e.preventDefault();
						viewType.val('admin');
						downloadCall();
						setPermanentCookie('view_list_type', 'admin');
					});
				});
					
                $('#load_index_result').html(response);
            }
        );
    }
	
	window.downloadItemsCall = function() {
        var result = 'downloadItems';
        var total = totalList.val();
        var search = searchBox.val();
        var page = pageIn.val();
        var options = optionIn.val();
        var view_type_list = viewType.val();
		
		var icon = $('.icon_select');
        var results = getCookie('column_download_selected');
		
        $.post(site_domain + '/execute/table.php', { result: result, total: total, search: search, pag: page, options : options, view_type : view_type_list },
            function(response) {
                $(function () { $('[data-toggle="tooltip"]').tooltip() })
				$(document).ready(function() {
					$('.change_mode_type').on('click', '.user_mode_change', function(e) {
						e.preventDefault();
						viewType.val('user');
						downloadCall();
						setPermanentCookie('view_list_type', 'user');
					});
					$('.change_mode_type').on('click', '.admin_mode_change', function(e) {
						e.preventDefault();
						viewType.val('admin');
						downloadCall();
						setPermanentCookie('view_list_type', 'admin');
					});
				});
					
                $('#download_list').html(response);
            }
        );
    }
	
	
	$(document).on('click', '.download_files', function(e) {
		var resultv2 = 'generateCodeDownload';
		var result = 'downloadFiles';
		var file = $(this).data('file');
		var secret = $(this).data('secret');
		$.post(site_domain + '/execute/action.php', { result: resultv2 },
            function(response) {
				var jsonData = JSON.parse(response);
				if (jsonData.type == 'success') {
				location.href= site_domain + "/execute/action.php?result=downloadFiles&file=" + file + "&secret=" + secret + "&code=" + jsonData.code;
				}
			}
        );
	});
	
	
	
	$('.createLicenseGift').on('click', function(e) {
		e.preventDefault();
        $('#createLicense').submit();
    });
	$('#createLicense').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serializeArray();
		$.ajax({
			type: "POST",
			url: site_domain + '/execute/action.php',
			data: formData,
			success: function(response) {
				var jsonData = JSON.parse(response);
				if (jsonData.type === 'success') {
					history.back(-1);
				}
				if (jsonData.type != 'success') {
					$('#content').removeClass('loading');
					$('#loader').hide();
				}
				swal(jsonData.title, jsonData.subtitle, jsonData.type);
			}
		});
	});
	
	
	$('.createAddonsGifts').on('click', function(e) {
		e.preventDefault();
		updateElementData();
		console.log(JSON.stringify(elementsData));
        $('#createAddonsGift').submit();
    });
	$('#createAddonsGift').submit(function(e) {
        e.preventDefault();
		
		var section_count = $('.custom-addons > div');
		var remainingLiCount = section_count.length;
		if (remainingLiCount == 0) {
			elementsData = {};
			
		}
		
        var formData = $(this).serializeArray();

        formData.push(
            {
                name: 'custom_addons', 
                value: JSON.stringify(elementsData)
            }
        );
		
		$.ajax({
			type: "POST",
			url: site_domain + '/execute/action.php',
			data: formData,
			success: function(response) {
				var jsonData = JSON.parse(response);
				if (jsonData.type === 'success') {
					history.back(-1);
				}
				if (jsonData.type != 'success') {
					$('#content').removeClass('loading');
					$('#loader').hide();
				}
				swal(jsonData.title, jsonData.subtitle, jsonData.type);
				updateElementData();
			}
		});
	});
	
	
	$('.createRequestCode').on('click', function(e) {
		e.preventDefault();
		updateElementData();
		console.log(JSON.stringify(elementsData));
        $('#createRequest').submit();
    });
	$('#createRequest').submit(function(e) {
        e.preventDefault();
		
		var section_count = $('.custom-addons > div');
		var remainingLiCount = section_count.length;
		if (remainingLiCount == 0) {
			elementsData = {};
		}
		
        var formData = $(this).serializeArray();

        formData.push(
            {
                name: 'custom_addons', 
                value: JSON.stringify(elementsData)
            }
        );
		
		updateElementData();
		$.ajax({
			type: "POST",
			url: site_domain + '/execute/action.php',
			data: formData,
			success: function(response) {
				var jsonData = JSON.parse(response);
				if (jsonData.type === 'success') {
					history.back(-1);
				}
				if (jsonData.type != 'success') {
					$('#content').removeClass('loading');
					$('#loader').hide();
				}
				swal(jsonData.title, jsonData.subtitle, jsonData.type);
			}
		});
	});
	
    function callByType(type) {
        switch (type) {
            case 'license':
                licenseCall();
                break;
            case 'product':
                productCall();
                break;
            case 'user':
                userCall();
                break;
            case 'group':
                groupCall();
                break;
            case 'code':
                codeCall();
                break;
            case 'group_permission':
                groupPermissionCall();
                break;
            case 'group_user':
                groupUserCall();
                break;
            case 'ip_history':
                userHistoryCall();
                break;
            case 'basket':
                basketCall();
                break;
            case 'download':
                downloadCall();
                break;
            case 'downloadItems':
                downloadItemsCall();
                break;
        }
    }
	
	/* VIEW LIST OFGROUPS TO USER */
	
	
	/* USER PROFILE OVERVIEW */
	
	function generateUniqueId() {
        return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
    }

	window.generateNewKey = function(textbox) {
		var licenseDigits = $('#license_digits').val();
		var separatorCount = parseInt($('#license_separator_count').val()) + 1;
		var separator = $('#license_separator').val();
		var quantity = parseInt($('#license_quantity').val());
		var newKey = generateRandomKey(licenseDigits, separatorCount, separator, quantity);
		$('#' + textbox).val(newKey);
	}

	window.generateRandomKey = function(digits, separatorCount, separator, quantity) {
		var key = '';
		for (var i = 0; i < separatorCount; i++) {
			key += randomCodes(quantity, digits);
			if (i < separatorCount - 1) {
				key += separator;
			}
		}
		return key;
	}
	window.randomCodes = function(length, characters) {
		var result = '';
		var charactersLength = characters.length;
		for (var i = 0; i < length; i++) {
			result += characters.charAt(Math.floor(Math.random() * charactersLength));
		}
		return result;
	}
	window.saveDraftKeyConf = function() {
		var licenseDigits = $('#license_digits').val();
		var separatorCount = parseInt($('#license_separator_count').val()) + 1;
		var separator = $('#license_separator').val();
		var quantity = parseInt($('#license_quantity').val());
		setPermanentCookie('license_digits', licenseDigits);
		setPermanentCookie('license_separator_count', separatorCount);
		setPermanentCookie('license_separator', separator);
		setPermanentCookie('license_quantity', quantity);
	}

});


function checkActivity(timeout, interval, elapsed, total) {
	if ($.active) {
		elapsed = 0;
		$.active = false;
	}
	
	if (elapsed < timeout) {
		elapsed += interval;
		setTimeout(function() {
			tokenStatus();
			checkActivity(timeout, interval, elapsed, total);
		}, interval);
	} else {
		setTimeout(function() {
			removeCache();
			location.reload();
			tokenStatus();
			checkActivity(timeout, interval, elapsed, total);
		}, interval);
	}
}
function logoutSession() {
	var result = 'logout';
    $.post( site_domain + '/execute/action.php', { result : result }, function( response ) { location.href = site_domain + '/auth'; });
	removeCache();
}

function tokenStatus() {
	var result = 'token_status';
    $.post( site_domain + '/execute/action.php', { result : result }, function( response ) {});
}
function copyText(text) {
    var input = document.createElement('input');
    input.setAttribute('value', text);
    document.body.appendChild(input);
    input.select();
    var result = document.execCommand('copy');
    document.body.removeChild(input);
	swal('Copied correctly!', '', 'success');
    return result;
}
function copyOther(text) {
    var input = document.getElementById(text);
    input.select();
    var result = document.execCommand('copy');
	swal('Copied correctly!', '', 'success');
    return result;
}