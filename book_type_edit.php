<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>php-id-w10-title-edit</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="bootstrap/js/html5shiv.min.js"></script>
            <script src="bootstrap/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>        
        <div class="container">
            <div class="row"> 
                <div class="jumbotron" style="background-color: cornflowerblue;">
                    <?php include 'topbanner.php';?>
                </div>
            </div>
            <div class="row">
                <?php include 'menu.php';?>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <p>Login Area</p>
                </div>  
                <div class="col-sm-12 col-md-9 col-lg-9">
                <h4>แก้ไขชนิดหนังสือ</h4>    
                <?php
                    include 'connectdb.php';
                    if(isset($_GET['submit'])){
                        $bt_id     = $_GET['bt_id'];
                        $bt_name   = $_GET['bt_name'];
                        $sql        = "update book_type set bt_name='$bt_name' where bt_id='$bt_id'";
                        mysqli_query($conn,$sql);
                        mysqli_close($conn);
                        echo "แก้ไข $bt_name เรียบร้อยแล้ว<br>";
                        echo '<a href="book_type_list.php">แสดงชนิดหนังสือทั้งหมด</a>';
                    }else{
                        $fbt_id = $_REQUEST['bt_id'];
                        $sql =  "SELECT * FROM book_type where bt_id='$fbt_id'";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $fbt_name = $row['bt_name'];
                        mysqli_free_result($result);
                        mysqli_close($conn);                        
                ?>
                    <form class="form-horizontal" role="form" name="book_type_edit" action="<?php echo $_SERVER['PHP_SELF']?>">
                        <input type="hidden" name="bt_id" id="bt_id" value="<?php echo "$fbt_id";?>">
                        <div class="form-group">
                            <label for="bt_name" class="col-md-2 col-lg-2 control-label">ชนิดหนังสือ</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="bt_name" id="bt_name" class="form-control" value="<?php echo "$fbt_name";?>">
                            </div>    
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-lg-10">
                                <input type="submit" name="submit" value="ตกลง" class="btn btn-default">
                            </div>    
                        </div>
                    </form>
                <?php
                    }
                ?>
                </div>    
            </div>
            <div class="row">
                <address>คณะวิทยาการคอมพิวเตอร์และเทคโนโลยีสารสนเทศ</address>
            </div>
        </div>    
    </body>
</html>