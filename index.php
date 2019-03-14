<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <script src="assets/js/vue.js"></script>
    <title>D-baze.me</title>
  </head>
  <body >
    <div class="container" id="app">
      <div class="f-center v welcome-container">
        <div class="f-center v inner-container">
          <h1>Welcome to</h1>
          <?php 
            $images = (object) array(
              'me' => 'assets/images/me',
            );
          ?>
          <avatar class="avatar" src="<?php echo $images->me; ?>/prof1.jpg"></avatar>
          
          <div >
            <h1 v-bind:html="message"></h1>
            {{ message }}
          </div>
        </div>
      </div>
    </div>
    
    <script src="assets/bootstrap/js/jquery.min.js" ></script>
    <script src="assets/bootstrap/js/popper.min.js" ></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" ></script>
    <script src="assets/js/vue-custom-elements.js"></script>
    <script src="app.js"></script>
  </body>
  <script>
    Vue.use(VueCustomElement)
    import Avatar from './components/Avatar.vue';
    Vue.customElement('avatar', Avatar);
    // export default {
    //   components: {
    //     'avatar': Avatar,
    //   }
    // }
  </script>
  <?php
    // 7nkfWd9qzEvV9SSm0ztW4WR2MkDznORm1sqXd9nEcfh9hvmtna8KqmQMbiu1E0ByXPhhYEbLHIzq4ZMDoJvOR0vaU8qEgzFmc6r/BJTJRpn8RnVs55Bb/BE6xGZ+NPwG890CYihV4Sz3NFPaUosf0wdB04t89/1O/w1cDnyilFU=
    $accessToken = "7nkfWd9qzEvV9SSm0ztW4WR2MkDznORm1sqXd9nEcfh9hvmtna8KqmQMbiu1E0ByXPhhYEbLHIzq4ZMDoJvOR0vaU8qEgzFmc6r/BJTJRpn8RnVs55Bb/BE6xGZ+NPwG890CYihV4Sz3NFPaUosf0wdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
#ตัวอย่าง Message Type "Text"
    if($message == "สวัสดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Sticker"
    else if($message == "ฝันดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "2";
        $arrayPostData['messages'][0]['stickerId'] = "46";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Image"
    else if($message == "รูปน้องแมว"){
        $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Location"
    else if($message == "พิกัดสยามพารากอน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
        $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
        $arrayPostData['messages'][0]['latitude'] = "13.7465354";
        $arrayPostData['messages'][0]['longitude'] = "100.532752";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
    else if($message == "ลาก่อน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "131";
        replyMsg($arrayHeader,$arrayPostData);
    }
function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
   exit;
?>
</html>