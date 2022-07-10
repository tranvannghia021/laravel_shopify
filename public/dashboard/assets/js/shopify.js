document.addEventListener('DOMContentLoaded',function(){

    Validator({
       form:'#form-create-shopify',
       formGroupSelector: '.form-group',
       errorSelector: '.form-message',
       rules:[
           Validator.isRequired('#domain_shopify','Vui lòng nhập tên miền'),
         
   
       ],
       
   });
});