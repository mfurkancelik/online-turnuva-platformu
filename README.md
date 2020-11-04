# Online Turnuca Platformu
## Genel Bilgi
>Projede aynı oyunu oynayan kullanıcıları bir araya getirmek, kullanıcıların oyun bilgisini karşılaştırmalarını sağlamak ve kullanıcılar arasında turnuva düzenlemek için tasarlanmıştır.
## Kullanılan Teknolojiler
- MS SQL
- PHP
- HTML
- CSS
- Java Script
## Veri Tabanı Bağlantı Adımları
>CREATE TABLE user 

(id    INTEGER     NOT NULL,  

 name       NVARCHAR(20)     NOT NULL,  

 nickname       NVARCHAR(30) NOT NULL,  

 email      NVARCHAR(100) NOT NULL, 

 password     NVARCHAR(50) NOT NULL,  

 avatar     NVARCHAR(150),  

 steam_profil   NVARCHAR(150),  

 PRIMARY KEY(id) 

);  

 

CREATE TABLE teams 

( 

id INTEGER NOT NULL, 

user_id INTEGER NOT NULL, 

team_name NVARCHAR(50) NOT NULL, 

team_password NVARCHAR(50) NOT NULL, 

team_image NVARCHAR(50) NOT NULL, 

PRIMARY KEY(id) 

); 

 

CREATE TABLE players 

( 

id INTEGER NOT NULL, 

user_id INTEGER NOT NULL, 

team_id INTEGER NOT NULL, 

permission Binary NOT NULL, 

PRIMARY KEY(id) 

); 

 

CREATE TABLE tournamentparticipant 

( 

id INTEGER NOT NULL, 

team_id INTEGER NOT NULL, 

tour_id INTEGER NOT NULL, 

PRIMARY KEY(id) 

); 

 

CREATE TABLE tournaments 

( 

id INTEGER NOT NULL, 

tournament_name NVARCHAR(50) NOT NULL 

tournament_gamechart NVARCHAR(50) NOT NULL 

tournament_mode NVARCHAR(5) NOT NULL 

tournament_prize NVARCHAR(20) NOT NULL 

tournament_image NVARCHAR(50) NOT NULL 

tournament_starttime DATETIME NOT NULL 

tournament_chart NVARCHAR(25) NOT NULL 

tournament_slot INTEGER NOT NULL 

PRIMARY KEY(id) 

); 

 

CREATE TABLE privatemessage 

( 

pmid INTEGER NOT NULL, 

id INTEGER NOT NULL, 

id2 INTEGER NOT NULL, 

title NVARCHAR(150) NOT NULL, 

user1 NVARCHAR(20) NOT NULL, 

user2 NVARCHAR(50) NOT NULL, 

messages TEXT NOT NULL, 

timestamp DATETIME NOT NULL, 

user1read BINARY NOT NULL, 

user2read BINARY NOT NULL, 

PRIMARY KEY(pmid) 

); 

 

CREATE TABLE news 

( 

id INTEGER NOT NULL, 

title NVARCHAR(50) NOT NULL, 

thumbnail NVARCHAR(100) NOT NULL, 

bigimage NVARCHAR(100) NOT NULL, 

text TEXT NOT NULL, 

author_id INTEGER NOT NULL 

PRIMARY KEY(id) 

); 

 

CREATE TABLE news_slide 

( 

id INTEGER NOT NULL, 

slide_text NVARCHAR(75) NOT NULL, 

slide_image NVARCHAR(75) NOT NULL, 

news_id INTEGER NOT NULL, 

PRIMARY KEY(id) 

); 
## Kurulum
><?php 
$servername = "localhost"; 
$username = "username"; 
$password = "password"; 
 
// Create connection 
$conn = new mysqli($servername, $username, $password); 
 
// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}  
echo "Connected successfully"; 
?> 
## Fotoğraflar
![3](https://user-images.githubusercontent.com/44071320/98150905-6c18bc00-1ee0-11eb-9553-3537923e32eb.png)
![4](https://user-images.githubusercontent.com/44071320/98150896-69b66200-1ee0-11eb-85a1-fa3b3b3c6dc9.png)
![5](https://user-images.githubusercontent.com/44071320/98150900-6b802580-1ee0-11eb-850c-8181bd68a4ee.png)

