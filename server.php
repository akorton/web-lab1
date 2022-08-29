<html>
    <head>
        <meta charset="utf-8">
        <title>Result table</title>
    </head>
    <body>
        <?php 
            session_start();
            $_SESSION['mySession'][] = $_GET;
        ?>
        <table align="center" cellpadding="5" cellspacing="10" border="2" width="100%">
            <tr>
                <td colspan="4" align="right"><button onclick="redirectToMainPage()">Back</button></td>
            </tr>
            <tr>
                <td>X</td>
                <td>Y</td>
                <td>R</td>
                <td>Is in</td>
            </tr>
            <?php  foreach ($_SESSION['mySession'] as $requests){
                $format = '<td>%s</td>';
                echo '<tr>';
                echo sprintf($format, $requests['x']);
                echo sprintf($format, $requests['y']);
                echo sprintf($format, $requests['radius']);
                echo sprintf($format, 'false');
                echo '</tr>';
            } ?>
        </table>
    </body>
</html>
<script>
    let redirectToMainPage = ()=>{
        let hrefArray = window.location.href.split('/');
        let newArray = [...hrefArray.splice(0, hrefArray.length - 1), 'index.html'];
        window.location.href = newArray.join("/");
    }

</script>
