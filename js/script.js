$(document).ready(function(){
	//code will come here
	$(window).on("load resize", function(){
		//icon blocks
		var icon_height = $(".icon-block").outerWidth();
		$(".icon-block").outerHeight(icon_height);

		//postit block
		var postit_height = $(".postit").outerWidth();
		$(".postit").outerHeight(postit_height);
		$("ol.note-lists").height($("ol.note-lists").width() - 20);

		//post-it scroll bar visibility action
		$(window).on("load resize", function(){
			if(($("ol.note-lists").height) > postit_height){
				$(this).css("overflow-y", "scroll");
			}
		});

		//note user stamp
		//$(".mod-user").width($(".mod-user").height());
	});

	//tooltip
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip();
	})

	//navbar actions


	//form validations
	function validate(form){
		//check if values are empty
		if(valid)
		{
			alert("This note will be archived!");
		}
	}

	//ajax
	//send request
	$(".add-friend-link").on("click", function(i){
		//get user id of friend
		var id = $(this).parent("#add-friend").find("input[name='friend_id']").val();
		$(this).parent("#add-friend").submit(function(e){
			var url = "add_friend.php";
			//get submit button id
			$.ajax({
				type: "POST",
				url: url,
				data: $("#add-friend").serialize(),
				success: function(data)
				{
					//display message
					$("#result").html("Success!");
				},
				error: function(err)
				{
					alert("Error!");
				}
			});
			e.preventDefault();
		});
		//change form attributes
		$(".add-friend-form-id-"+id).toggleClass("hide");
		$(".cancel-friend-form-id-"+id).toggleClass("show");
		//$(".cancel-id-"+id).addClass("btn-request-sent cancel-id-"+id+ " show");
	});

	$(".cancel-friend-link").on("click", function(i){
		//get user id of friend
		var id = $(this).parent("#cancel-friend").find("input[name='friend_id']").val();
		$(this).parent("#cancel-friend").submit(function(e){
			var url = "cancel_request.php";
			//get submit button id
			$.ajax({
				type: "POST",
				url: url,
				data: $("#cancel-friend").serialize(),
				success: function(data)
				{
					//display message
					$("#result").html("Request Cancelled.");
				},
				error: function(err)
				{
					alert("Error!");
				}
			});
			e.preventDefault();
		});
		//change form attributes
		//$("#add-friend").attr("id", "cancel-request");
		$(".add-friend-form-id-"+id).toggleClass("hide");
		$(".cancel-friend-form-id-"+id).toggleClass("show");
	});
	
	//drag and sort
	$(function(){
		$("#notes-sortable").sortable({
			connectWith: "#notes-sortable",
			appendTo: "body",
			revert: "100"
		});
		//$("ul li").disableSelection();
	});

	
	
});