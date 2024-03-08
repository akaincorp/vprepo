<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="img/icon.png" type="image/icon type">
  <style>

* {
    margin: 0;
}

.container-notification {
  display: flex;
  position: fixed;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100vh;
  z-index: 999;
  background-color: #00000065;
}

.notification-success {
  background-color: rgb(161, 204, 253);
  border-radius: 5px;
  width: 21%;
  height: 25%;
  box-shadow: 3px 3px 8px 3px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.close-button {
  position: absolute;
  right: 40%;
  font-size: 20px;
  cursor: pointer;
  color: white;
  background: red;
  width: 3%;
  text-align: center;
  border: 2px solid white;
}

.title {
  display: inline-block;
  position: relative;
  right: 38%;
  font-weight: 400;
  font-size: 18px;
  padding: 5px;
}

.content{
  position: relative;
}

.content-top {
  display: flex;
  align-items: center;
  justify-content: start;
  padding-left: 20px;
  width: 88%;
  height: 50%;
  background-color: white;
  border-right: 1px solid black;
  border-top: 1px solid black;
  border-left: 1px solid rgba(99, 99, 99, 0.562);
}

.content-down {
  display: flex;
  align-items: center;
  justify-content: start;
  padding-left: 20px;
  width: 88%;
  height: 26%;
  background-color: rgb(235, 234, 234);
  border-right: 1px solid black;
  border-left: 1px solid rgba(99, 99, 99, 0.562);
  border-bottom: 1px solid black;

}

.content-down button {
  width: 30%;
  height: 60%;
  margin-left: 67%;
  box-shadow: 1px 1px 0px 1px;
}
  </style>
</head>
<body>
 
<div class="container-notification" id="container">
    <div class="notification-success">
      <h1 class="title">Veon</h1>
      <span class="close-button" onclick="toLoginPage()" >&times;</span>
      <div class="content-top">
        <p id="status">You are not logged in!</p>
      </div>
      <div class="content-down">
        <button onclick="toLoginPage()">OK</button>
      </div>
    </div>
  </div>
  
  <script>
    function toLoginPage() {
        window.location.href = "login.php"
    }
  </script>
</body>
</html>