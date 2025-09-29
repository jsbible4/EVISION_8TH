## 로그인 시스템의 sql injection 발생 부분 패치


### sql injection 취약점
- 사용자 입력을 그대로 SQL에 붙이면 공격자가 ' OR 1=1 -- 같은 걸 넣어 로그인 우회 가능합니다.
<img width="514" height="374" alt="image" src="https://github.com/user-attachments/assets/e3d53c6c-a02a-44ff-977f-1b9ce598196b" />
<img width="468" height="216" alt="image" src="https://github.com/user-attachments/assets/d2a94965-c263-4b41-9e72-690a9ba386c1" />

  
### 해결방법
- 쿼리의 구조(SQL 코드)와 데이터(사용자 입력값)를 분리해서 처리하는 방식을 사용합니다(Prepared statement) 
DB에 쿼리 틀을 먼저 보내고 ?(placeholder)에 값을 바인딩해서 실행합니다 이러면 입력값이 SQL 구문으로 해석되지 않고 항상 데이터로만 처리돼서 SQL Injection을 막습니다.
 <img width="1028" height="215" alt="Screenshot 2025-09-29 at 3 28 07 PM" src="https://github.com/user-attachments/assets/a57db0ae-7861-41a8-b0f2-7ef5fef24917" />

<img width="938" height="562" alt="image" src="https://github.com/user-attachments/assets/bceead2d-c8d2-4dc2-9672-236d0ef94fb9" />
<img width="680" height="250" alt="image" src="https://github.com/user-attachments/assets/357350a3-9fc4-4f61-9de5-0fc728266556" />


### 실행방법
브라우저에서 http://localhost/login_project/login.html 으로 접속 

