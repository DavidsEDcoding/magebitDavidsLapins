<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/email.table.style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <input style="display:block" id="myInput" type="text" placeholder="Search..">
    <form>
        <button>
            ALL
        </button>
    </form>
    <?php
        require_once("app/core/Database.php");
        $db=new Database();
        if(isset($_POST['delete'])){
            $id=$_POST['emailId'];
            $db->execSQL("DELETE FROM emails WHERE id=$id");
        }

        if(isset($_POST['sortByDomain'])){
            $domain='%'.$_POST['domain'];
            $emails=$db->select("SELECT * FROM emails WHERE email like '$domain'");
        }
        else{
            $emails=$db->select("SELECT * FROM emails order by date");
        }
        
        $domains=$db->select("SELECT DISTINCT substring_index(email, '@', -1) domain
        FROM emails");

        foreach($domains as $d){
            echo '
            <form style="display:inline" action="'.$_SERVER['PHP_SELF'].'" method="POST">
            <input name="domain" type="hidden" value="'.$d->domain.'" >
                <button name="sortByDomain" type="submit">'.$d->domain.'</button>
            </form>
            ';
        }
        echo "
        <table>
        <thead>
            <tr>
                <th>id</th>
                <th onclick=".'sortTableByEmail()'." style=".'cursor:pointer'.">email ↑↓ </th>
                <th onclick=".'sortTableByDate()'." style=".'cursor:pointer'.">Date ↑↓</th>
                <th>Delete</th>
            </tr>
        </thead><tbody id=".'myTable'.">";
        foreach($emails as $e){
            echo '
            <tr>
                <td >'.$e->id.'</td>
                <td>'.$e->email.'</td>
                <td>'.$e->date.'</td>
                <td style=" cursor:pointer; padding-left:15px">
                    <form action="'.$_SERVER['PHP_SELF'].'" method="POST">
                        <input name="emailId" type="hidden" value="'.$e->id.'">
                        <button name="delete" type="Submit" style="color:red">X</button>
                    </form>
                </td>
            </tr>';
        }
        echo "</tbody></table>";
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/email.table.js"></script>
</body>
</html>
