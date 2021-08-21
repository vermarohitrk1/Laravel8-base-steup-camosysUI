(function (window, undefined) {
var jQueryScript = document.createElement('script');  
jQueryScript.setAttribute('src','https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js');
document.head.appendChild(jQueryScript);

$("body").on("click", ".fetch-display-click", function(e) {
    e.preventDefault();
    loader();
    var formData = new FormData();
    var t = $(this),
        i = t.attr("data"),
        n = t.attr("url"),
        s = t.attr("holder"),
        r = !0;
    if (void 0 !== i) {
        var o = i.split("|");
        i = {};
        o.forEach(function(e) {
            var t = e.split(":");
            i[t[0]] = t[1]

            formData.append(t[0],  t[1]);
        })
    }

    $.ajax({
        type: "POST",
        url: n,
        data: formData, 
        processData: false,
        contentType: false,
        success: function(e)
        {
            console.log(e);
                 void 0 !== t.attr("modal") && $(t.attr("modal")).modal({
                    show: !0,
                    backdrop: "static",
                    keyboard: !1
                }), 
                loader();
                $(s).html(e)
                feather.replace();
        }
      });
});



$("body").on("submit", ".axios-form", function(e) {
  
  
    e.preventDefault();
    loader();
    var formData = new FormData();
    $(this).find(":input").each(function(e) {
    var $this = $(this);
    if ($this.is("input")) {
       
        if($(this).attr('type') == 'text' || $(this).attr('type') == 'number' || $(this).attr('type') == 'password' || $(this).attr('type') == 'email' || $(this).attr('type') == 'hidden' || $(this).attr('type') == 'date'){
            formData.append($(this).attr('name'),  $(this).val());
        }
        if($(this).attr('type') == 'file'){
          var files = $(this)[0].files;
          formData.append($(this).attr('name'),files[0]);
        }

        if($(this).attr('type') == 'checkbox'){
          if($(this).is(':checked')){
            var res = true;
          }else{
            var res = false;
          }
            formData.append($(this).attr('name'), res);
        }
        if($(this).attr('type') == 'radio'){
          if ($(this).is(':checked'))
          { var radio = $(this).val(); }else{ var radio = null;}
            formData.append($(this).attr('name'), radio);
        }
    }
    if($(this).is("select")) {
        formData.append($(this).attr('name'), $(this).val());
    } 
    if ($this.is("textarea")) {
      formData.append($(this).attr('name'), $(this).val());
     }
  });
   console.log(formData);
    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: formData, 
        processData: false,
        contentType: false,
        success: function(e)
        { loader();
          serverResponse(e)
            // swal.fire({
            //        title: "Good job!",
            //        text: "You clicked the button!",
            //        icon: "success",
            //      }).then(function(isConfirm) {
                       
            //         location.reload(true);
            //      });
        },
        error: function(err, i, n){
          loader();
                if (err.status == 422) { 
                console.log(err.responseJSON);
                $('#success_message').fadeIn().html(err.responseJSON.message);
                console.warn(err.responseJSON.errors);
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="'+i+'"]');
                      if(el.next('span.error-message').length > 0){
                        el.next('span.error-message').text(error[0]);
                      }else{
                        el.after($('<span class="error-message" style="color: #D65053;">'+error[0]+'</span>'));
                      }
                    el.addClass('error');
                });
                toastr['warning']('Please fill the all required fields!', 'Hmm!', {
                  closeButton: true,
                  tapToDismiss: false
                });
                return false;
              }
              toastr['error']('😖 '+ n+'!<br> Please contact Rohit!', 'Oops!', {
                closeButton: true,
                tapToDismiss: false
              });
        }
      });
});

$('form.switch-button :input[type="checkbox"]').on('change', function(e){ 
  
  e.preventDefault();
  var formData = new FormData();
  $(this).prop('disabled', true);
  formData.append('_token',  $(this).attr('data-token'));
  formData.append('id',  $(this).attr('data-id'));

  var n = $(this).parents('form').attr('action');
 
  if($(this).is(':checked')){
    
    formData.append($(this).attr('name'),  1);
    
    axios.post(n, formData).then(function(e) {
      $('form.switch-button :input[type="checkbox"]').prop('disabled', false);
          });
  }else{ 

  formData.append($(this).attr('name'),  0);
    axios.post(n, formData).then(function(e) {
      $('form.switch-button :input[type="checkbox"]').prop('disabled', false);
          });
  }
});
/*
   *  switch item
   */
  $("body").on("click", ".send-to-server-click", function(e) {
    e.preventDefault();
    var t = $(this),
        i = t.attr("data"),
        n = t.attr("url"),
        s = !0,
        r = i.split("|");
    i = {};
    var formData = new FormData();
    r.forEach(function(e) {
      var t = e.split(":");
    formData.append(t[0], t[1]);
  });
        var o = t.attr("warning-title"),
            a = "Continue";
        a = void 0 === t.attr("warning-button") ? "Continue" : t.attr("warning-button"), void 0 === t.attr("button-color") ? b_color = "#EA5455" : b_color = t.attr("button-color"), void 0 === t.attr("icon") ? icon = "warning" : icon = t.attr("icon"), void 0 === t.attr("warning-message") ? message = "" : message = t.attr("warning-message"), swal.fire({
            title: o,
            text: message,
            icon: icon,
            showCancelButton: !0,
            confirmButtonColor: "#EA5455",
            confirmButtonText: a,
            closeOnConfirm: !1
        }).then(function(isConfirm) {
          axios.post(n, formData).then(function(e) {
            alert('suc');
            // location.reload(true);
            
          });       
        });
              // }
});


$("body").on("change", ".filter-form :input[type='radio']", function(e) {
  loader();
  var s = '.users-card';
  var status = $(this).parents('form').find('input[name="status"]:checked').val();
  var role = $(this).parents('form').find('input[name="role"]:checked').val();
  var sort = $(this).parents('form').find('input[name="sort"]:checked').val();
  var order = $(this).parents('form').find('input[name="order"]:checked').val();
  var token = $(this).parents('form').find('input[name="_token"]').val();
  var formData = new FormData();
  formData.append('_token', token);
  formData.append('status', status);
  formData.append('role', role);
  formData.append('sort', sort);
  formData.append('order', order);
  $.ajax({
      type: "POST",
      url: '/admin/managestaff/users_card',
      data: formData, 
      processData: false,
      contentType: false,
      success: function(e)
      { loader();
              $(s).html(e)
              feather.replace();
      },
      error: function(e){
        loader();
      }
    });
});

$('.filter-collapse').on('click', function(){
  $('.filter_collapse').slideToggle(500).toggleClass("show");
  // $("nav ul").slideToggle(1500);
});


function serverResponse(response) {
  void 0 === response.notify && (response.notify = !0), void 0 === response.notifyType && (response.notifyType = "swal"), 
  void 0 === response.status && (response.status = "info"), void 0 === response.title && (response.title = "Hello!"), 
  void 0 === response.buttonText && (response.buttonText = "Okay"), void 0 !== response.callback && 
  void 0 === response.callbackTime && (response.notify && "toastr" !== response.notifyType ? response.notify && 
  "swal" === response.notifyType && (response.callbackTime = "onconfirm") : response.callbackTime = "instant"), 
  void 0 === response.showCancelButton && (response.showCancelButton = !1), void 0 === response.message && (response.message = ""), 
  "instant" === response.callbackTime && void 0 !== response.callback && eval(response.callback), response.notify ? 
  "swal" === response.notifyType ? "onconfirm" === response.callbackTime && void 0 !== response.callback ? swal.fire({
    title: response.title,
    text: response.message,
    
    icon: response.status,
    showCancelButton: response.showCancelButton,
    confirmButtonColor: "#007bff",
    confirmButtonText: response.buttonText,
    
  }, function() {
    eval(window.response.callback)
  }).then(function(isConfirm) {
    if(response.callback){
  eval(response.callback);
 }
}) : swal.fire({
    title: response.title,
    text: response.message,
    
    icon: response.status,
    showCancelButton: response.showCancelButton,
    confirmButtonColor: "#007bff",
    confirmButtonText: response.buttonText,
    
  }).then(function(isConfirm) {
    if(response.callback){
  eval(response.callback);
 }
}) : "toastr" === response.notifyType && (swal.close(), "success" === response.status ? toastr.success(response.message, response.title) : "error" === response.status ? toastr.error(response.message, response.title) : "info" === response.status ? toastr.info(response.message, response.title) : "warning" === response.status && toastr.warning(response.message, response.title)) : swal.close()
}
function redirect(url){
  window.location.replace(url);
}

function reload()
{
     location.reload(true);
}
$(".modal").on("hidden.bs.modal", function () {
  $(document).find(':input').next('span.error-message').remove();
  $(document).find(':input').removeClass('error');
});
})(window);