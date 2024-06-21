//Function To Display Popup
function div_show(id,eid) {
	
	if(id=='updateUser')
	{

		$("#updateName").val($("#"+eid+" .name").html());
		$("#updateEmail").val($("#"+eid+" .email").html());
		$("#updatephone").val($("#"+eid+" .phone").html());
		// $("#updateheading").val($("#"+eid+" .heading").html());
	}
    if(id=='updateProfile')
    {
        $("#updatename").val($("#name").html());
        $("#updateemail").val($("#email").html());
        $("#updatemobile").val($("#mobile").html());
        $("#updateheading").val($("#heading").html());
    }
    if(id=='updateIp')
    {
        $("#Ip").val($("#"+eid+" .ip").text());
        $("#updateId").val(eid);
    }
	if (id=='imageview')
	{
		$("#imageviewer").attr('src', eid);
	}
	
	$("#"+id).css('display', 'block');
	$("#deleteId").val(eid);
}
//Function to Hide Popup
function div_hide(id){
$("#"+id).css('display', 'none');
// document.getElementById('addProduct').style.display = "none";
}
$(document).ready(function(){

    $("#show").change(function(){
        $('#get').html($('#'+$(this).find('option:selected').text().toLowerCase().replace(/\s/g, '')+'-form').children().clone());
    });
    $(".color .status").each(function()
    {
    	if ($(this).text() == 'closed') 
    	{
    		$(this).parent().css({
    			'border-left': '10px solid #008000',
    			'background-color': '#b3ffb3'
    		});
    	}
    	else if ($(this).text() == 'chargeback') 
    	{
    		$(this).parent().css({
    			'border-left': '10px solid #800000',
    			'background-color': '#ff1a1a'
    		});
    	}
    	else if ($(this).text() == 'pending') 
    	{
    		$(this).parent().css({
    			'border-left': '10px solid #ff1493',
    			'background-color': '#ff99cf'
    		});
    	}
    	else if ($(this).text() == 'decline') 
    	{
    		$(this).parent().css({
    			'border-left': '10px solid #ff6600',
    			'background-color': '#ff8533'
    		});
    	}
    	else if ($(this).text() == 'open')
    	{}
    	else
    	{
    		$(this).parent().css({
    			'border-left': '10px solid #000000',
    			'background-color': '#000000',
    			'color' : 'white'
    		});;
    	}	
    });
    $('#searchfor').keyup(function(e){
        
     	var searchedText = $(this).val();
        var ids = [];
        for (var i = 0; i < $('.tosearch').length; i++) 
        {
            if(!($(".name").eq(i).text().search(new RegExp(searchedText, "i")) < 0) )
            {
                ids[i]=i;
            }
            
            if(!($(".email").eq(i).text().search(new RegExp(searchedText, "i")) < 0))
            {
                ids[i]=i;
            }
            
            if(!($(".phone").eq(i).text().search(new RegExp(searchedText, "i")) < 0))
            {
                ids[i]=i;
            }
            
            if(ids[i]==i)
           {
            $('.tosearch').eq(i).show();
           }
           else
           {
            $('.tosearch').eq(i).hide();
           }  
        }
      
    });
    
    $(".edit").click(function(){
        $.redirect($(this).find(".link").attr('href'),
        {
            custid: $(this).attr('id')
        });
    });

});

$(document).ready(function(){
	if ($("#message").is(':empty'))
	{
		$("#message").hide();
	}
	else
	{
		$("#message").fadeIn();
		$("#message").fadeOut(5000);
	}
});
$( document ).ready(function(){
	$("#mailPassword").click(function(){
		email = $('#email').val();
		$.ajax({
				type: "POST",
				url: 'passrecoverymail.php',
				data:{"email" : email},
				success: function(data)
				{
					$("#mailresponse").fadeIn();
					$("#mailresponse").html(data);
					$("#mailresponse").fadeOut(15000);
				}
		});
	});
    $("#colorpicker").change(function(event) {
        $("#headercolor").val($(this).val());
    });
});
