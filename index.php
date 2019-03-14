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
</html>