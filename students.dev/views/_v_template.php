<!DOCTYPE html>
<html>
<head>
    <title><?php if(isset($title)) echo $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
   
    <!-- Specify favicon -->
    <link rel="icon" type="image/x-icon" href="/images/smalltalk.ico">

    <!-- Main CSS for all views -->
    <link type="text/css" rel="stylesheet" href="/css/main.css">

    <!--  CSS for header specific formatting -->
    <link type="text/css" rel="stylesheet" href="/css/header.css">

    <!-- include the jstz library hosted on cdnjs -->
    <link type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.js">

    <!-- we need the timezone in most pages, so add the script to get the timezone here as well -->
    <script>
        $('input[name=timezone]').val(jstz.determine().name());
    </script>

    <!-- Controller Specific JS/CSS -->
    <?php if(isset($client_files_head)) echo $client_files_head; ?>

</head>

<body>
    <!-- Header for all pages -->
    <div id="headerdiv">
        <header id="pageHeader" >
            <div id="logo">
                <img id="logo" src="/images/smalltalk.png" width="120px" height="80px" alt="Small Talk with Big Impact" />
            </div>
            <div id="navigation">
                <?php if($user): ?> 
                    <!-- user is logged in, show member navigation bar -->
                    <?php require_once(APP_PATH."/views/v_membernavigation.php"); ?>
                <?php elseif ($title != 'Login'): ?>
                    <!-- non-logged in user, show login navigation bar -->
                    <?php require_once(APP_PATH."/views/v_visitornavigation.php"); ?>
                <?php endif; ?>
            </div>
        </header>
    </div>

    <!-- Main Content -->
    <div id="contentdiv">
        <section id="maincontent">
            <?php if(isset($content)) echo $content; ?>
        </section>
    </div>

    <div id="footerdiv">
        <footer id="pageFooter">
            <h5>Copyright 2013 Small Talk</h5>
        </footer>
    </div>

    <?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>