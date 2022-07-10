var array=['vanian'];
function addArray(){
    array.push('varian1');
    showVarianLoad();
}
function delArray(index){
    array.splice(index,1);
    showVarianLoad();
}

function showVarianLoad(){
const showVarian=document.querySelector('#show_varians');

    var html=array.map((e,index)=>{
        index++;
        return `<div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Variants ${index} </h3>
            <button onclick="delArray(${--index})" type="button" class="btn btn-danger float-right"><i class="fas fa-trash"></i>
                </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col col-sm-6">
                    <div class="form-group">
                        <label for="title_sub">Tên loại </label>
                        <input type="text" class="form-control" id="title_sub" name="title_${index}" placeholder="Tên loại">
                        <input type="hidden" class="form-control" id="title_sub" name="total" value="${array.length}" placeholder="Tên loại">
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="text" class="form-control" id="price" name="price_${index}" placeholder="Giá">
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="form-group">
                        <label for="quantity">Số lượng</label>
                        <input type="text" class="form-control" id="quantity" name="quantity_${index}" placeholder="Số lượng">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="images_${index}">Hình ảnh</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="images_${index}" id="images_${index}">
                        <label class="custom-file-label" for="images_${index}">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div>
            

        </div>
    </div>`;
    });

    showVarian.innerHTML=html.join('')
}
