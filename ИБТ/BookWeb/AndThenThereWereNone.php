<?php
    $servername = "DESKTOP-R5BMPM2\SQLEXPRESS";
    $dbname = "IBTProject";
    $connectionInfo = array( "Database"=>$dbname);

    $conn = sqlsrv_connect($servername, $connectionInfo);
    
    if( $conn ) {
        echo "Connection established.<br />";
    }else{
        echo "Connection could not be established.<br />";
        die( print_r( sqlsrv_errors(), true));
    }
    
    function getPurchaseData() {
        $data = array();
        $data[0] = htmlspecialchars($_POST[1]);
        $data[1] = htmlspecialchars($_POST['name']);
        $data[2] = htmlspecialchars($_POST['cardNumber']);
        $data[3] = htmlspecialchars($_POST['expiryDate']);
        $data[4] = htmlspecialchars($_POST['cvvNum']);
        return $data;
    } 

    function getReviewData() {
        $data = array();
        $data[0] = htmlspecialchars($_POST[1]);
        $data[1] = htmlspecialchars($_POST['reviewerName']);
        $data[2] = htmlspecialchars($_POST['reviewArea']);
        return $data;
    } 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $form_type = $_POST['form_type'];
    
        if ($form_type == "purchase_form") {
            $info = getPurchaseData();
            $query = "INSERT INTO dbo.Purchase (BookId, ClientName, CardNumber, ExpiryDate, CVV) VALUES (?, ?, ?, ?, ?)";
            $params = array($info[0], $info[1], $info[2], $info[3], $info[4]);
        } elseif ($form_type == "another_form") {
            $info = getReviewData();
            $query = "INSERT INTO dbo.Review (BookId, ReviewerName, ReviewText) VALUES (?, ?, ?)";
            $params = array($info[0], $info[1], $info[2]);
        }
    }

    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Record inserted successfully.";
    }

    sqlsrv_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <div class="pageTitle">
            <title>Книги за купуване</title>
        </div>        
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <header>
            <h1>Добре дошли в КупиСиКнига</h1>
            <h4>Най-доброто място за любители на книги!</h4>
        </header>
        <div class="navbar">
            <a href="LoginRegister.html" target="_blank">Вход/Регистрация</a>
        </div>
        <div class="book-container">
            <img src="Images\AndThenThereWereNone.jpg" alt="And Then There Were None" id="image">
            <div class="book-details">
                <h3 id="bookName">And Then There Were None</h3>
                <p id="bookText">
                    And Then There Were None by Agatha Christie is a classic mystery novel where ten strangers are invited to a remote island 
                    under different pretexts. They soon discover that their host is absent, and they are trapped. 
                    One by one, they are murdered in a manner that parallels a nursery rhyme, 
                    and the survivors must figure out who among them is the killer before it''''s too late.
                </p>
                <div class="bottom-section">
                    <h4 class="price">Цена: 14.00лв</h4>
                    <div class="buttons">
                        <button class="button" onclick="showForm('purchaseForm')">Купи</button>
                        <div id="purchaseForm" class="hidden form-container">
                            <button class="close-btn" onclick="closeForm('purchaseForm');">x</button>
                            <h3>Закупуване</h3>
                            <div class="modal">
                                <form class="form" method="post">
                                    <input type="hidden" name="form_type" value="purchase_form">
                                    <div class="separator">
                                        <hr class="line">
                                        <p>ИЛИ</p>
                                        <hr class="line">
                                    </div>
                                    <div class="card-info">
                                        <div class="input_container">
                                            <label class="input_label">Име на притежателя на картата</label>
                                            <input class="input_field" type="text" id="name" placeholder="Въведете цялото име">
                                        </div>
                                        <div class="input_container">
                                            <label class="input_label">Номер на картата</label>
                                            <input class="input_field" type="number" id="cardNumber" placeholder="0000 0000 0000 0000">
                                        </div>
                                        <div class="input_container">
                                            <label class="input_label">Дата на валидност / CVV</label>
                                            <div class="split">
                                                <input class="input_field" style="width: 250px;" type="text" id="expiryDate" placeholder="01/23">
                                                <input class="input_field" style="width: 110px;" type="number" id="cvvNum" placeholder="CVV">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="insert" class="checkout" style="cursor: pointer;" onclick="showPopup(), resetPurchaseForm();">
                                        <span>Плащане</span>
                                    </button>
                                </form>
                            </div>
                            <div class="popup" id="popup">
                                <h3 id="popupMessage">%Име%, благодарим за поръчката!</h3>
                                <button type="button" onclick="closePopup(), closeForm('purchaseForm');">OK</button>
                            </div>
                        </div>
                        <button class="button" onclick="showForm('reviewForm');">Ревюта</button>
                        <div id="reviewForm" class="hidden form-container">
                            <button class="close-btn" onclick="closeForm('reviewForm');">x</button>
                            <div class="wrapper">
                                <h3>Оценете продукта</h3>
                                <form id="reviewFormElement" method="post">
                                    <input type="hidden" name="form_type" value="review_form">
                                    <div class="input_container">
                                        <input class="input_field" type="text" id="reviewerName" placeholder="Въведете цялото име">
                                    </div>
                                    <textarea name="opinion" cols="30" rows="5" id="reviewArea" placeholder="Вашето мнение..."></textarea>
                                    <div class="btn-group">
                                        <button type="submit" name="isnert" class="btn submit" onclick="closeForm('reviewForm'), resetReviewForm(), submitReview();">Публикувай</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="reviews">
            <h3>Ревюта</h3>
            <div class="review">
                <p><strong>Петър Иванов:</strong> Добро четиво.</p>
            </div>
            <div class="review">
                <p><strong>Гергана Милева:</strong> Класика! Препоръчвам я.</p>
            </div>
        </div>
        <script src="script.js"></script>
    </body>
</html>