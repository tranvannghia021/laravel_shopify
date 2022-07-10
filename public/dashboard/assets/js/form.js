// admin

document.addEventListener("DOMContentLoaded", function () {
    //add products

    Validator({
        form: "#form-add-products",
        formGroupSelector: ".form-group",
        errorSelector: ".form-message",
        rules: [
            Validator.isRequired(
                "#products_name",
                "Vui lòng nhập tên sản phẩm"
            ),
            Validator.isRequired("#categorys", "Vui lòng chọn tên danh mục"),
            Validator.isRequired(
                "#Products_price",
                "Vui lòng nhập giá sản phẩm"
            ),
            Validator.isRequired(
                "#products_quantity",
                "Vui lòng nhập số lượng sản phẩm"
            ),
            Validator.isRequired("#products_file", "Vui lòng nhập chọn files"),
            Validator.isNumber(
                "#Products_price",
                "Trường này phải là số dương"
            ),
            Validator.isNumber(
                "#products_quantity",
                "Trường này phải là số dương"
            ),
            Validator.isImage("#products_file"),
        ],
    });

    // form-edit-producst

    Validator({
        form: "#form-edit-products",
        formGroupSelector: ".form-group",
        errorSelector: ".form-message",
        rules: [
            Validator.isRequired(
                "#products_name",
                "Vui lòng nhập tên sản phẩm"
            ),
            Validator.isRequired("#categorys", "Vui lòng chọn tên danh mục"),
            Validator.isRequired(
                "#Products_price",
                "Vui lòng nhập giá sản phẩm"
            ),
            Validator.isRequired(
                "#products_quantity",
                "Vui lòng nhập số lượng sản phẩm"
            ),
            Validator.isNumber(
                "#Products_price",
                "Trường này phải là số dương"
            ),
            Validator.isNumber(
                "#products_quantity",
                "Trường này phải là số dương"
            ),
        ],
    });

    //form-dan tri

    //customer
});
document.addEventListener("DOMContentLoaded", function () {
    Validator({
        form: "#form-post-update",
        formGroupSelector: ".form-group",
        errorSelector: ".form-message",
        rules: [
            Validator.isRequired("#title_post", "Vui lòng nhập tên tiêu đề"),
            Validator.isRequired(
                "#desc_post",
                "Vui lòng nhập thông tin hiển chi tiết"
            ),
        ],
        onSubmit: function (data) {
            $.ajax({
                url: "",
                type: "POST",
                datatype: "JSON",
                data: $("#form-post-update").serialize(),
                success: function (res) {
                    removeClass("#btnLoading", "#spanLoading");
                    if (res.error == false) {
                        showMessage("Success", res.message, "success", 10000);
                        setTimeout(() => {
                            window.location.href = "/admin/crawls";
                        }, 2000);
                    } else {
                        showMessage("Error", res.message, "error", 10000);
                    }
                },
            });
        },
    });
    // add shopify products
    Validator({
        form: "#form_add_product_shopify",
        formGroupSelector: ".form-group",
        errorSelector: ".form-message",
        rules: [Validator.isRequired("#title", "Vui lòng nhập tên sản phẩm")],
    });
});
// document.addEventListener('DOMContentLoaded',function(){
//     function getData(){
//         $.ajax({
//             url:'/admin/category/data',
//             type:'get',
//             success:function(res){
//                     const bodyTable=document.getElementById('show_table');
//                     const form=document.getElementById('form-add-cate');
//                      form.reset()
//                     var key=0;
//                     var html=res.data.map(item=>{
//                         key++;
//                         return `<tr>
//                         <td>${key}</td>
//                         <td>${item.name}</td>
//                         <td>${new Date(item.created_at).toLocaleDateString('vi-VN')}</td>
//                         <td style="">
//                             <a href="/admin/category/list/${item.id}">
//                                 <button type="button" class="btn btn-info btn-circle btn-lg"><i class="fas fa-edit"></i></button>
//                             </a>
//                             <a href="/admin/category/destroy/${item.id}" >
//                                 <button class="btn btn-danger btn-circle btn-lg"><i class="fas fa-trash"></i></button>
//                             </a>

//                         </td>
//                       </tr>`;
//                     });
//                     bodyTable.innerHTML=html.join('');

//                 }
//         });
//     }
//     getData();

//     Validator({
//         form: '#form-add-cate',
//         formGroupSelector: '.form-group',
//         errorSelector: '.form-message',
//         rules:[Validator.isRequired('#category_name', 'Vui lòng nhập tên danh mục'),],
//         onSubmit:function(data){
//             $.ajax({
//                 url:'/admin/category/list',
//                 type:'POST',
//                 datatype:'JSON',
//                 data:$('#form-add-cate').serialize(),
//                 success:function(res){
//                     if(res.error == false){
//                         getData();
//                         showMessage('Success',res.message,'success',10000);
//                     }else{
//                         showMessage('Error',res.message,'error',10000);

//                     }
//                 }
//             });
//         }
//     });
// });
