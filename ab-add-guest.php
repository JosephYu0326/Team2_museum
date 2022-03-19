<?php
$title = '新增活動嘉賓';
$pageName = 'ab-add-guest';
?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>
<style>
    form .mb-3 .form-text{
        color: red;
    }

</style>
<div class="content-wrapper">

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增嘉賓資料</h5>
                    <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">
                        <div class="mb-3">
                            <label for="name" class="form-label">* 嘉賓名稱</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">* 嘉賓圖片</label>
                            <input type="text" class="form-control" id="img" name="img" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="Profession" class="form-label">* 嘉賓職業</label>
                            <input type="text" class="form-control" id="Profession" name="Profession" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">* 嘉賓公司</label>
                            <input type="text" class="form-control" id="company" name="company" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="a-url" class="form-label">* 嘉賓網址</label>
                            <input type="url" class="form-control" id="a-url" name="a-url" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">嘉賓介紹</label>
                            <textarea class="form-control" name="text"
                            id="text" 
                            cols="30" 
                            rows="3"></textarea>

                            <div class="form-text"></div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">新增</button>
                    </form>

                </div>
            </div>
        </div>
    </div>





</div>
<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    
    const name = document.form1.name;// DOM element
    const name_msg = name.closest('.mb-3').querySelector('.form-text');
  
    function checkForm(){
        let isPass = true; // 有沒有通過檢查

         name_msg.innerText = '';  // 清空訊息
       

        // TODO: 表單資料送出之前, 要做格式檢查

        if(name.value.length<2){
            isPass = false;
            name_msg.innerText = '請填寫正確的姓名'
        }

        if(isPass){
            const fd = new FormData(document.form1);

            fetch('ab-add-guest-api.php', {
                method: 'POST',
                body: fd
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if(obj.success){
                    alert('新增成功');
                    // location.href = 'ab-list.php';
                } else {
                    alert('新增失敗');
                }

            })


        }


    }


</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>