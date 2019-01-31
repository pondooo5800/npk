/**
 * Created by JetBrains PhpStorm.
 * User: Top
 * Date: 12/17/13 AD
 * Time: 11:00 AM
 * To change this template use File | Settings | File Templates.
 */

//check menu active
 $(function(){
        if (menu == 'project_training' || menu == 'expenditure'  || menu == 'receive_outside'){
            $("[id="+menu+"]").addClass("current-page");
            $("[id="+menu+"]").parent().css('display', 'block');
            $("[id="+menu+"]").parent().closest('li').addClass('active');

            if( menu == 'receive_outside' && menu_child == 'outside' || menu_child == 'outside_in_form' ){
                $("[data-child=receive_menu]").addClass("current-page");
                $("[data-child=receive_menu]").parent().css('display', 'block');
                $("[data-child=receive_menu]").parent().closest('li').addClass('active');
            }else if(menu == 'receive_outside'){
                $("[id=expenditure]").addClass("current-page");
                $("[id=expenditure]").parent().css('display', 'block');
                $("[id=expenditure]").parent().closest('li').addClass('active');
            }
        }



 });

 function getUserInfo() {
   //console.log('msg');
   $.ajax({
           method: "POST",
           url: domain + '/usm/getUserInfo',
           data: {}
   }).done(function (data) {
           if (data) {
               //console.log(data);
               arr_date_of_birth = data.date_of_birth.split('-');
               date_of_birth = arr_date_of_birth[2]+'/'+arr_date_of_birth[1]+'/'+arr_date_of_birth[0];
               $('#user_id').val(data.user_id);
               $('#pid').val(data.pid);
               $('#org_title').val(data.org_title);
               $('#passcode').val(data.passcode);
               $('#user_prename').val(data.user_prename);
               $('#user_firstname').val(data.user_firstname);
               $('#user_lastname').val(data.user_lastname);
               $('#date_of_birth').val(data.date_of_birth);
               $('#user_position').val(data.user_position);
               $('#tel_no').val(data.tel_no);
               $('#email_addr').val(data.email_addr);
               if(data.user_gender == 1){
                 $('#user_gender1').attr('checked',true);
               }else if(data.user_gender == 2){
                 $('#user_gender2').attr('checked',true);
               }
               $('#update_datetime').html(data.update_datetime);
           }
   });
 }

 function getUserUpdate() {
   //console.log('msg');
   if($('#user_gender1').is(':checked')){
     gender = 1;
   }
   if($('#user_gender2').is(':checked')){
     gender = 2;
   }
   //console.log('user_gender:'+gender);
   $.ajax({
           method: "POST",
           url: domain + '/usm/update_user_ajax',
           data: {
               user_id:$('#user_id').val(),
               pid:$('#pid').val(),
               org_title:$('#org_title').val(),
               passcode:$('#passcode').val(),
               user_prename:$('#user_prename').val(),
               user_firstname:$('#user_firstname').val(),
               user_lastname:$('#user_lastname').val(),
               user_gender:gender,
               date_of_birth:$('#date_of_birth').val(),
               user_position:$('#user_position').val(),
               tel_no:$('#tel_no').val(),
               email_addr:$('#email_addr').val(),
               user_photo_file:$('#b64').html()
           }
   }).done(function (data) {
           if (data) {
               console.log(data);
               if(data == 1){
                  window.location.reload();
                  /*var url = window.location.href;
                  if (url.indexOf('?') > -1){
                     url += '&t='+Math.floor(Math.random() * 100);
                  }else{
                     url += '?t='+Math.floor(Math.random() * 100);
                  }
                  window.location.href = url;*/
               }
               /*
               $('#pid').val(data.pid);
               $('#org_title').val(data.org_title);
               $('#passcode').val(data.passcode);
               $('#user_prename').val(data.user_prename);
               $('#user_firstname').val(data.user_firstname);
               $('#user_lastname').val(data.user_lastname);
               $('#date_of_birth').val(data.date_of_birth);
               $('#user_position').val(data.user_position);
               $('#tel_no').val(data.tel_no);
               $('#email_addr').val(data.email_addr);
               if(data.user_gender == 1){
                 $('#user_gender1').attr('checked',true);
               }else if(data.user_gender == 2){
                 $('#user_gender2').attr('checked',true);
               }
               $('#update_datetime').html(data.update_datetime);*/
           }
   });
 }

 getUserInfo();

Number.prototype.formatMoney = function(c, d, t){
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};


function Script_checkID(id) {
    if(id.length != 13 && id!='2222222222222') return false;
    for(i=0, sum=0; i < 12; i++)
        sum += parseFloat(id.charAt(i))*(13-i);
    if((11-sum%11)%10!=parseFloat(id.charAt(12))) return false;
    return true;
}

function checkEmail(email){
    if(!email.match(/^[\w]{1}[\w\.\-_]*@[\w]{1}[\w\-_\.]*\.[\w]{2,6}$/i)){
        return false;
    }else{
        return true;
    }
}


function isEngChar(char,obj){
    if(!check_character(char)){
        var str_length=char.length;
        var str_length_end=str_length-1;
        obj.value=char.substr(0,str_length_end);
        return false;
    }
}

function check_character(ch){
    var len, digit;
    if(ch == " "){
        len=0;
    }else{
        len = ch.length;
    }
    for(var i=0 ; i<len ; i++)
    {
        digit = ch.charAt(i)
        if( (digit >= "a" && digit <= "z") || (digit >="0" && digit <="9") || (digit >="A" && digit <="Z") || (digit =="_")){
            ;
        }else{
            return false;
        }
    }
    return true;
}

function isThaichar(str,obj){
    var orgi_text="ๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ";
    var str_length=str.length;
    var str_length_end=str_length-1;
    var isThai=true;
    var Char_At="";
    for(i=0;i<str_length;i++){
        Char_At=str.charAt(i);
        if(orgi_text.indexOf(Char_At)==-1){
            isThai=false;
        }
    }
    if(str_length>=1){
        if(isThai==false){
            obj.value=str.substr(0,str_length_end);
        }
    }
    return isThai; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด
}
