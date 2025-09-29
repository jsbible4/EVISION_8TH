<?php 
//db 연결 
$db_host="localhost"; 
$db_user = "root"; 
$db_pass=""; 
$db_name="my_db"; 
$db_port = 3307; 

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);

if($conn->connect_error){
    die("데이터베이스 연결 실패: " . $conn->connect_error); // connect_error로 수정
}

//login.html에서 POST 방식으로 보낸 데이터 받기 
// 그냥 받으면 sql injection에 취약 

// POST 값 받기 (간단 검증 포함)
// isset()으로 존재여부 확인 
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

//htmlspecialchars() : 사용자의 입력에서 특수 문자를 안전한 형태로 변환해준다 
//xss 공격을 방지 
htmlspecialchars($username);
htmlspecialchars($password);



// SQL 쿼리 작성(입력받은 username과 password가 일치하는 사용자 찾기) 

// Prepared Statement: username으로 사용자 조회 (SQL Injection 방지)
$sql = "SELECT id, username FROM users WHERE username = ? AND password = ?"; //SQL 문자열에 ? 플레이스홀더를 사용해 쿼리 틀을 먼저 DB에 보냄(prepare()).
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("서버 오류가 발생했습니다: " .$conn->error );
}
$stmt->bind_param("ss", $username, $password); //bind_param("ss", $username, $password)로 플레이스홀더에 문자열(ss) 데이터를 바인딩.
$stmt->execute();
$result = $stmt->get_result();



if ($result && $result->num_rows > 0) {
    // 로그인 성공
    //일치하는 사용자가 있으면(결과 행이 1개 이상이면)
    echo "<h1>로그인 성공!</h1>";
    echo "<p>'$username'님, 환영합니다.</p>";
} else {
    // 실패
    echo "<h1>로그인 실패</h1>";
    echo "<p>아이디 또는 비밀번호가 올바르지 않습니다.</p>";
    echo '<a href="login.html">다시 시도하기</a>'; // 다시 login.html 실행 
}


//DB 연결 종료 
$stmt->close();
$conn->close(); 
?>
