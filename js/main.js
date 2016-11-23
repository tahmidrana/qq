


function view_all_users(){
	$.ajax({
		type: 'GET',
		url: 'tbl_all_users.php',
		success: function(data){
			$("#tbl_all_users").html(data);
		}
	});
}

function set_status_of_users(id, status){
	//alert(status);
	var action;
	if(status == 1) action = 'deactivate';
	else if(status == 0) action = 'activate';
	$.ajax({
		type: 'GET',
		url: 'set_status_of_users.php?update_user_id='+ id +'&ac='+action,
		success: function(data){
			//alert(data);

			view_all_users();
		}
	});
}

function vote_system(){
	
}



function init_all(){
	//alert("Hello");
	view_all_users();
}

/*$(document).ready(function(){
	$(".add-comment").click(function(){
		var id = $(".comment-form").attr("id");
		//alert(id);
		//console.log(id);
		$(".comment-form").toggleClass("hidden");
	});
});*/

tinymce.init({ 
	selector:'#mytextarea',
	height: 300,
	toolbar: 'bold italic underline fontsizeselect | alignleft aligncenter alignright | bullist numlist | outdent indent | codesample jbimages | link emoticons hr preview',
  	plugins: 'code codesample emoticons hr preview image imagetools autolink link wordcount jbimages',
  	relative_urls: false,
  	menubar:false 	
});

