function toggleLoginLoading(btnLoading,btnspan,idEmail,idPass){
    const email=document.querySelector(idEmail).value;
    const password=document.querySelector(idPass).value;
    if(email != '' && password != '' ){
      addClass(btnLoading,btnspan);
    }
}
 // form-login
 document.addEventListener('DOMContentLoaded',function(){

     Validator({
        form:'#form-login-admin',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules:[
            Validator.isRequired('#usename_login-admin','Vui lòng nhập email'),
            Validator.isEmail('#usename_login-admin','Không đúng định dạng email'),
            Validator.isRequired('#password_login-admin','Vui lòng nhập mật khẩu'),
    
        ],
        onSubmit:function(data){
            $.ajax({
                url:'/admin/login',
                type:'POST',
                datatype:'JSON',
                data:$('#form-login-admin').serialize(),
                success:function(res){
                 
                    removeClass('#btn-login','#span-login')
                    if(res.error == false){
                        showMessage('Success',res.message,'success',10000);
                        setTimeout(()=>{
                            window.location.href='/admin';
                        },1000)
    
                    }else{
                        showMessage('Error',res.message,'error',10000);
                    }
                }
            });
        }
    });
 });