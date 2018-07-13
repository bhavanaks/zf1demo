$(document).ready(function() {
	 
		$('#kedb').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "index/getdata",
			"pageLength": 25,
			"paging": true,
			"columns": [
			{ data: "ticket_number" },
			{ data: "serviceline_name" },
			{ data: "description" },
			{ data: "solution" },
			{ data: "user_id" },
			{ data: "last_updated" },
			{ 
		         "data": "id",
		         "render": function(data, type, row, meta){
		            if(type === 'display'){
		                data = '​ <a href="#"><span class="glyphicon glyphicon-pencil"></span>Edit</a> / <a href="#" ><span class="glyphicon glyphicon-trash">Delete</span></a>';
		                
		            }
		            
		            return data;
		         }
		      } 
		] 
		} );
	} );

	$( function() {
    var dialog, form,
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      ticket = $( "#entry_ticket_number" ),
      serviceline_name = $( "#entry_serviceline_name" ),
      //allFields = $( [] ).add( ticket ).add( email ).add( password ),
	  allFields = $( [] ).add( ticket ).add( serviceline_name ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }

    function addUser() {
		var valid = true;
		allFields.removeClass( "ui-state-error" );
		var formData = JSON.stringify( $(form).serializeArray() );
		
		$.ajax({
			type: "POST",
			url: $('#base_url').val()+"/v1/solution",
			data: formData,
			contentType: "application/json; charset=utf-8",
			dataType: "json",
			success: function (response) {
				$('#kidb').DataTable().ajax.reload();
				$("#dialog-form").dialog('close');
			},
			failure: function (response) {
				alert(response.responseText);
			},
			error: function (response) {
				alert(response.responseText);
			}
		});
		
    }
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 500,
      width: 500,
      modal: true,
      buttons: {
        "Save": addUser,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });
 
    $( "#create-user" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });
  } );
  
  	
  
  //Dynamic dropdown
  
  $(function () {
	var ddlCustomers = $("#entry_serviceline_id");
	ddlCustomers.empty().append('<option selected="selected" value="0" disabled = "disabled">Loading.....</option>');
	$.ajax({
		type: "POST",
		url: "index/getdropdown/?name=kidb_serviceline",
		data: '{}',
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		success: function (response) {
			ddlCustomers.empty().append('<option selected="selected" value="0">Please select</option>');
			$.each(response, function () {
				ddlCustomers.append($("<option></option>").val(this['id']).html(this['serviceline_name']));
			});
		},
		failure: function (response) {
			alert(response.responseText);
		},
		error: function (response) {
			alert(response.responseText);
		}
	});
	var ddlCat = $("#entry_category_id");
	ddlCat.empty().append('<option selected="selected" value="0" disabled = "disabled">Loading.....</option>');
	$.ajax({
		type: "POST",
		url: "index/getdropdown/?name=kidb_category",
		data: '{}',
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		success: function (response) {
			ddlCat.empty().append('<option selected="selected" value="0">Please select</option>');
			$.each(response, function () {
				ddlCat.append($("<option></option>").val(this['id']).html(this['category_name']));
			});
		},
		failure: function (response) {
			alert(response.responseText);
		},
		error: function (response) {
			alert(response.responseText);
		}
	});
});
