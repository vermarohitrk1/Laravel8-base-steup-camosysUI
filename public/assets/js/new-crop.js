(function (window, undefined) {
     $(document).ready(function() {
        $('#imagefile').change(function() {
            $("#viewimage").html('');
            $("#viewimage").html('<img src="https://kuldeep.camosys.com/assets/css/images/loading.gif" />');
            // $(".uploadform").ajaxForm({
            // 	url: 'admin/profile-avatar/update',
            //     success:    showResponse 
            // }).submit();
            var img = $(this).parents('form').find('input[name="imagefile"]')[0].files;
            var token = $(this).parents('form').find('input[name="_token"]').val();
            var formData = new FormData();
                formData.append('_token', token);
                formData.append('image', img[0]);
            
            $.ajax({
                type: "POST",
                url: '/admin/profile-avatar/update',
                data: formData,
                processData: false,
                contentType: false,
                success: function(e)
                {
                    showResponse(e);
                }
              });

        });
    });
    
    function showResponse(responseText, statusText, xhr, $form){

	    if(responseText.indexOf('.')>0){
			$('#thumbviewimage').html('<img src="https://kuldeep.camosys.com/uploads/avatar/tmp/'+responseText+'" style="position: relative;" alt="Thumbnail Preview" />');
	    	$('#viewimage').html('<img class="preview" alt="" src="https://kuldeep.camosys.com/uploads/avatar/tmp/'+responseText+'" id="thumbnail" />');
	    	$('#filename').val(responseText); 
			$('#thumbnail').imgAreaSelect({  aspectRatio: '1:1', handles: true  , onSelectChange: preview });
		}else{
			$('#thumbviewimage').html(responseText);
	    	$('#viewimage').html(responseText);
		}
    }
    
function preview(img, selection) { 
	var scaleX = 150 / selection.width; 
	var scaleY = 150 / selection.height; 

	$('#thumbviewimage > img').css({
		width: Math.round(scaleX * img.width) + 'px', 
		height: Math.round(scaleY * img.height) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	
	var x1 = Math.round((img.naturalWidth/img.width)*selection.x1);
	var y1 = Math.round((img.naturalHeight/img.height)*selection.y1);
	var x2 = Math.round(x1+selection.width);
	var y2 = Math.round(y1+selection.height);
	
	$('#x1').val(x1);
	$('#y1').val(y1);
	$('#x2').val(x2);
	$('#y2').val(y2);	
	
	$('#w').val(Math.round((img.naturalWidth/img.width)*selection.width));
	$('#h').val(Math.round((img.naturalHeight/img.height)*selection.height));
	
} 

$(document).ready(function () { 
	$('#save_thumb').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("Please Make a Selection First");
			return false;
		}else{
			return true;
		}
	});
}); 

})(window);