$("#contactForm").validator().on("submit",function(event){if(event.isDefaultPrevented()){formError();submitMSG(false,"フォームの各目を確認してください");}else{event.preventDefault();submitForm();}});function submitForm(){var tel=$("#tel").val();var email=$("#email").val();var subject=$("#subject").val();var message=$("#msg_content").val();$.ajax({type:"POST",headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},url:"/contact",data:"tel="+ tel+"&email="+ email+"&subject="+ subject+"&message="+ message,success:function(text){if(text=="success"){formSuccess();}else{formError();printErrorMsg(text);submitMSG(false,'フォームの各目を確認してください');}},error: function(json){var errors = json.responseJSON;formError();printErrorMsg(errors['errors']);submitMSG(false,'フォームの各目を確認してください');}});}
function formSuccess(){$("#contactForm")[0].reset();$(".print-error-msg").find("ul").html('');$(".print-error-msg").removeClass("alert alert-danger");submitMSG(true,"Message Submitted!")}
function formError(){$("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(){$(this).removeClass();});}
function submitMSG(valid,msg){if(valid){var msgClasses="h3 text-center tada animated text-success";}else{var msgClasses="h3 text-center text-danger";}
$("#msgSubmit").removeClass().addClass(msgClasses).text(msg);}
function printErrorMsg (msg) {$(".print-error-msg").find("ul").html('');$(".print-error-msg").css('display','block');$.each( msg, function( key, value ) {$(".print-error-msg").find("ul").append('<li>'+value+'</li>');});}