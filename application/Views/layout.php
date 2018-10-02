<html>
   <head></head> <!-- move code from welcome_message.php's html <head> to here -->
   <body>
        <!-- move code from welcome_message.php's style to here, 
             or use separate file for css and apply to <head>
        -->
        <h1>Hello</h1>
        <div class="wrap">
            <?php echo $content; ?>
        </div>
   </body>
</html>