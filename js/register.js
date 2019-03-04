$(function(){
    $("form").on("submit",function(event){
        event.preventDefault();
 
        $.ajax({
            type:'post',
            url:'php/register.php',
            /*beforeSend:function(){
                $("#result").append("loading");
            },*/
            data:$('form').serialize(),
 
            success:function(data){
               // alert(data['result']);
                //alert(data['result2']); 
               
                //alert(data['response']);
                //$('#info').append('<p class="limiter" style="color:red;margin-bottom:15px;">' + data["response"]+ '</p>'); 
                data['response'];
               // alert(data['response']);
           $(location).attr('href', data['url']);
               },
            error:function(err){
                console.log(err);
            }
        })
    })
 })