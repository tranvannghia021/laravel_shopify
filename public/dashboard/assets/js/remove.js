
// remove
function toggleClickRemove(url){
    
    Swal.fire({
        title: 'Bạn Chắc Chứ?',
        text: "Bạn sẽ không thể phục hồi dữ liệu lại khi bạn chọn có!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes,Delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:url,
                type:'DELETE',
                datatype:'JSON',
                data:$('#form-delete').serialize(),
                success:function(res){
                    if(res.error == false){
                        showMessage('Success',res.message,'success',10000)
                        setTimeout(()=>{
                           location.reload()
                    },1000)
                    }else{
                        showMessage('Error',res.message,'error',10000);
                    }
                }
            });
        }
      })
}