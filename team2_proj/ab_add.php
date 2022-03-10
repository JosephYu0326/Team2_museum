<?php
require __DIR__ . '/parts/connect_db.php';
$title = '新增商品';
$pageName = 'products_add';
/*
$perPage = 5; // 每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //用戶要看的頁碼
if ($page < 1) {
    header('Location: ab_list.php?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM address_book";

// 取得總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$rows = []; //預設沒有資料
$totalPages = 0;

if ($totalRows) {
    // 總頁數
    $totalPages = ceil($totalRows / $perPage);
    if ($page > $totalPages) {
        header("Location: ab_list.php?page=$totalPages");
        exit;
    }
}

$sql = sprintf("SELECT * FROM address_book ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
$rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
*/
?>

<?php include __DIR__ . '/parts/html_head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>

<style>
    form .mb-3 .form-text {
        color: red;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增商品</h5>
                    <form name="form_1" method="post" novalidate onsubmit="checkForm(); return false;">

                        <div class="mb-3">
                            <label for="name" class="form-label">品名</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="intro" class="form-label">簡介</label>
                            <input type="text" class="form-control" id="intro" name="intro">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="main" class="form-label">商品介紹</label>
                            <textarea class="form-control" id="main" name="main"></textarea>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="more_info" class="form-label">商品相關介紹</label>
                            <textarea class="form-control" id="more_info" name="more_info"></textarea>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="size" class="form-label">商品規格</label>
                            <textarea name="size" id="size" cols="30" rows="3" class="form-control"></textarea>

                            <div class="form-text"></div>
                        </div>

                        <label for="orign_price" class="form-label">商品原價</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="orign_price" name="orign_price">
                            <span class="input-group-text">.00</span>
                        </div>

                        <label for="price" class="form-label">商品售價</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="price" name="price">
                            <span class="input-group-text">.00</span>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">商品庫存量</label>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                            
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">商品類別</label>
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control"></textarea>

                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">商品院別</label>
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control"></textarea>

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
    const mobile = document.form_1.mobile; // DOM element
    const mobile_msg = mobile.closest('.mb-3').querySelector('.form-text');

    const name = document.form_1.name;
    const name_msg = name.closest('.mb-3').querySelector('.form-text');

    function checkForm() {
        let isPass = true; // 有沒有通過檢查

        name_msg.innerText = ''; // 清空訊息
        mobile_msg.innerText = ''; // 清空訊息

        // TODO: 表單資料送出之前, 要做格式檢查

        if (name.value.length < 2) {
            isPass = false;
            name_msg.innerText = '請填寫正確的姓名'
        }

        const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/; // new RegExp()

        if (mobile.value) {
            // 如果不是空字串就檢查格式
            if (!mobile_re.test(mobile.value)) {
                mobile_msg.innerText = '請輸入正確的手機號碼';
                isPass = false;
            }
        }

        if (isPass) {
            const fd = new FormData(document.form_1);

            fetch('ab_add_api.php', {
                    method: 'POST',
                    body: fd
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('新增成功');
                        // location.href = 'ab_list.php';
                    } else {
                        alert('新增失敗');
                    }
                })
        }
    }
</script>
<?php include __DIR__ . '/parts/html_foot.php'; ?>