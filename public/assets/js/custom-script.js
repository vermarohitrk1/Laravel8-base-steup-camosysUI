(function (window, undefined) {

    $('#navbarSupportedContent').on('click','.nav .nav-item .nav-link', function(){
        if($(this).attr('data-item') == 'Profile'){
            $('#document').hide();
            $('#setting').hide();
            $('#profile').show();
        }else if($(this).attr('data-item') == 'Document'){
            
            $('#setting').hide();
            $('#profile').hide();
            $('#document').show();
        }else if($(this).attr('data-item') == 'Setting'){
            $('#document').hide();                
            $('#profile').hide();
            $('#setting').show();
        }
    });

    $(function () {
        // var confirmText = $('#confirm-text');
         $("body").on("submit", "#confirm-text", function(e) {
                          e.preventDefault();
                          var formData = new FormData();
                           $(this).find(":input").each(function(e) {
                       var $this = $(this);
                       if ($this.is("input")) {
                          
                           if($(this).attr('type') == 'text' || $(this).attr('type') == 'password' || $(this).attr('type') == 'email' || $(this).attr('type') == 'hidden' || $(this).attr('type') == 'date'){
                               formData.append($(this).attr('name'),  $(this).val());
                           }
                          
                         
                           
                       }
                       
                     });

                Swal.fire({
                       title: 'Are you sure?',
                       text: "You want to change the status of the account!",
                       icon: 'warning',
                       showCancelButton: true,
                       confirmButtonText: 'Yes',
                       customClass: {
                         confirmButton: 'btn btn-primary',
                         cancelButton: 'btn btn-outline-danger ml-1'
                       },
                       buttonsStyling: false
                     }).then(function (result) {
                        
                           $.ajax({
                                   type: "POST",
                                   url: $('#confirm-text').attr('action'),
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
                                           
                                           $(s).html(e)
                                   }
                                 });
                       if (result.value) {
                         Swal.fire({
                           icon: 'success',
                           title: 'changed!',
                           text: 'Your account status has been changed.',
                           customClass: {
                             confirmButton: 'btn btn-success'
                           }
                         }).then(function(isConfirm) {

                               location.reload(true);
                            });
                       }
                     });
                   });
               });

               
function validate(th){
  th.validate({ // initialize the plugin
    rules: {
        
        email: {
            required: true,
            email: true
        },
        fullname: {
            required: true,
        }
    },
    messages: {
        email: {
            required: "Please enter your email",
            email: "Please enter valid email",
        },
        fullname: {
            required: "Please enter your email",
           
        },
    
       
    }
});
}

function croppify() {
  $(".croppie").each(function() {
    var e = $(this),
      t = e.attr("name"),
      //i = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALAAAACjCAYAAAAq9ZRrAAAAAXNSR0IArs4c6QAAFDpJREFUeAHtnedvHFUXxq8d995LbCdOR3REFSAQIPEB+IKQ+AdBfEBCCAmBEC0U0Xt705w47r33lvf8bjLOZL1rO+Pd9b0z50SO17Nz23OfOXNuO6fghohRUQQ8RaDQ03prtRUBi4ASWIngNQJKYK+7TyuvBFYOeI2AEtjr7tPKK4GVA14joAT2uvu08kpg5YDXCCiBve4+rbwSWDngNQJKYK+7TyuvBFYOeI2AEtjr7tPKK4GVA14joAT2uvu08kpg5YDXCCiBve4+rbwSWDngNQJFXtfeg8pvbd0wE9OzZn193XB4i7+PHCk0LU11prhI4T9oFyqCB0CQ44Rr6xtmaWnFlJWVmPKy0h25rW9smJGxSbOxsWkKCgrs94WFBaa+piotgadnF8z45LSprCiXnzKbZ0lx0XbaHQUk/EKBHuq8ewYsr6yayek5s7CwZJZXV0W7bpqOtibT0d6cNrN1ITlkLxDi2n/C4yNHjqS9d2ZuwQwOj5vVtXXR1luWuI0Ntaa7sy3t/Um/qASOwID+oTEzNjFjKspLTXVVhamurDBVleXWNIiQ3Y4kgWbnQVlYXDalpcWmuaFux316wRglcAQWbGxums3NLXPYr3bqsLS8YirE1DhSmMzxuBI4DYE35dU9PTNv7U/sUFdlbn7RXLzab98ErU0NpqGu2hQmjMhK4BA7eXVPz86b4dEps7i0bLo6Wkx7S2PoDrc+MqNBfUfHpb5o4tJS03G02dTJADEpogS+1dOrq2umd2DEzMnArEJmE9qEuGi0YObAZUKEiVxbXZlxMOlyG6LWTQl8C7lFGSz1Do6apvpa0ySjfuZqfRPeIIgPD122sFUCh5C0U1235mpDl/Wjwwj4p2ZyCGZcNRfzyUzHBRo6hxDmPevEEZjO3JRpsCQJU20XevrM9YFRuzgSp7YnisAs+166OmB6+0fi1Id7tqVClqXbmhtkiXrGXLk2KMvf63um8eWGxBB4ZWVNOq/fTo/V1Vb70j9ZqWeh2PWdsszd3dVm5heXzKWeAbuHIyuZH3ImidjMsyibbXquD9rVs1PdHYmaJw3zq7mxzpSUFFtNbLfGhb/09HMiCMyKFTNMp0902H0LnvZVVqrNPDE/cZFETKMxcGOyv6go/Q6wuHRmEtuRCAInsWOT0ubEDOKS0qFR28kOu1sLeVGzOJR0SuBDgd2tQtl9d6mn3wyOjLtVsX3UJnYEZsDGaQmV/SPANBub8zn6NCNHmnySWBGYYzhX+4bNxNSMT31w6HVlCb3zaIspLy8zfbKhaXVt7dDrtN8KxIbA2G8DctRnc0vOp2U4m7ZfUJJ4X5Gc0evuaDUcQu0f8seUiM088KRo3amZOSFvi6mSpVOVu0egUs71nTjWbk9Q333qw0kRCwKzC3ZSjgDVVFXKmn/94SAZk1Ib6mq8akls5oFX5EQFm9DVWYhX/DtwZWND4AMjoRl4iUBsBnFeoq+VPjACSuADQxjvDNj87/JJDiVwvPl3oNZB3J7rQ3Zu+EAZ5TCxtwTGKw2bs13WDjnst7xkzQIHg+IpmeFZk0UiF8VbAo9NTJvLcjwIx3kquUMAFwMoC0jsonhJYLTulHikqZClz2JxPaqSOwRwWlhVWSbL87OyyrmVu4Ii5uwlgRfE7dPy8qo3nnMi9o0TyTAjmhvrxVTbcnKFzkv1NSW7zXASXZsgH2CHyebG+hp7DMnFEy1eamCcQ3NAsVQOKKrkBwEXyUvLdSUuP/2vpeQIAS81cI6w0Gw9REAJ7GGnaZVvI+DlIO529f39xFH/2blFuxjDgUoWDJiyqq2usgNUV1vGFKZLThDVBj4EpnBuj1MPTE1VSYAY5rJZ6cLLOrEuuuR4D2R2TfBa3zc4Zje9l5WWOFE9rzQwTz+T6Rx/8UHwCjkuCwDL8hutxUkROr5fwmi1yCxKq2y+D4fbQhNzsPLKtQHxItTpHIlxDsPyPXPwrhDYKxt4TAIAsnzM0qbrwlw1dd2Qpe4mCZFVLycdliRsFmEMWpvqzVGJKxcmL+3hweyUI1FNQm4OV7q28sWbgum0FYcOfXqlgZeWCCro/t4H+6odGpXgh812vjp42NC6OJreK/JRe0uDHG+fFxt5QVYb3Tnig53OQ7Yqnj5dEa808LqEay0uPuJ8/ArMBs7nsdiSKti2ew2C0MyEmoXsLklwZAv3Ba6INxoY+2tDjnzjHtRlwYn2vEQ62is8116jeciysLhi3zgubVjqEpcFWzIWcUW80cB2M4kMckqK3SUwoWEviit/6lgjIWgzyazMQly40meJnuketjEWSO8QyJAQYK5IlbSrxiH3rF5No6HZ0MAu7oFgXpc4FOUSbBBP6JnMBIJ59/YPmw0ZiBaLqXDi+NGMZEfT9YqnIbT6uVNdGfN0hdyHUQ9vNDDgEFjbRfJSt9n5JbMpNjpzuJnIS1RN4nMwMCuXYIp1tVXmmhzZYUEjneCzjGihzBHz8KrsRMArAu+svjtXmHnAt1imXVuQ97pMoXXI9FmrBFy5IRq7vaVJIoI2mGv9QwbNnE4Y+eN4b0HCJKjsREAJvBOTSFcYlGWKGB9o3mBajQEpwyD+h8wQ+ZqYCkybpZMC2fssy3bpvkr8NSVwlihAfGVW3iByqmBSHBfHeTum1W7dyoocpke6SPPY1qx8YXK4IBtiJtFOV0QJnKWe4HQIg64RiRyfKkSPb5BTDbsJsw7Y+KkyNDpJ8GNTXb3zu9R78/H3zVhzssIoM0IuiDfzwIDFQAabsKzMjY0k4Q7E9kWL2hkG0VI3A4azZ+NOjVzI3FhIcGeaTmuj6ThIyWngk+Ix0pX9H6sESZQHyhXxhsB0MvsDeJWelKknFwVNe7q70wyNTth9EIZ+DvEXm5dNMOx3wKxAi/X1jdrImQX25lCrJC1tPSObevZaeg6lyvlHFpN4mNKZOzkvPE0B3hCYDkfLue49nKXisye77NwtMw0h/lr4OYy6uSlUlgcSIpyShzF1ZQveQxCXVuAC7qytb9qlfKb4XBBvCAxYLGJgRrAbjaVWl6VkF38Vy5u3V9ZcXxoPY8zDCHFLHdkLTN38IrAs0fLaZVOP6wQOd3xcPqNzCdXLrJ4r4hWBsQVLhcQuARilI0tLiuy0Won89k2KHYt26tVeCDrbB/PBN1L6XF/vCOwz2Fr37CPg9kgo++3VHGOGgBI4Zh2atOYogZPW4xHbO7ewaLeCunbQ1FsCp1t+jdg3mmwfCIyNT8ue50XnNsV5SWC2JxJdnf0CKrlHwG6olwOmLJUXObaA5CWBWVaekxW5mTk33d7nnlL5LWFWzAeiFdXXVue34H2U5iWBOTBZLjvSJsV5yM2t4ftoqd4SGQGOPLHkXSmhBlwT/5aCBEE2unCubFjcMOHsxKXdWq51cDbqgychFEWmEyfZKCNqHl5qYBrbUFctS8qFTp0OiNoJrqdjoz2OWlwUr1fiOGrDfoJUH2MuAq11yg0CXhM4N5Borj4h4K0J4RPIWtfcIaAEzh22XufsgwtbAFYCe02z3FSeY/P/u9xrV95yU0L2co0NgfEbzApdGrcM2UMrATnhdIXwB+uycOGqG69wN8SGwLh2wjX/uHhxV4mOAH4f5uYXTKc453YljMBurYkNgXH5iXORwZFxmRte3a3N+l0GBFbEjevQ6LjFEb8WPkhsCMzqHJ4c2SfRT3wJD+JouEgQFi26jjZbHF2sX2qdYjcPjDeba+J/94w4GMF9qUq8EYgdgekudqrhktQVd0zxptDhti6WBD5cSLX0fCIQGxs4n6BpWe4goAR2py/yWhMC0jBWYObBZ0kMgYlP7HtnZYtorLQxZz4zu5DWtWu2yslHPl5uaL9bYPBy3j80ZiMDnTrebgNs320ecbl/QWId90hgGdxmnjnR4Yzn96j4JkIDM0d8vJPQV0b89g7KknP6WBRRQfQlHYdgr0osDubK8TtcVemG1/eD4JeoWQhMiKuifXiFEg2eU7ZJElwRjE/NmGohrisxNw6Kf6IIDFi49B8cHrfR42sdijh50I5MavrEETipHR3XdifCBo5r52VqFw7A8aLD1si4ixI41MOrEtIVHwi+uq2i3hPTs+bC5eump3dQQtT6Pccb6pqMHxMxjZax9SlfTM/MSSSkMdlOWGnamhvt75RbnP2T/dADYtuzD6RKPNl3dRx1KpZFroBTGziELFsw0WCjEqwQf2C11VV2i6YPG7uJw8z04NHWRhujjqnDJIgSOE0vM1/KyQS2Zh6TPcZslHddCH6DCUEgyCSJEniX3mYQRFw3F4Qzf4syf83bwIc3Qr4wUwJHRHpoZMIsrazIokCl9c2Gs8FsewjCjJmRCPbMKGDjrq1tmI62JtPR3hyx1vFLlqz3TRb7r0A08/Ly2s1ZC8m3WKJucqQJp4PpJJjSYjmbyJw3RLvzm2XdTKGrRiemzcjYlPXEiWtTzv2lCwierrykXFMNfICext0+WhLtuLC4IhHphWRpnOCxdN3TO3TbFaxMz+Lt8caWOOY4UmDOnTqW9gj7mpgNmA4EN3fRM+QBoMtaUiVw1qDMnBFEHBFXsDcPmqJ1C61tjX1dXFRsmhtrrcvYzDnoN5kQUAJnQkave4FAMiYLvegKrWQUBJTAUVDTNM4goAR2piu0IlEQUAJHQU3TOIOAEtiZrtCKREFACRwFNU3jDAJKYGe6QisSBQElcBTUNI0zCCiBnekKrUgUBJTAUVDTNM4goAR2piu0IlEQUAJHQU3TOIOAEtiZrtCKREFACRwFNU3jDAJKYGe6QisSBQHvCby4uGjGx8e32z49vXucuImJCbOwcPjeKVPrvd2ACB9wYDIyMrLDIQvtjLtzE68IfPXqVfPFF1+Yzz//3PAZuXz5svnyyy/t58nJSfPee++Z4eFh+3e6/7755htz6dKldF/ZaxxN7+/v30GGjAkifhGud8QstpPxAH/44Ydy/Gh9+xofPvroI/PLL7/ccS1uf3hD4N9++8189dVXplJOATc0NJg//vjDrK7eGdCwsbHRvPHGG6a9vT1yP6EZP/nkk1horldeecU8/vjjkbHwIaEXp5KXlpYsYZ999llz9uxZi+sjjzyyA1/u++GHH8wzzzxjampqDBr5119/tSZDV1fXjs7866+/zNzcnCFfhNft+fPn7efPPvvMnD592pw7d86MjY0ZHqAVOUZ/4sQJ8+CDD9rTxPZG+e/ixYsG04Ry8QbPA/Doo4+alpYW8+2335r6+nozODgop5iXzQMPPGBOnjwZJN3+namMvr4+c+HCBUPbSHf//ffb83Pk9f3335vZ2Vn7QG9nFPrAQ04dwIx68GD39vYaHtLHHnvMYG719PSYY8eOmYcfftimzFTe1NSU+emnn2zaioqbjrGff/5560qA67wFWltbzZNPPmmK8uhcxQsNDDgQA/LsJhv4/hWi8Cqlw3mFcmydzkI7h4WO/PPPPy0hguv4dQi0N51O55PPxx9/bOi0e+65x0B6fsLCQxDY4Zgg1AGyI1z/+++/LUlqa2vtAwKBwrJbGfPz87bdPBAQcmhIwgOIYDZBqoB44fyCz5RN3RA+Q3jaBCY8ZNjNPNiYGTMzM/a+TOVhulH/F154wT7QHR0d4nut1NaD9jz11FO2PtQxn+IFgdGMgA459itoEoj83HPPWfKEtR4djzkC6HV1ddtZQmC0CIJWQnNev35dThNvWu0Kgbu7u7ft7+2Ee3xAk5MW7cSDODo6ekeK3cq477775Fh9mSUb9YPAtIvfaHMeavLfj1AH0nA/eL700kv2AcCPWvAApiuPvHkgm5ubrbanPjzQKIyBgQGLE28CzLvdxh/7qePd3uMFgSEZ5A20z34aSSfT4cXFxTtuR/tWV1fbAeCOL1Mu0Em8EgNneWgd8k6Vu3m4UtPuVgbanzcF5KmqqrJmDmVRH4gURcAlEIhMXjxYSLryuH7vvfea7777znzwwQempKTEHD9+fBsHFAwmDf105swZbs+beEFgOo8f7Fk0K69FXoeARmcE4IdRa2trswD/888/VoMGGoZ7APnVV1+1NnLqjASdg6BREEwKCMt9vF7RloGZYW+Q/3i1cj/fM7uQKnwHSf/77z9LFl7j4XpnKoM0PLQPPfSQoT3BlBh1BI8rV65YDMAkG5KpPPLGLMLGf/HFF83rr79uFQMPFIqANxSaHfs8/KbLRp32ysOLQRyN4HX39ddfm08//dS2CdsNzUHn//777+bff/+19lzQYDqYETik//nnn63t99prr9mvAR1Nim3MAARzIdBmpGtqarLTUrxyn376afPEE09Y7cODApH4OyydnZ2WxO+++659PZN/WLAv33rrLXsJs4WOD9eb13a6MtD8DCJpM3mWl5dvZ4tN/OOPP5p33nnHmjXbXxzgw27lMSjG7AInfoJBMYTGHn/77bftQ4nJ1i1mVr7EO8cmaAkkPNLlGq/C8KsxABDSobkCggbX9/rNwIo0gelAPmhiiJ9J+D7VZHn//fdtZzPYSq1jar0zlUH9gzdDatnpyky9527/Ti2PMng4X375Zds+ZlzOy2zNm2++aWd7yJ+3IXjRxnyKNxo4ACVM3N2uBd9FtRWDqaJwPruRl/tSyRuk5fd+6k1d05WRibzku1uZfB9FUsvjweJhwzxiDr5XxhCYQeE3TfjtEKXMqGm808BRG3pY6bC90Uzhzj6suhykXMYd2P8QmdkZBnH51rbp6q8EToeKXvMGAS9mIbxBUyuadwSUwHmHXAvMJgJK4GyiqXnlHQElcN4h1wKziYASOJtoal55R0AJnHfItcBsIqAEziaamlfeEVAC5x1yLTCbCCiBs4mm5pV3BJTAeYdcC8wmAkrgbKKpeeUdASVw3iHXArOJgBI4m2hqXnlHQAmcd8i1wGwioATOJpqaV94R+D+2nGx4HuI9swAAAABJRU5ErkJggg==",
      i = "data:image/png;base64,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";
      n = random();
    void 0 !== e.attr("default") && (i = e.attr("default")), e.removeAttr("name"), e.attr("croppie-id", ".croppie-" + n), e.after('<label class="croppie-cabinet croppie-' + n + '"><div class="croppie-figure"><img src="' + i + '" class="croppie-output" /><div class="croppie-cabinet-overlay"><div class="croppie-upload-icon"></div></div></div><input type="hidden" name="' + t + '"></label>');
    var s = $(".croppie-" + n).find("input");
    e.insertAfter(s)
  })
}
function random(e) {
  var t = "";
  if (void 0 === e ? e = {
      length: 16,
      type: "",
      case: ""
    } : void 0 === e.length && (e.length = 16), "alphabet" === e.type) var i = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  else if ("number" === e.type) i = "1234567890";
  else i = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
  e.length = parseInt(e.length);
  for (var n = 0; n < e.length; n++) t += i.charAt(Math.floor(Math.random() * i.length));
  return "upper" === e.case ? t = t.toUpperCase() : "lower" === e.case && (t = t.toLowerCase()), t
}
function readFile(e) {
  if (maxWidth = parseInt($(window).width() - 150), maxHeight = parseInt($(window).height() - 150), e.files && e.files[0]) {
    document.getElementsByTagName("input")[0].removeAttribute("croppie-status");
    var t = new FileReader,
      i = 300,
      n = 300;
    e.getAttribute("croppie-id");
    t.onload = function(t) {
      $("body").append('<div class="croppie-overlay"><div class="croppie-overlay-close"><div></div></div><div class="croppie-overlay-save"><div></div></div><div class="croppie-box ready"></div></div>'), e.setAttribute("croppie-status", "active"), rawImg = t.target.result, e.getAttribute("crop-width") && (i = parseInt(e.getAttribute("crop-width"))), e.getAttribute("crop-height") && (n = parseInt(e.getAttribute("crop-height"))), i > maxWidth && (n = parseInt(maxWidth * n / i), i = maxWidth), ($uploadCrop = $(".croppie-box").croppie({
        viewport: {
          width: i,
          height: n
        },
        boundary: {
          width: parseInt(i + 100),
          height: parseInt(n + 100)
        },
        enforceBoundary: !1,
        enableExif: !0,
        showZoomer: !1
      })).croppie("bind", {
        url: rawImg
      }).then(function() {})
    }, t.readAsDataURL(e.files[0])
  } else notify("Oops!", "you're browser doesn't support the FileReader API", "error")
}
$("body").on("click", ".croppie-overlay-close", function() {
  $(".croppie-overlay").remove()
});
$("body").on("change", ".croppie", function(e) {
  imageId = $(this).data("id"), tempFilename = $(this).val(), $(".croppie-overlay-close").data("id", imageId), readFile(this)
});
$("body").on("click", ".croppie-overlay-save", function(e) {
  var t = $("body").find("input[croppie-status=active]");
  $uploadCrop.croppie("result", {
    type: "base64",
    format: "png",
    size: {
      width: parseInt(t.attr("crop-width")),
      height: parseInt(t.attr("crop-height"))
    }
  }).then(function(e) {
    t.closest(".croppie-cabinet").find("img").attr("src", e), t.siblings("input[type=hidden]").val(e), $("input").removeAttr("croppie-status"), $(".croppie-overlay").remove()
  })
});
croppify();
})(window);