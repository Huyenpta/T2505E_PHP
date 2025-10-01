<?php
echo "BTVN";
//1) Tính chu vi & diện tích hình chữ nhật 
function CV_DT($d, $r){
    $chuvi = 2 * ($d + $r);
    $dientich = $d * $r;
    return array("chuvi" => $chuvi, "dientich" => $dientich);
}
$result = CV_DT(5, 11);
echo "<br> Chu vi = " . $result["chuvi"];
echo "<br> Diện tích = " . $result["dientich"];

//2) Chuyển đổi độ C sang độ F 
function DOI_DO($c){
    return $c*9/5+32;
}
$F = DOI_DO(25);
echo "<br> $F độ F <br>";

//3) Kiểm tra số chẵn/lẻ 
function CHECK_CHAN_LE($n){
    if ($n%2==0){
        return "$n là số chẵn";
    } else{
        return "$n là số lẻ";
    }
}
$relt = CHECK_CHAN_LE(8);
echo "$relt";

// 4) Ghép chuỗi họ tên 
// Mục tiêu: Xử lý chuỗi, trim, ucirst.	
// • Yêu cầu:	
// • Nhập họ, tên (string).	
// • In Họ Tên chuẩn hóa việt hoa chữ cái đầu.	
// Ví dụ: Input: 'nguyen',	'cuong'	-> 'Nguyen Cuong'
function GHEP_CHUOI($ho,$ten){
    $ho=strtolower(trim($ho));
    $ten=strtolower(trim($ten));
    $ho=ucfirst($ho);
    $ten=ucfirst($ten);
    return "$ho $ten";

}
$hoten=GHEP_CHUOI("nguyen", "cuong");
echo ("<br>$hoten");
//5) Bảng cửu chương 
//Mục tiêu:	for	loop cơ	bản, in định dạng.	
//• Yêu cầu:
//• In bảng cửu chương 1..9 dùng for lồng nhau.	
//• Mỗi	dòng:	'2	x	3	=	6'.	
//Ví dụ: Hiển thị đủ 81 phép	nhân.	
function IN_BANG_CUU_CHUONG(){
    for ($i=1;$i<=9;$i++){
        echo "<br>Bảng cửu chương $i<br>";
        for ($j=1;$j<=9;$j++){
            $s=$i*$j;
            echo "$i*$j=$s<br>";
        }
        echo "<br>";
    }
}
IN_BANG_CUU_CHUONG();
// 6) Đếm số nguyên tố trong mảng 
// Mục tiêu: Mảng, hàm, vòng lặp, kiểm tra nguyên tố.	
// • Yêu cầu:	
// • Nhập mảng số nguyên (vd: '2,3,4,5,10').
// • Viết hàm isPrime($x) trả về bool.
// • Đếm và in số lượng phần tử nguyên tố.
// Ví dụ: Input: 2,3,4,5,10 -> Output: 3
function isPrime($x) {
    if ($x < 2) return false;
    for ($i = 2; $i <= sqrt($x); $i++) {
        if ($x % $i == 0) return false;
    }
    return true;
}

function countPrimesInArray($arr) {
    $count = 0;
    foreach ($arr as $value) {
        if (isPrime($value)) {
            $count++;
        }
    }
    return $count;
}
$input = "2,3,4,5,10";   
$arr = array_map('intval', explode(',', $input));
$kq = countPrimesInArray($arr);
echo "Mảng: " . implode(", ", $arr) . "<br>";
echo "Số phần tử nguyên tố = $kq";
// 7) Tìm max, min, trung bình
// Mục tiêu: Mảng số, duyệt mảng, toán học.	
// • Yêu cầu:	
// • Nhập mảng số (loat).	
// • In max, min, avg (2 chữ số). Không dùng trực tiếp max()/min()	nếu GV yêu cầu.	
// Ví dụ: Input: 1,5,2 -> max=5, min=1, avg=2.67
function findMaxMinAvg($arr) {
    $n = count($arr);
    $max = $arr[0];
    $min = $arr[0];
    $sum = 0;
    foreach ($arr as $value) {
        if ($value > $max) $max = $value;
        if ($value < $min) $min = $value;
        $sum += $value;
    }
    $avg = $sum / $n;

    echo "Max = " . number_format($max, 2) . "<br>";
    echo "Min = " . number_format($min, 2) . "<br>";
    echo "Avg = " . number_format($avg, 2);
}
$input = "1,5,2"; 
$arr = array_map('floatval', explode(',', $input));
echo "<br>Mảng: " . implode(", ", $arr) . "<br>";
findMaxMinAvg($arr);
// 8) Máy tính 4 phép nhân
// Mục tiêu: Form xử lý POST, switch-case.	
// • Yêu cầu:	
// • Nhập a, b và phép (+ - * /).	
// • Xử lý	chia cho 0.	
// • Hiển thị kết quả.	
// Ví dụ: a=6, b=2, op='/'-> 3
$result = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = floatval($_POST["a"]);
    $b = floatval($_POST["b"]);
    $op = $_POST["op"];

    switch ($op) {
        case '+':
            $result = $a + $b;
            break;
        case '-':
            $result = $a - $b;
            break;
        case '*':
            $result = $a * $b;
            break;
        case '/':
            if ($b == 0) {
                $result = "Lỗi: Không thể chia cho 0";
            } else {
                $result = $a / $b;
            }
            break;
        default:
            $result = "Phép toán không hợp lệ";
    }
}
// 9) Kiểm tra năm nhuận
// Mục tiêu: Điều kiện lồng nhau,	module.
// • Yêu cầu:
// • Nhập năm (int).
// • Năm nhuận nếu (chia hết cho 400) hoặc (chia hết 4 nhưng không chia hết 100).
// Ví dụ: Input: 2000 -> Leap; 1900 -> Not Leap
function isLeapYear($year) {
    if ($year % 400 == 0) {
        return true;
    } else if ($year % 4 == 0 && $year % 100 != 0) {
        return true;
    } else {
        return false;
    }
}
echo "<br>Kiểm tra năm nhuận:";
$year1 = 2000;
$year2 = 1900;
$year3 = 2024;
echo "<br>$year1 -> " . (isLeapYear($year1) ? "Leap" : "Not Leap") . "<br>";
echo "$year2 -> " . (isLeapYear($year2) ? "Leap" : "Not Leap") . "<br>";
echo "$year3 -> " . (isLeapYear($year3) ? "Leap" : "Not Leap") . "<br>";
// 10) Đếm số lần xuất hiện ký tự
// Mục tiêu: Chuỗi, duyệt	ký	tự, case-insensitive.	
// • Yêu cầu:
// • Nhập chuỗi s và ký tự c.	
// • Đếm số	lần c xuất hiện trong s (không phân biệt hoa thường).	
// Ví dụ: s='Hello', c='l' -> 2	
function countChar($s, $c) {
    $s = strtolower($s);
    $c = strtolower($c);
    $count = 0;
    for ($i = 0; $i < strlen($s); $i++) {
        if ($s[$i] === $c) {
            $count++;
        }
    }
    return $count;
}
$s = "Hello";
$c = "l";
echo "Số lần '$c' xuất hiện trong '$s' = " . countChar($s, $c);
// 11) Danh sách sản phẩm (mảng kết hợp)
// Mục tiêu: Mảng kết hợp, foreach, định	dạng.	
// • Yêu cầu:	
// • Tạo mảng	sản phẩm: name, price, qty.	
// • In	bảng HTML:	STT, Tên, Giá, SL, Thành	tiền, Tổng cộng.
// Ví dụ: 3 sản phẩm giả lập, tổng tiền cuối bảng.
$products = [
    ["name" => "Trà Xanh",   "price" => 15000, "qty" => 2],
    ["name" => "Cà Phê",     "price" => 25000, "qty" => 1],
    ["name" => "Nước Cam",  "price" => 20000, "qty" => 3],
];
$total = 0;
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr>
        <th>STT</th>
        <th>Tên sản phẩm</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
      </tr>";
$stt = 1;
foreach ($products as $p) {
    $thanhtien = $p["price"] * $p["qty"];
    $total += $thanhtien;
    echo "<tr>";
    echo "<td>$stt</td>";
    echo "<td>{$p['name']}</td>";
    echo "<td>" . number_format($p['price'], 0, ',', '.') . "</td>";
    echo "<td>{$p['qty']}</td>";
    echo "<td>" . number_format($thanhtien, 0, ',', '.') . "</td>";
    echo "</tr>";

    $stt++;
}
echo "<tr>
        <td colspan='4' align='right'><b>Tổng cộng</b></td>
        <td><b>" . number_format($total, 0, ',', '.') . "</b></td>
      </tr>";
echo "</table>";
// 12) Hàm chuẩn hóa tên người dùng
// Mục tiêu: Hàm, xử lý khoảng trắng, chữ hoa/thường.
// • Yêu cầu:
// • Viết hàm normalizeName($s): trim, bỏ	khoảng	trang thừa, mỗi từ viết hoa chữ cái đầu.	
// • Vı́ dụ:'		nGuYEN			vAN			A	'	->	'Nguyen	Van	A'.
// Ví dụ: Gọi hàm	với nhiều test case.
function normalizeName($s) {
    $s = trim($s);
    $s = preg_replace('/\s+/', ' ', $s);
    $s = ucwords(strtolower($s));
    return $s;
}
echo normalizeName("		nGuYEN			vAN			A	") . "<br>";
echo normalizeName("  tRan    thI    B   ") . "<br>";
echo normalizeName("lE    hOaNg    nAM") . "<br>";
// 13) Kiểm tra mật khẩu mạnh
// Mục tiêu: Regex, điều kiện kết hợp.
// • Yêu cầu:	
// • Nhập password.	
// • Yêu cầu: ≥8 ký tự, có chữ hoa, chữ thường, số, ký tự đặc biệt.
// • In 'Mạnh' hoặc các lý do chưa đạt.
// Ví dụ: Input: 'Abc@1234' -> Mạnh
function checkPassword($pwd) {
    $errors = [];
    if (strlen($pwd) < 8) {
        $errors[] = "Mật khẩu phải có ít nhất 8 ký tự";
    }
    if (!preg_match('/[A-Z]/', $pwd)) {
        $errors[] = "Mật khẩu phải có ít nhất 1 chữ hoa";
    }
    if (!preg_match('/[a-z]/', $pwd)) {
        $errors[] = "Mật khẩu phải có ít nhất 1 chữ thường";
    }
    if (!preg_match('/[0-9]/', $pwd)) {
        $errors[] = "Mật khẩu phải có ít nhất 1 số";
    }
    if (!preg_match('/[\W_]/', $pwd)) { 
        $errors[] = "Mật khẩu phải có ít nhất 1 ký tự đặc biệt";
    }
    if (empty($errors)) {
        return "Mạnh";
    } else {
        return implode("; ", $errors);
    }
}
echo checkPassword("Abc@1234") . "<br>";
echo checkPassword("abc123") . "<br>";
echo checkPassword("ABC12345") . "<br>";
// 14) Tính điểm trung bình & xếp loại
// Mục tiêu: Mảng, tı́nh trung bı̀nh, if-elseif.
// • Yêu cầu:
// • Nhập điểm Toán, Lý, Hóa (0..10).	
// • Tı́nh TB và xếp loại: Giỏi (≥8), Khá (6.5..<8), Trung bı̀nh (5.. <6.5), Yeu (<5).	
// Ví dụ: 8,7,9 -> TB=8.00, Loại=Giỏi
function xepLoai($toan, $ly, $hoa) {
    $tb = ($toan + $ly + $hoa) / 3;
    $tb_format = number_format($tb, 2);
    if ($tb >= 8) {
        $loai = "Giỏi";
    } elseif ($tb >= 6.5) {
        $loai = "Khá";
    } elseif ($tb >= 5) {
        $loai = "Trung bình";
    } else {
        $loai = "Yếu";
    }
    return "Điểm TB = $tb_format, Loại = $loai";
}
echo xepLoai(8, 7, 9) . "<br>";
echo xepLoai(6, 7, 6.5) . "<br>";
echo xepLoai(5, 5, 4.5) . "<br>";
// 15) Tính tiền điện theo bậc thang
// Mục tiêu: Điều kiện nhiều nhánh, tı́nh lũy tiền.	
// • Yêu cầu:	
// • Nhập kWh trong tháng.
// • Áp dụng 3–4 bậc giá (GV cung cap) theo lũy tiền, in	hóa đơn chi tiết từng bậc	+ tổng.	
// Ví dụ: Vı́ dụ 150kWh: bậc 1 50, bậc 2 50, bậc 3 50.
function tinhTienDien($kwh) {
    $bac = [
        ["muc" => 50,  "gia" => 1800],
        ["muc" => 50,  "gia" => 2000],
        ["muc" => 100, "gia" => 2500],
        ["muc" => INF, "gia" => 3000],
    ];
    $tong = 0;
    $chiTiet = [];
    $conlai = $kwh;
    foreach ($bac as $b) {
        if ($conlai <= 0) break;
        $soKwh = min($conlai, $b["muc"]);
        $tien = $soKwh * $b["gia"];
        $chiTiet[] = [
            "soKwh" => $soKwh,
            "gia"   => $b["gia"],
            "tien"  => $tien
        ];
        $tong += $tien;
        $conlai -= $soKwh;
    }
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Bậc</th><th>Số kWh</th><th>Đơn giá</th><th>Thành tiền</th></tr>";
    $i = 1;
    foreach ($chiTiet as $ct) {
        echo "<tr>
                <td>Bậc $i</td>
                <td>{$ct['soKwh']}</td>
                <td>" . number_format($ct['gia'], 0, ',', '.') . "</td>
                <td>" . number_format($ct['tien'], 0, ',', '.') . "</td>
              </tr>";
        $i++;
    }
    echo "<tr><td colspan='3' align='right'><b>Tổng cộng</b></td>
          <td><b>" . number_format($tong, 0, ',', '.') . "</b></td></tr>";
    echo "</table>";
}
tinhTienDien(150);
// 16) Quản lý sinh viên (mảng + hàm)
// Mục tiêu: Hàm CRUD trên mảng, tı̀m kiếm, lọc.
// • Yêu cầu:
// • Tạo mảng sinh viên: id, name, gpa.
// • Viết các hàm: add, update, delete, indByName (like), sortByGpa(desc).
// • In menu CLI để thao tác (1 - Thêm, 2 - Sửa,...).	
// Ví dụ: Thêm 3 SV mẫu, thử tı̀m & sắp xếp.
session_start();

// Nếu chưa có dữ liệu, khởi tạo mảng SV
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [
        ["id" => 1, "name" => "Nguyen Van A", "gpa" => 3.2],
        ["id" => 2, "name" => "Tran Thi B", "gpa" => 3.8],
        ["id" => 3, "name" => "Le Van C", "gpa" => 2.9],
    ];
}

$students = &$_SESSION['students'];

// Thêm SV
if (isset($_POST['add'])) {
    $students[] = [
        "id" => $_POST['id'],
        "name" => $_POST['name'],
        "gpa" => $_POST['gpa']
    ];
}

// Xóa SV
if (isset($_GET['delete'])) {
    foreach ($students as $k => $sv) {
        if ($sv['id'] == $_GET['delete']) unset($students[$k]);
    }
}

// Sắp xếp
if (isset($_GET['sort'])) {
    usort($students, function($a, $b) {
    return $b['gpa'] <=> $a['gpa'];
});
}

// Hiển thị
echo "<h2>Danh sách SV</h2>";
echo "<table border='1' cellpadding='5'><tr><th>ID</th><th>Tên</th><th>GPA</th><th>Action</th></tr>";
foreach ($students as $sv) {
    echo "<tr>
            <td>{$sv['id']}</td>
            <td>{$sv['name']}</td>
            <td>{$sv['gpa']}</td>
            <td><a href='?delete={$sv['id']}'>Xóa</a></td>
          </tr>";
}
echo "</table>";
echo "<a href='?sort=1'>Sắp xếp theo GPA giảm dần</a>";

echo "<h3>Thêm SV</h3>
<form method='post'>
  ID: <input type='text' name='id'><br>
  Tên: <input type='text' name='name'><br>
  GPA: <input type='text' name='gpa'><br>
  <input type='submit' name='add' value='Thêm'>
</form>";
// 17) Bộ lọc sản phẩm theo khoảng giá
// Mục tiêu: Form GET/POST, validate, filter array.
// • Yêu cầu:
// • Có mảng sản phẩm (name,	price).
// • Nhập minPrice, maxPrice -> lọc & in kết quả, xử lý min>max.
// Ví dụ: min=100k, max=300k -> in các sp trong khoảng.	
// Danh sách sản phẩm (giả lập)
$products = [
    ["name" => "Trà Xanh", "price" => 100000],
    ["name" => "Trà Oolong", "price" => 200000],
    ["name" => "Trà Đen", "price" => 300000],
    ["name" => "Trà Sen", "price" => 400000],
    ["name" => "Trà Nhài", "price" => 500000],
];

// Lấy dữ liệu từ form
$min = isset($_GET['minPrice']) ? (int)$_GET['minPrice'] : 0;
$max = isset($_GET['maxPrice']) ? (int)$_GET['maxPrice'] : 0;

$filtered = [];
$error = "";

// Xử lý lọc
if ($_GET) {
    if ($min > $max) {
        $error = "⚠️ Giá min phải nhỏ hơn hoặc bằng max!";
    } else {
        foreach ($products as $p) {
            if ($p['price'] >= $min && $p['price'] <= $max) {
                $filtered[] = $p;
            }
        }
    }
}

// 18) Tạo hàm định dạng tiền tệ VNĐ
// Mục tiêu: Hàm, number_format, locale.
// • Yêu cầu:	
// • Viết hàm vnd($n): trả về chuỗi '1.234.567₫'.
// • Áp dụng vào bảng sản phẩm để hiển thị đẹp.
// Ví dụ: 1234567 -> '1.234.567₫'
// Hàm định dạng tiền VNĐ
function vnd($n) {
    return number_format($n, 0, ',', '.') . "₫";
}

// Test thử
echo vnd(1234567); // Kết quả: 1.234.567₫

// Ví dụ áp dụng vào mảng sản phẩm
$products = [
    ["name" => "Trà Xanh", "price" => 100000],
    ["name" => "Trà Oolong", "price" => 250000],
    ["name" => "Trà Sen", "price" => 1234567],
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>BTVN</title>
</head>
<body>
    <h2>Máy tính 4 phép</h2>
    <form method="post">
        Nhập a: <input type="text" name="a" required> <br><br>
        Nhập b: <input type="text" name="b" required> <br><br>
        Phép toán: 
        <select name="op">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <br><br>
        <button type="submit">Tính</button>
    </form>

    <?php if ($result !== ""): ?>
        <h3>Kết quả: <?php echo $result; ?></h3>
    <?php endif; ?>
    <h2>Bộ lọc sản phẩm</h2>
    <form method="get">
        Min Price: <input type="number" name="minPrice" value="<?= htmlspecialchars($min) ?>"> <br>
        Max Price: <input type="number" name="maxPrice" value="<?= htmlspecialchars($max) ?>"> <br>
        <button type="submit">Lọc</button>
    </form>

    <?php if ($error): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <?php if ($_GET && !$error): ?>
        <h3>Kết quả lọc:</h3>
        <?php if (count($filtered) > 0): ?>
            <ul>
                <?php foreach ($filtered as $sp): ?>
                    <li><?= $sp['name'] ?> - <?= number_format($sp['price']) ?> VND</li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Không có sản phẩm nào trong khoảng giá.</p>
        <?php endif; ?>
    <?php endif; ?>
     <h2>Danh sách sản phẩm</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
        </tr>
        <?php foreach ($products as $i => $p): ?>
        <tr>
            <td><?= $i+1 ?></td>
            <td><?= $p['name'] ?></td>
            <td><?= vnd($p['price']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>