<html>
    <?php 

        function boolToString($bool){
            return $bool ? 'true' : 'false';
        }
        function isInRectangle($x, $y, $r){
            return -$r/2 <= $x && $x <= 0 && -$r <= $y && $y <= 0;
        }
        function isInTriangle($x, $y, $r){
            return $x >= 0 && $y >= 0 && $x/2 + $y - $r/2 <= 0;
        }
        function isInQuaterCircle($x, $y, $r){
            return $x <= 0 && $y >= 0 && $x * $x + $y * $y <= $r*$r;
        }
        function validate($x, $y, $r){
            if ($x == NULL || $y == NULL || $r == NULL) return false;
            $float_x = floatval($x);
            $float_y = floatval($y);
            $float_r = floatval($r);
            if (strval($float_r) != $r || strval($float_y) != $y || strval($float_x) != $x) return false;
            $correct_x = array(-4, -3, -2, -1, 0, 1, 2, 3, 4);
            if (!in_array($float_x, $correct_x)) return false;
            if (!($float_y <= 3 && $float_y >= -1)) return false;
            $correct_r = array(1, 1.5, 2, 2.5, 3);
            if (!in_array($float_r, $correct_r)) return false;
            return true;
        }
        function isInArea($x, $y, $r){
            return boolToString(isInRectangle($x, $y, $r) || isInTriangle($x, $y, $r) || isInQuaterCircle($x, $y, $r));
        }

    ?>
    <head>
        <meta charset="utf-8">
        <title>Result table</title>
    </head>
    <body>
        <?php 
            $start_time = date_create();
            session_start();
            if (count($_GET) != 0) $_SESSION[$_COOKIE['PHPSESSID']][] = $_GET;
            if ($_POST['reset'] != NULL) $_SESSION[$_COOKIE['PHPSESSID']] = [];
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
            <?php  foreach ($_SESSION[$_COOKIE['PHPSESSID']] as $requests){
                if (validate($requests['x'], $requests['y'], $requests['radius'])){
                    $format = '<td>%s</td>';
                    echo '<tr>';
                    echo sprintf($format, $requests['x']);
                    echo sprintf($format, $requests['y']);
                    echo sprintf($format, $requests['radius']);
                    echo sprintf($format, isInArea(floatval($requests['x']), floatval($requests['y']), floatval($requests['radius'])));
                    echo '</tr>';
                }
            } ?>
            <tr>
                <td colspan="2">Current time</td>
                <td colspan="2">Script work time</td>
            </tr>
            <tr>
                <td colspan="2"><?php echo date('d-m-y h:i:s')?></td>
                <td colspan="2"><?php 
                $end_time = date_create();
                echo date_diff($end_time, $start_time)->format('%s seconds %f microseconds');
                ?></td>
            </tr>
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
