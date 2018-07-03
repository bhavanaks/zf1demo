 $(document).ready(function() {
	 
	 
		$('#kidb').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "index/getdata",
			columns: [
			{ data: "ticket_number" },
			{ data: "serviceline_name" },
			{ data: "description" },
			{ data: "solution" },
			{ data: "user_id" },
			{ data: "last_updated" },
			
		] 
		} );
		
		// Name can't be blank
		$('#entry_ticket_number').on('input', function() {
			var input=$(this);
			var is_name=input.val();
			if(is_name){input.removeClass("invalid").addClass("valid");}
			else{input.removeClass("valid").addClass("invalid");}
		});
		// Message can't be blank
		$('#entry_description').keyup(function(event) {
			var input=$(this);
			var message=$(this).val();
			console.log(message);
			if(message){input.removeClass("invalid").addClass("valid");}
			else{input.removeClass("valid").addClass("invalid");}	
		});
		//ui-button
		/* $(".ui-button").click(function(event){
			var form_data=$("#entry").serializeArray();
			var error_free=true;
			for (var input in form_data){
				var element=$("#entry_"+form_data[input]['name']);
				var valid=element.hasClass("valid");
				var error_element=$("span", element.parent());
				if (!valid){error_element.removeClass("error").addClass("error_show"); error_free=false;}
				else{error_element.removeClass("error_show").addClass("error");}
			}
			if (!error_free){
				event.preventDefault(); 
			}
			else{
				alert('No errors: Form will be submitted');
			}
		}); */
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
		console.log('hiii')
		//alert("called");
		var valid = true;
		allFields.removeClass( "ui-state-error" );

		//valid = valid && checkLength( ticket, "ticket", 3, 16 );
		//valid = valid && checkLength( serviceline_name, "email", 6, 80 );
		//valid = valid && checkLength( password, "password", 5, 16 );

		//var formData = $("form#entry").serializeArray();
		var formData = $("form").serialize()
		//alert(formData);
		//return valid;
		
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
